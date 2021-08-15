<?php
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';


    $conn = create_connection();
    if(!isset($_POST['campoNome']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }
    
    $nome = $_POST['campoNome'];
    $id_user = $_SESSION['id'];
    $pesquisa = $nome;
    $html = "";
    $erro = false;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,img0,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id_utilizador'] === $_SESSION['id']){
                $target_dir = "../../res/imagens/ativ_img/$nome/";
                    
                mkdir($target_dir);
                
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                // Check if image file is a actual image or fake image
                if(isset($_POST["fileToUpload"])) {
                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                  if($check !== false) {
                    //file is an image
                    $uploadOk = 1;
                  } else {
                        $html = "Erro: O ficheiro não é uma imagem válida";
                        $erro = true;


                    $uploadOk = 0;
                  }
                }

            //    // Check if file already exists
            //    if (file_exists($target_file)) {
            //      echo "Sorry, file already exists.";
            //      $uploadOk = 0;
            //    }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 10000000) {
                    $html = "Erro: A imagem só pode ter um tamanho máximo de 10 MB";
                    $erro = true;
                  $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                  
                    $erro = true;
                    $html = "Erro: Só JPG, JPEG e PNG permitidos.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $html = $html . "<b>Erro: Não foi possivél fazer upload do ficheiro";
                    $erro = true;
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                      
                        $fn = basename($_FILES["fileToUpload"]["name"]);
                        $sqlUp = "UPDATE imagens SET img0='https://pap.inkredible.xyz/res/imagens/ativ_img/$nome/$fn' WHERE imagens.id_atividade='".$row['id']."';";

                        $result = $conn->query($sqlUp);

                    } else {
                        $html = "<br>Erro: Não foi possivél fazer upload do ficheiro";
                        $erro = true;
                    }
                }
                
                
                
               
            }
        }else{
            $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';                           
            $erro = true;
        }

    }
    
    $conn->close();
     
    if(!$erro){
        
        header("Location: /conteudo/atividades/ativ.php?a=".$nome);
             
    } 
    
    create_header("","");
    create_content($html);
    create_footer();
     

