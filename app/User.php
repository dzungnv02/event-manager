<?php
namespace App;

class User {
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                user_id, email, username
            FROM
                users;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function find($id)
    {
        $statement = "
            SELECT 
                user_id, email, username
            FROM
                users
            WHERE user_id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0];
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO users 
                (email, username)
            VALUES
                (:email, :username);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'email' => $input['email'],
                'username'  => $input['username'],
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE users
            SET 
                email = :email,
                username  = :username
            WHERE user_id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'user_id' => (int) $id,
                'email' => $input['email'],
                'username'  => $input['username'],
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM users
            WHERE user_id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
}