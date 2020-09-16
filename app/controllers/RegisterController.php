<?php
namespace App\Controllers;
use App\Models\Users;
use Core\Controller;
use Core\Validation;
use Core\Router;
use Core\Mail;

class RegisterController extends Controller {
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
            if ($valid->checkRegister($data)) {
                unset($data['confirm']);
                $mail = new Mail();
                $code = md5(time().$data['email'].rand(0,666));
                if($mail->confirmation($data['email'], $code)) {
                        $newUser = new Users();
                        $newUser->register($data);
                        Router::redirect('login');
                }
            } else {
                $this->errors = $valid->errors();
                $this->view->displayErrors = $valid->displayErrors($this->errors);
            }
        }
        $this->view->render('login/register');
    }

    public function verify() {
        if(!empty($_GET['email']) && !empty($_GET['code'])) {
            $data = $_GET;
            foreach ($data as $key=>$value) {
                $data[$key] = sanitize($value);
            }
            $user = new Users();
            if($user->verify($data['email'])){
                $user->login();
                Router::redirect('');
            } else {
                Router::redirect('register');
            }

        }
    }
}