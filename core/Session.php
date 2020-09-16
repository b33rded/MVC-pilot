<?php
namespace Core;

class Session {

    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function set($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function status($role) {
        if($role === 10) {
            return $_SESSION['role'] = 'admin';
        }
        return $_SESSION['role'] = 'user';
    }

    public static function uagent_no_version() {
        $fullUagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $uagentNoVersion = preg_replace($regx, '', $fullUagent);
        return $uagentNoVersion;
    }
}