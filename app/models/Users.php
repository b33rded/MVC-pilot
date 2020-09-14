<?php
namespace App\Models;
use Core\Model;

class Users extends Model {
    private $isLoggedIn, $sessionName, $cookieName;
    public static $currentLoggedInUser = null;

    public function __construct($user='') {
        $table = 'users';
        parent::__construct($table);
        $this->sessionName = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->softDelete = true;
        if($user != '') {
            if(is_int($user)) {
                $u = $this->db->findFirst('users',['conditions'=>'id = ?', 'bind'=>[$user]]);
            } else {
                $u = $this->db->findFirst('users', ['conditions'=>'username = ?','bind'=>[$user]]);
            }
            if($u) {
                foreach($u as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }
}