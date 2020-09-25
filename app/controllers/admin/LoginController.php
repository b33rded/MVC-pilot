<?php
namespace App\Controllers\Admin;
use Core\Controller;
use Core\Router;
use Core\Validation;
use App\Models\Users;
use App\Models\Dashboard;

class LoginController extends Controller {
    private $errors = [];

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('admin');
    }

    public function index() {
        if ($_POST) {
            $data = $_POST;
            foreach ($data as $key=>$value) {
                $data[$key] = sanitize($value);
            }
            $valid = new Validation('users');
            if ($valid->checkLogin($data)) {
                if($valid->checkAdmin()) {
                    $user = new Users($data['email']);
                    $user->login($data);
                    Router::redirect('admin');
                } else {
                    $this->errors = $valid->errors();
                    $this->view->displayErrors = $valid->displayErrors($this->errors);
                }
            }
        }
            $this->view->render('admin.login');
    }
}