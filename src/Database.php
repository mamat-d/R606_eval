<?php

namespace Mathi\R606Eval;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    /**
     * Retourne la connexion à la base de données
     * 
     * @return PDO
     * @throws PDOException
     */
    public static function getDB(): PDO
    {
        if (self::$connection === null) {
            $host = getenv('MYSQL_HOST');
            $user = getenv('MYSQL_USER');
            $port = getenv('MYSQL_PORT');
            $password = getenv('MYSQL_PASSWORD');
            $database = getenv('MYSQL_DATABASE');

            try {
                self::$connection = new PDO(
                    "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4",
                    $user,
                    $password
                );

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new PDOException('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Ferme la connexion à la base de données
     */
    public static function closeConnection(): void
    {
        self::$connection = null;
    }
}
