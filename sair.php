<?php
    require_once 'php/estrutura/structure.php';
    

    if(isset($_SESSION['id']) || isset($_SESSION['nome'])) {
        session_unset();
    }
header("Location: /index.php");


