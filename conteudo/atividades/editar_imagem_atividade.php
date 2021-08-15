<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/estrutura/load_local.php';
    require_once '../../php/db/connect.php';

    if(!isset($_SESSION['id']) && !isset($_SESSION['nome']) && !isset($_GET['a'])){
        header("Location: /index.php");
    }
    
    
    $conn = create_connection();
    $pesquisa = $_GET['a'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id_utilizador'] === $_SESSION['id']){


                $html = '<div id="container1">
                        <div id="container">
                            <div id="box">
                                
                                <form id="editImgAtivForm" name="editImgAtivForm" action="/php/admin_ativ/upload_image.php" method="POST" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="campoNome" id="campoNome" value="'.$pesquisa.'">
                                    
                                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                                    <sup>Apenas .png, .jpeg e .jpg</sup><br>
                                    <input id="submit" name="botSubmit" type="submit" value="Upload">
                                    
                                </form>
                                

                                </div>
                        </div>
                    </div>';

            }else{
                $html = 'Erro: Acesso proibido!<br><a href="/index.php">Voltar</a>';
            }
        }else{
            $html = 'Erro: A atividade '.$_GET['a'].' não existe.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    create_header("atividadecss2","");
    
    create_content($html);
    
    create_footer();

