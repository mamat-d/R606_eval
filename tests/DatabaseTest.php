<?php

use PHPUnit\Framework\TestCase;
use Mathi\R606Eval\Database;

class DatabaseTest extends TestCase
{
    protected function setUp(): void
    {
        if (!getenv('MYSQL_HOST')) {
            putenv('MYSQL_HOST=127.0.0.1');
        }
        if (!getenv('MYSQL_PORT')) {
            putenv('MYSQL_PORT=3306');
        }
        if (!getenv('MYSQL_USER')) {
            putenv('MYSQL_USER=cdiiv');
        }
        if (!getenv('MYSQL_PASSWORD')) {
            putenv('MYSQL_PASSWORD=superprof');
        }
        if (!getenv('MYSQL_DATABASE')) {
            putenv('MYSQL_DATABASE=tp');
        }
    }

    protected function tearDown(): void
    {
        // Fermer la connexion après chaque test
        Database::closeConnection();
    }

    /**
     * Test que getDB() retourne une instance de PDO
     */
    public function testGetDBReturnsPDOInstance(): void
    {
        $db = Database::getDB();
        $this->assertInstanceOf(PDO::class, $db);
    }

    /**
     * Test que getDB() retourne toujours la même instance (singleton)
     */
    public function testGetDBReturnsSameInstance(): void
    {
        $db1 = Database::getDB();
        $db2 = Database::getDB();
        $this->assertSame($db1, $db2);
    }

    /**
     * Test qu'une exception est levée avec des credentials invalides
     */
    public function testGetDBThrowsExceptionWithInvalidCredentials(): void
    {
        Database::closeConnection();

        putenv('MYSQL_HOST=invalid_host');
        putenv('MYSQL_USER=invalid_user');
        putenv('MYSQL_PASSWORD=invalid_pass');
        putenv('MYSQL_DATABASE=invalid_db');

        $this->expectException(PDOException::class);
        Database::getDB();
    }
}
