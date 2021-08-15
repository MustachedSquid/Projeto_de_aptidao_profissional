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
        $sql = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if($row['id_utilizador'] === $_SESSION['id']){ 
                

                $visibility = '<select id="campoPublic" name="campoPublic">
                                        <option value = "0">Privado</option>
                                        <option value = "1">Publico</option>
                                    </select>';
                if($row['isPublic'] === "1"){
                    $visibility = '<select id="campoPublic" name="campoPublic">
                                        <option value = "1">Publico</option>
                                        <option value = "0">Privado</option>
                                    </select>';
                }
                
                $categorias="";
                $sqlCat = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade";

                $resultCat = $conn->query($sqlCat);
                if ($resultCat->num_rows > 0) {
                    while($rowCat = $resultCat->fetch_assoc()){
                        if(trim($rowCat['categoria']) !== ""){
                            $categorias = $categorias . '<option value = "'.$rowCat['categoria'].'">'.$rowCat['categoria'].'</option>';
                        }
                    }
                    
                    
                }
                
                
                $html = '<div id="container1">
                        <div id="container">
                            <div id="box">Editar a atividade '.$pesquisa.'<br>

                                <form id="editAtivForm" name="editAtivForm" action="/php/admin_ativ/edit.php" onsubmit="return validateAtivEditFormAndSubmit()" method="POST">
                                    
                                    <input class="input" id="campoId" type="hidden" name="campoId" value="'.$row['id'].'" readonly><br><br><sup id="cIdSup"></sup>
                                    <input class="input" id="campoNome" type="text" name="campoNome" value="'.$row['nome'].'" ><br><br><sup id="cNameSup"></sup><br>

                                    Descrição: <br>
                                    <textarea class="input" id="campoDescricao" name="campoDescricao" cols="40" rows="5">'.$row['descricao'].'</textarea><br><br><sup id="cDescSup"></sup><br>
                                    
                                    Categoria: <br>
                                    <input class="input" list="categorias" name="campoCategoria" id="campoCategoria" value="'.$row['categoria'].'"><datalist id="categorias">'.$categorias.'</datalist><br>
                                    Local:<br> 
                                    '. get_local_select_form().'
                                    <br><br>
                                    Link do Google Maps: <br>
                                    <input class="input" id="campoLinkMaps" type="text" name="campoLinkMaps" value="'.$row['linkMaps'].'"><br><br><sup id="cLinkSup"></sup><br>

                                    Visiblidade: <br>
                                    '.$visibility.'<br><br>






                                    <input id="submit" name="botSubmit" type="submit" value="Editar">
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                    ';

            }else{
                $html = 'Erro: Acesso proibido!<br><a href="/index.php">Voltar</a>';
            }
        }else{
            $html = 'Erro: A atividade '.$_GET['a'].' não existe.<br><a href="/index.php">Voltar</a>';
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    create_header("atividadecss2","validadeAtivEditForm");
    
    create_content($html);
    
    create_footer();
