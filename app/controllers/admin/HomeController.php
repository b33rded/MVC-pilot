<?php
namespace App\Controllers\Admin;
use App\Models\Users;
use Core\Controller;
use App\Models\Dashboard;

class HomeController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('admin');
        $this->load_model('Users');
    }

    public function index() {
        $userList = $this->UsersModel->findAllById('id');
        $this->view->render('admin.dashboard', ['users' => $userList]);
    }
}