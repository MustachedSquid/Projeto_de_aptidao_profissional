<?php
    require_once 'php/estrutura/structure.php';
    

    if(isset($_SESSION['admin'])) {
        session_unset();
    }
header("Location: /admin/index.php");
    
    
