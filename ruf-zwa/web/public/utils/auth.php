<?php
    /**
     * Conatants for user email, name nd salt
    */
    define('AUTH_COOKIE_EMAIL', 'userEmail');
    define('AUTH_COOKIE_NAME', 'userName');

    define('SALT', '1%fsd^%^%*#$%2sdfs@#$3645');

    if (isset($_COOKIE[AUTH_COOKIE_EMAIL])) {
        $isLoggedIn = strlen($_COOKIE[AUTH_COOKIE_EMAIL]) > 0;
        $loggedInUserEmail = $_COOKIE[AUTH_COOKIE_EMAIL];
        $GLOBALS['isLoggedIn'] = $isLoggedIn;
    } else {
        $GLOBALS['isLoggedIn'] = false;
        $loggedInUserEmail = '';
    }

    if (isset($_COOKIE[AUTH_COOKIE_NAME])) {
        $loggedInUserName = $_COOKIE[AUTH_COOKIE_NAME];
    }

    /**
     *  Set cookie for user when log in
     * 
     * @param $email users email
     * @param $name users name
     * 
     */
    function logInUser($email, $name) {
        setcookie(AUTH_COOKIE_EMAIL, $email);
        setcookie(AUTH_COOKIE_NAME, $name);
        header('Location: /');
    }
    
    /**
     *  Set empty cookie 
     */
    function logOutUser() {
        setcookie(AUTH_COOKIE_EMAIL, '');
        setcookie(AUTH_COOKIE_NAME, '');
        header('Location: login.php');
    }

    /**
     * Hash password when user sign up
     * 
     * @param $password users password
     * 
     */
    function hashPassword($password) {
        $passwordHash = hash("sha256", $password);
        return hash("sha256", $passwordHash.SALT);
    }
