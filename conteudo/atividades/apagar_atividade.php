<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';

    if(!isset($_SESSION['id']) && !isset($_SESSION['nome']) && !isset($_GET['a'])){
        header("Location: /index.php");
    }
    
    
    $pesquisa = $_GET['a'];
    
    $conn = create_connection();
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,descricao,local,img0,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id_utilizador'] === $_SESSION['id']){


                $html = '<div id="container1">
                        <div id="container">
                            <div id="box">
                                <form id="delAtivForm" name="delAtivForm" action="/php/admin_ativ/delete.php" onsubmit="return validateAtivDeleteFormAndSubmit()" method="POST">
                                    Apagar a atividade '.$pesquisa.'?<br>
                                    
                                    <input type="hidden" id="campoId" name="campoId" value="'.$row['id'].'"> 
                                    <input  id="submit" name="botSubmit" type="submit" value="Apagar">
                                </form>
                            </div>
                        </div>
                    </div>';

            }else{
                $html = 'Acesso proibido!<br><a href="/index.php">Voltar</a>';
            }
        }else{
            $html = 'Erro: A atividade '.$_GET['a'].' não existe.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    create_header("atividadecss2","validadeAtivDeleteForm");
    
    create_content($html);
    
    create_footer();

