<?php
namespace Core;

class Validation {
    private $errors = [];
    private $db;
    public $passed = false;
    public $table;
    public $user;

    public function __construct($table) {
        $this->db = DB::getInstance();
        $this->table = $table;
    }

    public function checkRegister($post) {
        $email = $post['email'];
        $password = $post['password'];
        $confirm = $post['confirm'];
        $user_get = $this->db->selectAll($this->table, ['email'=>$email]);

        if (empty($email)) {
            $this->errors['email'] = 'An email is required';
        } elseif (empty($password)) {
            $this->errors['password'] = 'Password is required';
        } elseif ($password != $confirm || empty($confirm)) {
            $this->errors['password'] = 'Please make sure your passwords match';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Must be an email address';
        } elseif (strlen($password) < 6) {
            $this->errors['pass'] = 'Password must contain at least 6 characters';
        } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $password)) {
            $this->errors['password'] = 'Password must contain letters and numbers only';
        } elseif ($user_get->count()) {
            $this->errors['email'] = "Email already registered";
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }
        return $this->passed;
    }

    public function checkLogin($post) {
        $email = $post['email'];
        $password = $post['password'];
        $user = $this->db->selectAll($this->table, ['email'=>$email])->getFirst();;
        $this->user = $user;
        if (empty($email)) {
            $this->errors['email'] = 'An email is required';
        } elseif (empty($password)) {
            $this->errors['password'] = 'Password is required';
        } elseif (!$user) {
            $this->errors['login'] = 'Wrong email or password';
        } elseif (!password_verify($password, $user->password)) {
            $this->errors['pass'] = 'Wrong email or password';
        } elseif (empty($user->activated)) {
            $this->errors['confirm'] = 'Please, confirm your email first';
        } elseif ($user->status === 2) {
            $this->errors['ban'] = 'Banhammer smashed you';
        }
        if(empty($this->errors)){
            $this->passed = true;
        }
        return $this->passed;
    }

    public function checkAdmin() {
        $this->passed = false;
        if($this->user->role === 0) {
            $this->errors['role'] = 'Access Denied';
        }
        if(empty($this->errors)) {
            $this->passed = true;
        }
        return $this->passed;
    }

    public function errors() {
        return $this->errors;
    }

    public function displayErrors($errors) {
        $html = '<div class="alert alert-danger" role="alert">';
        foreach($errors as $field => $error) {
            $html .= $error;
        }
        $html .= '</div>';
        return $html;
    }
}