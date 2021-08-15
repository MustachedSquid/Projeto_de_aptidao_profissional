<?php

    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    $html = "";
    
    $conn = create_connection();
    if(!isset($_POST['campoNome']) || !isset($_POST['campoId']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }

    $id = $_POST['campoId'];
    $nome = $_POST['campoNome'];
    $id_user = $_SESSION['id'];
    $pesquisa = $id;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id = '$pesquisa'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id_utilizador'] === $_SESSION['id']){

                if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $nome)){
                    
                    $descricao = $_POST['campoDescricao'];
                    $local = $_POST['campoLocal'];
                    $linkMaps = $_POST['campoLinkMaps'];
                    $isPublic = $_POST['campoPublic'];
                    $categoria = $_POST['campoCategoria'];
                    
                    if(!preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $descricao)){
                        $descricao = $row['descricao'];
                    }
                    
                    if(!preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $categoria)){
                        $categoria = $row['categoria'];
                    }
                    
                    if($local === "none"){
                        $local=$row['local'];
                    }
                    
                    $sql = "UPDATE atividades SET nome='$nome', categoria='$categoria', descricao='$descricao', local='$local', linkMaps='$linkMaps', isPublic=$isPublic WHERE id = '$id';";

                    $result = $conn->query($sql);
                    

                }else{
                    die("Erro: Dados inválidos");
                }
            }
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    
    $conn->close();
    
    header("Location: /conteudo/atividades/ativ.php?a=".$nome);
    
