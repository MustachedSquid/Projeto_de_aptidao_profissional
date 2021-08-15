<?php
    //session folder register

    require_once '../estrutura/structure.php';
    require_once '../../papPhpConfigs/dbConstants.php';
 
    if(isset($_SESSION['id']) && isset($_SESSION['nome']) ){
        header("Location: /index.php");
        
    }
    
    if(!isset($_POST['campoNome']) || !isset($_POST['campoEmail']) || !isset($_POST['campoPassword']) || !isset($_POST['campoPasswordConf'])){
        header("Location: ../../index.php");
    }

    // Create connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    $nome = $_POST['campoNome'];
    $email = $_POST['campoEmail'];
    $password = $_POST['campoPassword'];
    $passwordConf = $_POST['campoPasswordConf'];
    
    if($password!==$passwordConf){
        $html = "As palavras passe não são iguais.";
    }else{


        // Check connection
        if ($conn->connect_error) {
                $html = "Conexão falhou";
        }else{

            if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome) && filter_var($email, FILTER_VALIDATE_EMAIL)){

                $sql = "SELECT * FROM utilizadores WHERE nome = '".$nome."'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $html = "Utilizador ja existe";


                    } else {


                        $passwordHash = hash("sha512", $password);


                        if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){

                            $sql = "INSERT INTO utilizadores(nome,password,email) VALUES ('".$nome."','".$passwordHash."','".$email."')";
                            $result = $conn->query($sql);

                            $html = "Utilizador criado com sucesso!";

                        }else{
                            $html = "Dados invalidos";
                        }
                    }
            }else{
                $html = "Dados invalidos";
            }


        }
    }
    $conn->close();
    
    
    
    create_header("","");
    create_content($html);
    create_footer();
    
    
    



    
