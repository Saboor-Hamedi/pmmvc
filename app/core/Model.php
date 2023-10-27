<?php

namespace App\core;

use Exception;
use PDO;
use PDOException;

trait Model
{
    use Database, Dump;

    private $flash;
    public $filters = [];
    public $sortField = null;
    public $sortOrder = 'ASC';
    protected $limit = 10;
    protected $offset = 0;
    public $errors = [];

    public function select()
    {
        try {
            $query = "SELECT * FROM $this->table";

            if (!empty($this->filters)) {
                $query .= " WHERE ";

                $conditions = [];
                foreach ($this->filters as $field => $value) {
                    $conditions[] = "$field = :$field";
                }

                $query .= implode(' AND ', $conditions);
            }

            if ($this->sortField !== null) {
                $query .= " ORDER BY {$this->sortField} {$this->sortOrder}";
            }

            $query .= " LIMIT $this->limit OFFSET $this->offset";
            $result = $this->query($query, $this->filters);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle the exception here
        }
    }
    public function getSelect($options = [])
    {
        $query = "SELECT * FROM {$this->table}";

        if (isset($options['where'])) {
            $query .= " WHERE {$options['where']}";
        }

        if (isset($options['group'])) {
            $query .= " GROUP BY {$options['group']}";
        }

        if (isset($options['order'])) {
            $query .= " ORDER BY {$options['order']}";
        }

        if (isset($options['limit'])) {
            $query .= " LIMIT {$options['limit']}";
        }
        $result = $this->query($query);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function where($conditions = [], $orderBy = null, $sortOrder = 'ASC', $limit = null, $offset = null)
    {
        try {
            $query = "SELECT * FROM $this->table WHERE ";
            // Build the WHERE clause
            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :$key";
            }

            $query .= implode(' AND ', $whereClauses);

            if ($orderBy !== null) {
                $query .= " ORDER BY $orderBy $sortOrder";
            }

            if ($limit !== null) {
                $query .= " LIMIT $limit";
            }

            if ($offset !== null) {
                $query .= " OFFSET $offset";
            }

            // Use the 'prepare' method from the 'Database' trait
            $stmt = $this->prepare($query); // Assuming 'prepare' is available in the trait

            // Execute the query with bound parameters
            $stmt->execute($conditions);

            // Fetch the results
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception here (e.g., log it)
            return false;
        }
    }



    public function first($data, $data_not = [])
    {
        try {
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "SELECT * FROM $this->table WHERE ";

            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND  ";
            }
            foreach ($keys_not as $key) {
                $query .= $key . " != :" . $key . " AND  ";
            }
            $query = trim($query, " AND ");
            $query .= " LIMIT $this->limit OFFSET $this->offset ";
            $data = array_merge($data, $data_not);
            $result = $this->query($query, $data);
            // Execute the query with bound parameters
            if ($result) {
                return $result[0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            // $this->flash->setMessage('Something went wrong' . $e->getMessage() . 'danger');
        }
    }
    // ! inserted data
    public function insert_data($data)
    {
        try {
            //  todo check the data if it exists on UserModel, or any other table
            //  todo also, remove unwanted column
            if (!empty($this->fillable)) {
                foreach ($data as $key => $value) {
                    if (!in_array($key, $this->fillable)) {
                        unset($data[$key]);
                    }
                }
            }
            $keys = array_keys($data);
            $columns =  implode(', ', $keys);
            $placeholder = ':' . implode(',:', $keys);
            $query = "INSERT INTO $this->table ($columns) VALUES ($placeholder)";
            $result = $this->query($query, $data);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (Exception $e) {

            // $this->flash->setMessage('Something went wrong' . $e->getMessage() . 'danger');
        }
    }
    // ! id, data, and column, may table have different id name
    public function update_data($id, $data, $column = 'id')
    {
        try {
            // todo check the data if it exists on UserModel, or any other table
            // todo also, remove unwanted column
            if (!empty($this->fillable)) {
                foreach ($data as $key => $value) {
                    if (!in_array($key, $this->fillable)) {
                        unset($data[$key]);
                    }
                }
            }
            $keys   = array_keys($data);
            $query  = " UPDATE $this->table SET ";
            foreach ($keys as $key) {
                $query .= $key . "= :" . $key . ", ";
            }

            $query  = trim($query, ", ");
            $query .= " WHERE $column = :$column ";
            $data[$column] = $id;
            if ($query) {
                return $this->query($query, $data);
            } else {
                return false;
            }
        } catch (Exception $e) {
            // $this->flash->setMessage('Something went wrong'. $e->getMessage() . 'danger'); 

        }
    }
    // ! column is another id, if there is not id, such as student_id, you can use it
    public function delete_data($id, $column = 'id')
    {
        $data[$column] = $id;
        $query = "DELETE FROM $this->table WHERE $column = :$column";
    
        try {
            $this->query($query, $data);
            return true; // Successful deletion
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error or return false)
            return false; // Deletion failed
        }
    }
    
}
