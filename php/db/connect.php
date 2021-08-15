<?php
    require_once 'configPath.php';
    require_once PATH . 'papPhpConfigs/dbConstants.php';
    require_once PATH . 'php/estrutura/structure.php';
    

    function create_connection(): mysqli
    {
        // Create connection
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

        // Check connection
        if ($conn->connect_error) {
            create_header("","");
            create_content("Connection failed: " . $conn->connect_error);
            create_footer();
            die();
        }
        return $conn;
    }