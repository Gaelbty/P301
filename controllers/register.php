<?php

namespace Controllers;

use Models\UserRepository;

class Register
{
    public function __construct(private UserRepository $userRepository) {}

    public function register(): void
    {
        $notFilled = false;
        $validPassword = true;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['pwd'] ?? '';
            $confirmation = $_POST['conf'] ?? '';

            if ($email === '' || $username === '' || $password === '' || $confirmation === '') {
                $notFilled = true;
            } elseif ($password !== $confirmation) {
                $validPassword = false;
            } else {
                $this->userRepository->insertUser($email, $username, $password);
                header('Location: /');
                exit;
            }
        }
        (new \Views\Register)->show($notFilled, $validPassword);
    }
}
