<?php

    
    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    $html = "";
    
    $conn = create_connection();
    if(!isset($_POST['campoNome']) || !isset($_POST['campoComentario']) || !isset($_POST['campoRate']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }
    
    $nome = $_POST['campoNome'];
    $rate = $_POST['campoRate'];
    $comment = $_POST['campoComentario'];
    $id_user = $_SESSION['id'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){
        
        $sql = "SELECT atividades.id,nome FROM atividades WHERE LOWER(nome) LIKE LOWER('".$nome."')";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        
            if($rate>=-5 && $rate<=5 && preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ%!?.,a-zA-Z0-9_ ]+?$/", $comment)){
                
                $sql2 = "INSERT INTO `avaliacoes` (`quantidade`, `comentario`, `id_ativ`, `id_util`) VALUES ('".$rate."', '".$comment."', '".$row['id']."', '".$id_user."');";

                $result = $conn->query($sql2);
            }else{
                
                create_header("","");
                create_content("Erro: Dados inválidos");
                create_footer();

                die();
            }

            

        }else{
            
            create_header("","");
            create_content("Erro: Atividade não existe");
            create_footer();

            die();
        }
        
    }else{

        create_header("","");
        create_content("Erro: Dados inválidos");
        create_footer();
        die();
    }
    
    
    
    $conn->close();
    
    header("Location: /conteudo/atividades/ativ.php?a=".$nome);