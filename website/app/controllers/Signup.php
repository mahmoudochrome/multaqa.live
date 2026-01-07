<?php

namespace controllers;
use core\Controller;
use Core\Database;

class Signup extends Controller {

    // Index of the Home page (localhost/Home(/index))
    public function index() {
        $this->view('Signup/index');
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');
        $error = new \core\Validation();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $csrf = $_POST['csrf'];
        $captcha = $_POST['captcha'];

        $error->checkRequired(
            [
                "username" => $username,
                "password" => $password,
                "csrf" => $csrf,
                "captcha" => $captcha
            ]);
        $error->checkCSRF($csrf);
        $error->checkCaptchaPhase($captcha);
        $error->checkMaxLength(["username" => [50, $username], "password" => [50, $password]]);
        $error->checkMinLength(["username" => [3, $username], "password" => [8, $password]]);
        // I wont check for password strongness, because it's not my job. since there is a JS unit for that!! so if
        // user bypassed it to use a week password so, let him khs.

        $SQL = new \core\QueryBuilder();
        $result = $SQL->select("users", ["username"], "u")->where([["username", "="]])->build()->execute([$username]);

        if(empty($result)) {
            $error->addError("used_username");
        }

        if (!empty($error->getErrors())) {
            $_SESSION['errors'] = $error->getErrors();
            header('Location: /signup');
            die();
        }

        $options = [
            'cost' => 12
        ];
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT, $options);

        $SQL->insert("users", ["username", "password_hash"])->Build()->execute([$username, $hashedPwd]);

        $_SESSION['user'] = Database::lastInsertId();
        $_SESSION['username'] = $username;

        header('Location: /');
        die();
    }
}