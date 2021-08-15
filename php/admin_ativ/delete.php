<?php

    
    require_once '../estrutura/structure.php';
    require_once '../db/connect.php';

    $html = "";
    
    $conn = create_connection();
    if(!isset($_POST['campoId']) || !isset($_SESSION['id'])){
        header("Location: /index.php");
    }
    
    $id = $_POST['campoId'];
    $id_user = $_SESSION['id'];
    $pesquisa = $id;
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id = ".$pesquisa."";
            
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
    
            if($row['id_utilizador'] === $_SESSION['id']){
                //delete avaliações
                $delAval = "DELETE FROM avaliacoes WHERE id_ativ=$id;";
                    
                $resultDelAval = $conn->query($delAval);
                
                //delete imagens e horarios
                $delImg = "DELETE FROM imagens WHERE id_atividade=$id;";
                    
                $resultDelImg = $conn->query($delImg);
                
                $dirname = "../../res/imagens/ativ_img/".$row['nome'];
                array_map('unlink', glob("$dirname/*.*"));
                rmdir($dirname);
                
                $delHor= "DELETE FROM horarios WHERE id_atividade=$id;";
                    
                $resultDelHor = $conn->query($delHor);
                
                //delete Atividade        
                
                $delAtiv = "DELETE FROM atividades WHERE id = $id";
                        
                $resultDelAtiv = $conn->query($delAtiv);
                
                $html="Apagado com sucesso.";
                
            }else{
                $html = 'Erro: Não é o dono desta atividade.<br><a href="/index.php">Voltar</a>';
            }
        }else{
            $html = 'Erro: Atividade não existe.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    
    $conn->close();
    
    create_header("","");
    create_content($html);
    create_footer();
    
