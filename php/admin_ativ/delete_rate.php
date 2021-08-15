<?php

    
    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    $html = "";
    
    $conn = create_connection();
    if(!isset($_POST['campoNome']) || !isset($_POST['campoId']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }
    
    $nome = $_POST['campoNome'];
    $id = $_POST['campoId'];
    $id_user = $_SESSION['id'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $id)){
        
        $sql = "SELECT avaliacoes.id,utilizadores.nome,quantidade,comentario,avaliacoes.id_ativ FROM utilizadores JOIN avaliacoes ON avaliacoes.id_util = utilizadores.id WHERE avaliacoes.id = ".$id.";";
                

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        
            
                
            $sql2 = "DELETE FROM avaliacoes WHERE id=".$id;

            $result = $conn->query($sql2);
            

            

        }else{
            
            create_header("","");
            create_content("Erro: Comentário não existe");
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