<?php

    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    $conn = create_connection();
    
    $html = "";
    
    if(!isset($_POST['campoNome']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }
    
    $nome = $_POST['campoNome'];
    $id_user = $_SESSION['id'];
    
    $isOk = true;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){
        $sqlPreCheck = "SELECT atividades.id,nome,img0,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$nome."')";

        $resultPreCheck = $conn->query($sqlPreCheck);

        if ($resultPreCheck->num_rows === 0) {
            $sql = "INSERT INTO `atividades` (`nome`, `descricao`, `local`, `linkMaps`, `id_utilizador`, `isPublic`) VALUES ('$nome', 'Atividade nova', 'none', 'none', '".$id_user."', '0');";

            $result = $conn->query($sql);

            $sql = "SELECT atividades.id,nome,img0,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$nome."')";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();


                $sql2 = "INSERT INTO imagens (img0, id_atividade) VALUES ('none', '".$row['id']."');";

                $result = $conn->query($sql2);

            }else{
                $html = "Erro inesperado";
                $isOk = false;
            }
        }else{
            $html = "A Atividade já existe" ;
            $isOk = false;
        }
        
    }else{
        $html = "Dados inválidos";
        $isOk = false;
    }
    
    
    
    $conn->close();
    
    if($isOk){
        header("Location: /conteudo/atividades/ativ.php?a=".$nome);
    }else{
        create_header("","");
        create_content($html);
        create_footer();
    }

