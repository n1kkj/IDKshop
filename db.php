<?php
    $db;
    function connectDB() {
        global $db;
       return $db = new PDO('mysql:host=localhost;dbname=thecoolestpr', 'nikkj', 'nikk;1107');
    }
    function closeDB() {
        global $db;
        $db = null;
    }
?>