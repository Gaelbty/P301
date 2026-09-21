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

            $lastName = $_POST['last_name'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $password = $_POST['pwd'] ?? '';
            $confirmation = $_POST['conf'] ?? '';

            if ($lastName === '' || $firstName === '' || $password === '' || $confirmation === '') {
                $notFilled = true;
            } elseif ($password !== $confirmation) {
                $validPassword = false;
            } else {
                $this->userRepository->insertUser($lastName, $firstName, $password);
                header('Location: /');
                exit;
            }
        }
        (new \Views\Register)->show($notFilled, $validPassword);
    }
}
