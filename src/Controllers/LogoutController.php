<?php

namespace Controllers;

class LogoutController {
    public function execute() {
        session_start();

        unset($_SESSION['user_id']);

        session_destroy();
        header('Location: /login');
        exit;
    }
}