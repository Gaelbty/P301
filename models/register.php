<?php

namespace Models;

use PDO;

class UserRepository
{
    public function __construct(private PDO $connection) {}

    public function insertUser(string $email, string $username, string $password): bool {

        $query = 'INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)';

        $stmt = $this->connection->prepare($query);

        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->bindValue('username', $username, PDO::PARAM_STR);
        $stmt->bindValue('password', $password, PDO::PARAM_STR);

        try {
            return $stmt->execute([
                'email' => $email,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        } catch (PDOException $e) {
            echo 'Erreur : ', $e->getMessage(), PHP_EOL;
            echo 'Requête : ', $query, PHP_EOL;

            if ($e->errorInfo[1] === 1062) {
                echo "Le nom d'utilisateur ou l'adresse email est déjà utilisé.";
            }

            exit();
        }
    }
}