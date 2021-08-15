<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';

    session_set_cookie_params(7200);
    session_start();

    if(!isset($_SESSION['id']) ||!isset($_SESSION['nome'])){
    header("Location: /index.php");
    }

    $nome = $_SESSION['nome'];
    $pesquisa = $_SESSION['id'];
    $conn = create_connection();

    $sql = "SELECT atividades.id,nome,descricao,local,img0,isPublic FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE id_utilizador LIKE $pesquisa ORDER BY nome";
    $result = $conn->query($sql);
    $html = "";
    $html = $html . "<h2>As suas Atividades</h2>";
    if ($result->num_rows > 0) {


        while($row = $result->fetch_assoc()){
            

            $local = $row['local'];
                    if($local === 'none'){
                $local = '';
            }

            $html = $html . '<div class="ativWrap"><a href="../../conteudo/atividades/ativ.php?a='.$row['nome'].'"><div class="ativDiv" id="ativSrcDiv"><h1>'.$row['nome'].'</h1>'.$local.'<br>'
                . '<img id="ativImg0" src="'.$row['img0'].'" alt=""> <br>'
                . '<p>'.$row['descricao'].'</p></div></a>'
                . '<br></div>'
                . '<p class="breaker"></p>';



        }



    } else {
        $html = $html . "<p>Não foram encontradas atividades</p>";
    }
    
    $html = $html .'<br><br><br>';
    $conn->close();

    
    
    
    $html = $html . '</div><br><br><br>'; //end
    
    
    
    create_header("displayativcss1","validadeSearchForm");
    
    create_content($html);
    
    create_footer();