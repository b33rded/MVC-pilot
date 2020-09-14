<?php
namespace App\Controllers;
use Core\Controller;
use Core\View;

class Register extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function signinAction() {
        $this->view->render('login/signin');
    }

    public function signupAction() {
        $this->view->render('login/signup');
    }
}