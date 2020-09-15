<?php
namespace Core;

class Validation {
    private $errors = [];
    private $db;
    public $passed = false;
    public $table;

    public function __construct($table) {
        $this->db = DB::getInstance();
        $this->table = $table;
    }

    public function checkRegister($post) {
         if (empty($post['email'])) {
             $this->errors['email'] = 'An email is required';
         } else {
             $email = htmlspecialchars($post['email']);
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 $this->errors['email'] = 'Must be an email address';
             }
        }

        if (empty($post['password'])) {
            $this->errors['password'] = 'Password is required';
        } else {
            $password = htmlspecialchars($post['password']);
            if (strlen($password) < 6) {
                $this->errors['pass'] = 'Password must contain at least 6 characters';
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $password)) {
                $this->errors['password'] = 'Password must contain letters and numbers only';
            }
        }

        if ($post['password'] != $post['confirm']) {
            $this->errors['password'] = 'Please make sure your passwords match';
        } else {
            $confirm = htmlspecialchars($post['confirm']);
            if (strlen($confirm) < 6) {
                $this->errors['password'] = 'Password must contain at least 6 characters';
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $confirm)) {
                $this->errors['password'] = 'Password must contain letters and numbers only';
            }
        }

        $user_get = $this->db->query("SELECT * FROM {$this->table} WHERE email=?", [$email]);
        if ($user_get->count()) {
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
        if (empty($post['email'])) {
            $this->errors['email'] = 'An email is required';
        } elseif (empty($post['password'])) {
            $this->errors['password'] = 'Password is required';
        }

        $user = $this->db->query("SELECT * FROM {$this->table} WHERE email=?", [$email])->get();
        $user = $user[0];
        if ($user && password_verify(Input::get('password'), $user['password'])) {
            $this->passed = true;
        } elseif (empty($user['activated'])) {
            $this->passed = false;
            $this->errors['login'] = 'Please, confirm your email first';
        } else {
            $this->errors['login'] = 'Wrong email or password';
        }
        return $this->passed;
    }

    public function errors() {
        return $this->errors;
    }

    public function displayErrors($errors) {
        $html = '';
        foreach($errors as $field => $error) {
            $html .= '<p class="error">'.$error.'</p>';
        }
        $html .= '';
        return $html;
    }
}