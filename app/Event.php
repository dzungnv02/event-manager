<?php
namespace App;

class Event {
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                event_id, title, start, end, reminder
            FROM
                events;
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
                event_id, title, start, end, reminder
            FROM
                events
            WHERE event_id = ?;
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
            INSERT INTO events 
                (title, start, end, reminder)
            VALUES
                (:title, :start, :end, :reminder);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'title' => $input['title'],
                'start'  => $input['start'],
                'end'  => $input['end'],
                'reminder'  => $input['reminder'],
            ));
            return $this->db->lastInsertId();

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE events
            SET title = :title,
                start = :start,
                end = :end,
                reminder = :reminder
            WHERE event_id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'title' => $input['title'],
                'start' => $input['start'],
                'end'  => $input['end'],
                'reminder'  => $input['reminder'],
                'id' => (int) $id
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM events
            WHERE event_id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function deleteAll()
    {
        $statement = "
            DELETE FROM events;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }         
    }

    public function getEventToReminder($interval)
    {
        $now = date('Y/m/d H:i');
        $statement = "
            SELECT * FROM events 
            WHERE 
                reminder = 1
            HAVING
                MINUTE(TIMEDIFF(start, :now)) = :interval;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'now' => $now,
                'interval'  => $interval
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }  
    }
}