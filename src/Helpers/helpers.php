<?php

function getDbConnection() {
    static $db = null;

    if (!$db) {
        
        $dns = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT;

        try {
            $db = new PDO($dns, DB_USER, DB_PASS);

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            exit('DB connection failed: ' . $e->getMessage());
        }
    }
    
    return $db;
}

// dump and die for debug
function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit();
}