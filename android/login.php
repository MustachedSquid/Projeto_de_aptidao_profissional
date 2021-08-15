<?php
    
    /*Error codes:
    
     * 0 = Missing data
     * 1 = User doesn't exist
     * 2 = wrong password
     * 3 = invalid data
     * 4 = connection failed
     * 5 = success
     
     
    */

    const SERVERNAME = ""; //TODO: Adicionar dados de bd.
    const USERNAME = ""; //TODO: Adicionar dados de bd.
    const PASSWORD = ""; //TODO: Adicionar dados de bd.
    const DBNAME = ""; //TODO: Adicionar dados de bd.
    
    
    
    $html= "";
    
    if(!isset($_POST['campoNome']) || !isset($_POST['campoPassword'])){
        $html = "0;Dados em falta";
    }
    
    $nome = $_POST['campoNome'];
    $password = $_POST['campoPassword'];
    
    // Create connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    // Check connection
    if ($conn->connect_error) {
        $html = "4;Conexão falhou";
    }
    
    $hash = hash("sha512", strtolower($password));
    
    $result=null;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){
        $sql = "SELECT * FROM utilizadores WHERE LOWER(nome) = LOWER('".$nome."') AND password = '".$hash."'";
        $result = $conn->query($sql);

        
    }else{
        $html = "3;Dados inválidos";
    }
    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
               
        if($nome = $row['nome']){
                
            $html = "5;".$row["id"].";".$row["nome"];

        }else{
            $html = "2;Password errada";
        }
      
        
    } else {
        
      $html = "1;Utilizador/Password incorretos";
    }
    
    
    $conn->close();

    echo $html;

    

