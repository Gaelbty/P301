<?php

namespace Models;

use PDO;

class UserRepository
{
    public function __construct(private PDO $connection) {}

    public function insertUser(string $lastName, string $firstName, string $password): bool {

        $query = 'INSERT INTO user (lastName, firstName, password) VALUES (:lastName, :firstName, :password)';

        $stmt = $this->connection->prepare($query);

        $stmt->bindValue('lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindValue('firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindValue('password', $password, PDO::PARAM_STR);

        try {
            return $stmt->execute([
                'name' => $lastName,
                'firstName' => $firstName,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        } catch (PDOException $e) {
            echo 'Erreur : ', $e->getMessage(), PHP_EOL;
            echo 'Requête : ', $query, PHP_EOL;
            exit();
        }
    }
}
