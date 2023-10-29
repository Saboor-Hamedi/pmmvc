<?php
namespace App\core;
require_once 'config.php';
use App\core\FlashMessage;
use PDOException;
use PDO;
trait Database
{
    public static $instance;
    public $connection; // Declare the $connection property
    private $flash;
    public $statement;
    public function __construct()
    {
        $this->flash = new FlashMessage;
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
            $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->GetConnection();
        } catch (PDOException $e) {
            error_log('Database connection error:  ' . $e->getMessage());
            $this->flash->setMessage('Database connection error: ', $e->getMessage() . 'danger');
        }
    }

    public function GetConnection()
    {
        if ($this->connection) {
            return $this->connection;
        } else {
            return false;
        }
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
    public function query($sql, array $params = [])
    {
        try {
            $statement = $this->connection->prepare($sql);

            foreach ($params as $key => $value) {
                $statement->bindValue(":$key", is_scalar($value) ? $value : serialize($value));
            }

            if ($statement->execute()) {
                return $statement->fetchAll(PDO::FETCH_OBJ) ?: null;
            }
        } catch (PDOException $e) {
            // Log or handle the exception
        }

        return [];
    }


    public function get_row($sql, array $params = [])
    {
        try {
            $statement = $this->connection->prepare($sql);
            $check = $statement->execute($params);
            if ($check) {
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                if (is_array($result) && count($result)) {
                    return $result[0];
                }
            }
            return false;
        } catch (PDOException $e) {
            // Log or handle the exception
            $this->flash->setMessage('Database connection error: ', $e->getMessage() . 'danger');
            return [];
        }
    }

    public function insert($table, $data)
    {
        $sql = "INSERT INTO $table SET ";
        $placeholders = [];

        foreach ($data as $key => $value) {
            $placeholders[] = "$key = :$key";
        }

        $sql .= implode(", ", $placeholders);

        $statement = $this->connection->prepare($sql);

        // Bind values to named placeholders
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        return $statement->execute();
    }
    // ... other methods ..
    public function update($table, $data, $where)
    {
        $sql = "UPDATE $table SET ";
        $placeholders = array();
        foreach ($data as $key => $value) {
            $placeholders[] = "$key = :$key";
        }
        $sql .= implode(", ", $placeholders);
        $sql .= " WHERE $where";

        $statement = $this->connection->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();

        return $statement->rowCount(); // Return the number of affected rows
    }
    /**
     * Summary of delete
     * @param mixed $table
     * @param mixed $where
     * @return void
     */
    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function GetPaginatedUsers($tableName, $page, $perPage)
    {
        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM $tableName LIMIT :offset, :perPage";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Summary of disconnect
     * @return void
     */
    public function disconnect()
    {
        $this->connection = null;
    }
}
