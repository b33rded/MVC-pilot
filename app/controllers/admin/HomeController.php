<?php
namespace App\Controllers\Admin;
use App\Models\Users;
use Core\Controller;
use Core\Pagination;

class HomeController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('admin');
        $this->load_model('Users');
    }

    public function index() {
        $pages = new Pagination($this->UsersModel->query("SELECT * FROM users")->count());
//        dnd($pages);
        $users = $this->UsersModel->query("SELECT * FROM users LIMIT {$pages->offset}, {$pages->perPage}")->get();
//        dnd($users);
        $this->view->render('admin.dashboard', [
            'users' => $users,
            'pages' => $pages
        ]);
    }


}