<?php
namespace App\Controllers;
use App\Models\Users;
use Core\Controller;
use Core\Validation;
use Core\Input;
use Core\Router;

class LoginController extends Controller {
    private $errors = [];

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function index() {
        if ($_POST) {
            $data = $_POST;
            foreach ($data as $key=>$value) {
                $data[$key] = sanitize($value);
            }
            $valid = new Validation('users');
            if ($valid->checkLogin($data)) {
                $user = new Users();
                $remember = isset($data['remember']) && Input::get('remember');
                $user->login($remember);
                Router::redirect('');
            } else {
                $this->errors = $valid->errors();
                $this->view->displayErrors = $valid->displayErrors($this->errors);
            }
        }
        $this->view->render('login/login');
    }
}