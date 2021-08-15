<?php

    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    if(!isset($_POST['campoNome']) || !isset($_POST['campoDescricao']) || !isset($_POST['campoEmail'])){
        header("Location: /index.php");
    }
    
    $id_user = 0;
    if(isset($_SESSION['id'])){
        $id_user = $_SESSION['id'];
    }
    
    $conn = create_connection();
    
    $html = "";
    
    
    
    
    $nome = $_POST['campoNome'];
    $descricao = $_POST['campoDescricao'];
    $email = $_POST['campoEmail'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome) && preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $descricao) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $sql = "INSERT INTO `tickets` (`nome`, `descricao`, `email`, `id_user`, `estado`) VALUES ('$nome', '$descricao', '$email', $id_user, 0); ";
        
        $result = $conn->query($sql);
        
        
        $html = '<p>Ticket criado com sucesso</p>';
        
    }else{
        $html = "Dados inválidos";
    }
    
    
    
    $conn->close();
    
    create_header("","");
    create_content($html);
    create_footer();
    

