<?php 
class Model { 
    protected $db;
    function __construct() {
        $host = 'localhost:3306';
        $user = 'root';
        $pass = '';
        $db   = 'kerjain';

        $this->db = 
        new mysqli($host, $user, $pass, $db);

        if(!$this->db){
            echo "Database error. "; 
            exit;
        }
    }
}