<?php
namespace App;

class CRUD {
    protected $_connection;

    public function __construct() {
        $this->_connection = TRUE;
    }

    public function getConnection() {
        echo "Get Connection";
        return $this->_connection;
    }
}