<?php
namespace App\Models;
use Core\Model;
use Core\Cookie;
use Core\Session;

class Users extends Model {
    private $isLoggedIn;
    private $sessionName;
    private $cookieName;
    public static $currentLoggedInUser = null;
    public $id,$email,$password;

    public function __construct($user='') {
        $table = 'users';
        parent::__construct($table);
        $this->sessionName = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->softDelete = true;
         if($user != '') {
            if(is_int($user)) {
                $u = $this->db->query("SELECT * FROM {$table} WHERE id = ?", [$user])->get();
            } else {
                $u = $this->db->query("SELECT * FROM {$table} WHERE email = ?", [$user])->get();
            }
                if($u) {
                    $u = $u[0];
                    $this->id = $u['id'];
                    $this->email = $u['email'];
                    $this->password = $u['password'];
                }
            }
    }

    public function register($params) {
        $this->assign($params);
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $this->save($params);
    }

    public function login($rememberMe = false) {
        $userData = $this->db->get();
        $userData = $userData[0];
        $this->id = $userData['id'];
        $this->email = $userData['email'];
        $this->password = $userData['password'];
        Session::set($this->sessionName, $this->id);
        if($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
            $this->db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->db->insert('user_sessions', $fields);
        }
    }

    public function verify($email) {
        $userData = $this->db->query("SELECT * FROM {$this->table} WHERE email=?", [$email])->get();
        $userData = $userData[0];
        $this->id = $userData['id'];
        $this->email = $userData['email'];
        if($userData['status'] === 0 && empty($userData['activated'])) {
            $t = time();
            if($this->db->update($this->table, $this->id, ['status'=>0, 'activated'=>date("Y-m-d H:i:s", $t)])) return true;
        }
        return false;
    }
}