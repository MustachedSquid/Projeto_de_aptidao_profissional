<?php
    //session folder login

    require_once '../estrutura/structure.php';
    require_once '../../papPhpConfigs/dbConstants.php';
    
    $html ="";
    
    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(!isset($_POST['campoNome']) || !isset($_POST['campoPassword'])){
        header("Location: /index.php");
    }
    
    $nome = $_POST['campoNome'];
    $password = $_POST['campoPassword'];
    
    // Create connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    // Check connection
    if ($conn->connect_error) {
        $html = "Erro de conexção";
    }
    
    
    $hash = hash("sha512", $password);
    
    $result=null;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){
        $sql = "SELECT * FROM utilizadores WHERE nome = '".$nome."' AND password = '".$hash."'";
        $result = $conn->query($sql);

        
    }else{
        $html = "Dados inválidos";
    }
    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
               
        if($nome = $row['nome']){


            $_SESSION['id'] = $row['id'];

            $_SESSION['nome'] = $row['nome'];
            
            $_SESSION['email'] = $row['email'];

            header("Location: /index.php");

        }else{
            $html = "Erro, palavra passe errada";
        }
      
        
    } else {
        
      $html = "O utilizador não existe";
    }
    
    
    $conn->close();


    create_header("","");
    create_content($html);
    create_footer();

    

