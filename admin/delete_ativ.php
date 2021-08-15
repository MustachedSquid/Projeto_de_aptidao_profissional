<?php

    require_once 'php/estrutura/structure.php';
    require_once 'php/db/connect.php';

    $html = "";

    $conn = create_connection();

    if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
        header("Location: /index.php");
    }

    if (!isset($_SESSION['admin'])) {

        header("Location: /admin/index.php");
    }

    $deleteOne = true;

    if (!isset($_GET['id'])) {
        if (!isset($_POST['submit'])) {
            header("Location: /admin/ver_atividades.php");
        }
        $deleteOne = false;
    }

    if( $deleteOne){
        $id = $_GET['id'];
        $pesquisa = $id;

        if (preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)) {
            $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id = " . $pesquisa . "";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();


                //delete avaliações
                $delAval = "DELETE FROM avaliacoes WHERE id_ativ=$id;";

                $resultDelAval = $conn->query($delAval);

                //delete imagens e horarios
                $delImg = "DELETE FROM imagens WHERE id_atividade=$id;";

                $resultDelImg = $conn->query($delImg);

                $dirname = "../../res/imagens/ativ_img/" . $row['nome'];
                array_map('unlink', glob("$dirname/*.*"));
                rmdir($dirname);

                $delHor = "DELETE FROM horarios WHERE id_atividade=$id;";

                $resultDelHor = $conn->query($delHor);

                //delete Atividade

                $delAtiv = "DELETE FROM atividades WHERE id = $id";

                $resultDelAtiv = $conn->query($delAtiv);

                $html = "Apagado com sucesso.";
            } else {
                $html = 'Erro: Atividade não existe.<br><a href="/index.php">Voltar</a>';
            }
        } else {
            $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $id = 0;
        foreach ($_POST['checkboxes'] as $selected){
            $id = $selected;

            $pesquisa = $id;

            if (preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)) {
                $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id = " . $pesquisa . "";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();


                    //delete avaliações
                    $delAval = "DELETE FROM avaliacoes WHERE id_ativ=$id;";

                    $resultDelAval = $conn->query($delAval);

                    //delete imagens e horarios
                    $delImg = "DELETE FROM imagens WHERE id_atividade=$id;";

                    $resultDelImg = $conn->query($delImg);

                    $dirname = "../../res/imagens/ativ_img/" . $row['nome'];
                    array_map('unlink', glob("$dirname/*.*"));
                    rmdir($dirname);

                    $delHor = "DELETE FROM horarios WHERE id_atividade=$id;";

                    $resultDelHor = $conn->query($delHor);

                    //delete Atividade

                    $delAtiv = "DELETE FROM atividades WHERE id = $id";

                    $resultDelAtiv = $conn->query($delAtiv);

                    $html = "Apagado com sucesso.";
                } else {
                    $html = 'Erro: Atividade não existe.<br><a href="/index.php">Voltar</a>';
                }
            } else {
                $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
            }
        }
    }


    $conn->close();

    create_header("admincss1", "validadeLogInForm");
    create_content($html);
    create_footer();
    
    header("Location: /admin/ver_atividades.php");

