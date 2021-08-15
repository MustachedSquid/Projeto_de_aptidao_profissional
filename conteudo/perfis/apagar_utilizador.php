<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';

    if(!isset($_SESSION['id']) && !isset($_SESSION['nome'])){
        header("Location: /index.php");
    }
    
    
    $pesquisa = $_SESSION['nome'];
    
    $conn = create_connection();
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        
        $sql = "SELECT * FROM utilizadores WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')" ;
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id'] === $_SESSION['id']){


                $html = '<div id="container1">
                        <div id="container">
                            <div id="box">
                                <form id="delAtivForm" name="delAtivForm" action="/php/admin_user/delete.php" onsubmit="return validateAtivDeleteFormAndSubmit()" method="POST">
                                    Apagar o utilizador '.$pesquisa.'?<br>
                                    
                                    <input type="hidden" id="campoId" name="campoId" value="'.$_SESSION['id'].'"> 
                                    <input  id="submit" name="botSubmit" type="submit" value="Apagar">
                                </form>
                            </div>
                        </div>
                    </div>';

            }else{
                $html = 'Acesso proibido!<br><a href="/index.php">Voltar</a>';
            }
        }else{
            $html = 'Erro: O utilizador '.$_SESSION['nome'].' não existe.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    create_header("atividadecss2","validadeAtivDeleteForm");
    
    create_content($html);
    
    create_footer();
?>
