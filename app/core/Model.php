<?php

namespace App\core;

use App\core\FlashMessage;
use Exception;

trait Model
{
    use Database, VarDump;

    private $flash;
    public $filters = [];
    public $sortField = null;
    public $sortOrder = 'ASC';
    protected $limit = 10;
    protected $offset = 0;
    public $errors = [];
    // public function __construct()
    // {
    //     $this->flash = new FlashMessage;
    // }
    public function selectAll()
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
            // $this->flash->setMessage('Something went wrong' . $e->getMessage() . 'danger');
        }
    }

    public function where($data, $data_not = [])
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
            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // $this->flash->setMessage('Something went wrong' . $e->getMessage() . 'danger');
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
            if (!empty($this->allowColumns)) {
                foreach ($data as $key => $value) {
                    if (!in_array($key, $this->allowColumns)) {
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
            if (!empty($this->allowColumns)) {
                foreach ($data as $key => $value) {
                    if (!in_array($key, $this->allowColumns)) {
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
                $this->query($query, $data);
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
        if ($query) {
            $this->query($query, $data);
        } else {
            return false;
        }
    }

    public function show($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
