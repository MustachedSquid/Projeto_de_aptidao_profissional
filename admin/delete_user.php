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
            header("Location: /admin/ver_utilizadores.php");
        }
        $deleteOne = false;
    }

    if( $deleteOne) {
        $id = $_GET['id'];
        $pesquisa = $id;

        if (preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)) {

            $sql = "SELECT * FROM utilizadores WHERE id = " . $pesquisa;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();


                if ($row['id'] === $pesquisa) {


                    $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id_utilizador = " . $pesquisa . "";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            if ($row['id_utilizador'] === $pesquisa) {
                                //delete avaliações
                                $delAval = "DELETE FROM avaliacoes WHERE id_ativ=" . $row['id'];

                                $resultDelAval = $conn->query($delAval);

                                //delete imagens e horarios
                                $delImg = "DELETE FROM imagens WHERE id_atividade=" . $row['id'];

                                $resultDelImg = $conn->query($delImg);


                                $dirname = "../../res/imagens/ativ_img/" . $row['nome'];
                                array_map('unlink', glob("$dirname/*.*"));
                                rmdir($dirname);

                                $delHor = "DELETE FROM horarios WHERE id_atividade=" . $row['id'];

                                $resultDelHor = $conn->query($delHor);

                                //delete Atividade

                                $delAtiv = "DELETE FROM atividades WHERE id = " . $row['id'];

                                $resultDelAtiv = $conn->query($delAtiv);


                            } else {
                                $html = 'Erro: Utilizador não existe.<br><a href="/index.php">Voltar</a>';
                            }
                        }
                    }

                    $delAval = "DELETE FROM avaliacoes WHERE id_util=" . $id;

                    $resultDelAval = $conn->query($delAval);

                    $delUser = "DELETE FROM utilizadores WHERE id=$pesquisa";

                    $result = $conn->query($delUser);

                    $html = "Apagado com sucesso.";


                } else {
                    $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
                }
            } else {
                $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
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

                $sql = "SELECT * FROM utilizadores WHERE id = " . $pesquisa;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();


                    if ($row['id'] === $pesquisa) {


                        $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id_utilizador = " . $pesquisa . "";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                if ($row['id_utilizador'] === $pesquisa) {
                                    //delete avaliações
                                    $delAval = "DELETE FROM avaliacoes WHERE id_ativ=" . $row['id'];

                                    $resultDelAval = $conn->query($delAval);

                                    //delete imagens e horarios
                                    $delImg = "DELETE FROM imagens WHERE id_atividade=" . $row['id'];

                                    $resultDelImg = $conn->query($delImg);


                                    $dirname = "../../res/imagens/ativ_img/" . $row['nome'];
                                    array_map('unlink', glob("$dirname/*.*"));
                                    rmdir($dirname);

                                    $delHor = "DELETE FROM horarios WHERE id_atividade=" . $row['id'];

                                    $resultDelHor = $conn->query($delHor);

                                    //delete Atividade

                                    $delAtiv = "DELETE FROM atividades WHERE id = " . $row['id'];

                                    $resultDelAtiv = $conn->query($delAtiv);


                                } else {
                                    $html = 'Erro: Utilizador não existe.<br><a href="/index.php">Voltar</a>';
                                }
                            }
                        }

                        $delAval = "DELETE FROM avaliacoes WHERE id_util=" . $id;

                        $resultDelAval = $conn->query($delAval);

                        $delUser = "DELETE FROM utilizadores WHERE id=$pesquisa";

                        $result = $conn->query($delUser);

                        $html = "Apagado com sucesso.";


                    } else {
                        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
                    }
                } else {
                    $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
                }
            } else {
                $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
            }
        }
    }


$conn->close();
    
    create_header("admincss1","");
    create_content($html);
    create_footer();
    
    header("Location: /admin/ver_utilizadores.php");
    
