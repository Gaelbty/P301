<?php

namespace Controllers;

use \_assets\Includes\DatabaseConnection;
use \Views\Dashboard;
use \Models\UserRepository;

class DashboardController
{
    public function execute(): void
    {
        session_start();

        $userRepository = new UserRepository(new DatabaseConnection());

        if(isset($_SESSION['user_id'])) {
            $username = $userRepository->findById($_SESSION['user_id'])->getUsername();

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                (new Dashboard($username))->show();
            }
        } else {
            (new \Views\Error('Erreur connexion', "Vous n'êtes pas connecté"))->show();
        }
    }
}