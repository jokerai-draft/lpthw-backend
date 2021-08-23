<?php
class SessionedComponent3
{
    public static $isLoggedIn = true; // component without state
    public static function tryLogin($username = "", $password = "") {
        // perform trying login ... like unserialize and compare user input to find a matched user
        $_SESSION['isLoggedIn'] = true;
        self::$isLoggedIn = $_SESSION['isLoggedIn'];
    }
    public static function init() {
        if (isset($_SESSION['isLoggedIn'])) {
            self::$isLoggedIn = $_SESSION['isLoggedIn'];
        } else {
            self::$isLoggedIn = false;
            $_SESSION['isLoggedIn'] = false;
        }
        // session_destroy();
    }
    public static function logout() {
        self::$isLoggedIn = false;
        $_SESSION['isLoggedIn'] = false;
    }
}

// 说明: 这个交给单独的 state service , —— 典型的 persistence layer problem
// ex4/PersistenceLayerProblem2.txt 问题介绍: 这里介绍的一套问题, 以 “典型的 persistence layer problem” 的名义
