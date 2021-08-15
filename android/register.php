<?php
    /*Error codes:
    
        * 0 = Missing data
        * 1 = User exists already
        * 2 = wrong password
        * 3 = invalid data
        * 4 = connection failed
        * 5 = success
     
     
    */
    const SERVERNAME = ""; //TODO: Adicionar dados de bd.
    const USERNAME = ""; //TODO: Adicionar dados de bd.
    const PASSWORD = ""; //TODO: Adicionar dados de bd.
    const DBNAME = ""; //TODO: Adicionar dados de bd.
    

    $html ="";
    
    if(!isset($_POST['campoNome']) || !isset($_POST['campoEmail']) || !isset($_POST['campoPassword']) || !isset($_POST['campoPasswordConf'])){
        $html = "0;Dados em falta";
    }
    
    $nome = $_POST['campoNome'];
    $email = $_POST['campoEmail'];
    $password = $_POST['campoPassword'];
    $passwordConf = $_POST['campoPasswordConf'];

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if($password!==$passwordConf){
        $html = "3;As palavras passe não são iguais.";
    }else{

        // Create connection

        // Check connection
        if ($conn->connect_error) {
                $html = "4;conexão falhou";
        }else{

            if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome) && filter_var($email, FILTER_VALIDATE_EMAIL)){

                $sql = "SELECT * FROM utilizadores WHERE nome = '".$nome."'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $html = "1;utilizador ja existe";


                    } else {


                        $passwordHash = hash("sha512", strtolower($password));


                        if(preg_match("/^[a-zA-Z0-9_]+?$/", $nome)){

                            $sql = "INSERT INTO utilizadores(nome,password,email) VALUES ('".$nome."','".$passwordHash."','".$email."')";
                            $result = $conn->query($sql);

                            $html = "5;Sucesso";

                        }else{
                            $html = "3;Dados invalidos";
                        }
                    }
            }else{
                $html = "3;Nome/Email inválidos";
            }


        }
    }
    $conn->close();
    
    echo $html;


    
