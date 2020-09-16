<?php
namespace App\Models;
use Core\Model;
use Core\Cookie;
use Core\Session;

class Users extends Model
{
    private $sessionName;
    private $cookieName;
    public static $currentUser = null;
    public $id;
    public $email;
    public $password;
    public $status;
    public $activated;
    public $role;
    public $registred_at;

    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);
        $this->sessionName = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->softDelete = true;
        if ($user != '') {
            if (is_int($user)) {
                $this->userData('id', $user);
            } else {
                $this->userData('email', $user);
            }
        }
    }

    public function register($params)
    {
        $this->assign($params);
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $this->save($params);
    }

    public function login($rememberMe = false)
    {
        Session::set($this->sessionName, $this->id);
        if ($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->db->insert('user_sessions', $fields);
        }
    }

    public function verify($email) {
        $this->userData('email', $email);
        if ($this->status === 0 && empty($this->activated)) {
            $t = time();
            if ($this->db->update($this->table, $this->id, ['status' => 1, 'activated' => date("Y-m-d H:i:s", $t)])) return true;
        }
        return false;
    }

    public static function currentUser()
    {
        if (!isset(self::$currentUser) && isset($_SESSION)) {
            $user = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentUser = $user;
        }
        return self::$currentUser;
    }

    private function userData($column, $value) {
        $user = $this->db->selectAll($this->table, [$column=>$value], 'App\Models\Users')->getFirst();
        if ($user) {
            foreach ($user as $key => $val) {
                $this->$key = $val;
            }
        }
    }
}