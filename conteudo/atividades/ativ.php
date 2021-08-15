<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';

    $isOwner = false;
    $isLogin = false;
    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        $isLogin=true;
    }
    
    $html = "";
    
    $conn = create_connection();
    if(!isset($_GET['a'])){
        header("Location: /index.php");
    }
    
    
    $pesquisa = $_GET['a'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){
        $sql = "SELECT atividades.id,nome,descricao,local,imagens.img0,isPublic,linkMaps,atividades.id_utilizador,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('".$pesquisa."')";
        $result = $conn->query($sql);

        

        if ($result->num_rows > 0) {


            while($row = $result->fetch_assoc()){
                    
                $html = $html. '<div class="ativDiv">';
                
                if($isLogin){
                    if($row['id_utilizador'] === $_SESSION['id']){
                       $isOwner = true; 
                    }
                }
                    
                $lm = $row['linkMaps'];
                if(trim($lm)==="" || $lm === "none"){
                    $lm="";
                }else{
                    $lm = '<a id="aLinkMaps" target="_blank" href="'.$lm.'"><button class="adminBot" >Google Maps</button></a>';
                }
                
                $local = $row['local'];
                if($local === 'none'){
                    $local = '';
                }
                

                if($row['isPublic']==="1" || $isOwner){
                    $info = "";
                    
                    if($row['isPublic'] === "0"){
                        $info = "(Privado)";
                    }
                    $html = $html . '<h1>'.$row['nome'].' '.$info.'</h1><h3>'.$row['categoria'].'</h3><br>'.$local.'<br>'
                            . $lm.'<br>'
                        . '<img id="ativImg0" src="'.$row['img0'].'" alt=""> <br>'
                        . '<p>'.$row['descricao'].'</p>'
                            
                    . '<br>';
                    

                    if($isOwner){
                        $html = $html . '<a href="editar_atividade.php?a='.$pesquisa.'"><button class="adminBot" >Editar</button></a><br>'
                                . '<a href="editar_imagem_atividade.php?a='.$pesquisa.'"><button class="adminBot id="linkImgEdit">Editar imagem</button></a><br>'
                                . '<a href="apagar_atividade.php?a='.$pesquisa.'"><button class="adminBot" >Apagar</button></a>';
                    }


                    if($isLogin){
                        $html = $html . '<form id="rateForm" name="rateForm" action="/php/admin_ativ/rate.php" onsubmit="return validateAtivRateFormAndSubmit()" method="POST">
                            Comentar: <br>
                                <input class="input" id="campoNome" type="hidden" name="campoNome" value="'.$_GET['a'].'">

                                <textarea class="input" id="campoComentario" name="campoComentario" cols="20" rows="2"></textarea><sup id="cComeSup"></sup>

                                <select id="campoRate" name="campoRate">
                                    <option value = "-5">1</option>
                                    <option value = "-4">2</option>
                                    <option value = "-3">3</option>
                                    <option value = "-2">4</option>
                                    <option selected value = "-1">5</option>
                                    <option value = "1">6</option>
                                    <option value = "2">7</option>
                                    <option value = "3">8</option>
                                    <option value = "4">9</option>
                                    <option value = "5">10</option>
                                </select>


                                <input  id="submit" name="botSubmit" type="submit" value="Comentar">
                            </form>';
                    }

                    $sqlComment = "SELECT avaliacoes.id,utilizadores.nome,quantidade,comentario,avaliacoes.id_ativ FROM utilizadores JOIN avaliacoes ON avaliacoes.id_util = utilizadores.id WHERE id_ativ = ".$row['id'].";";
                    $resultComment = $conn->query($sqlComment);

                    if ($resultComment->num_rows > 0) {

                        $html = $html . "<h3>Comentários:</h3>";
                        while($rowComment = $resultComment->fetch_assoc()){

                            if($_SESSION['nome']===$rowComment['nome']){
                                $html = $html . '<form id="rateDelForm" name="rateDelForm" action="/php/admin_ativ/delete_rate.php" method="POST">
                                <input class="input" id="campoNome" type="hidden" name="campoNome" value="'.$row['nome'].'">
                                <input class="input" id="campoId" type="hidden" name="campoId" value="'.$rowComment['id'].'">

                                <input class="adminBot" id="submit" name="botSubmit" type="submit" value="Apagar comentário">
                            </form>';
                            }

                            $classificacao = "" . $rowComment['quantidade'];
                            $cl = 0;

                            switch ($classificacao){
                                case "-5": $cl = 1; break;
                                case "-4": $cl = 2; break;
                                case "-3": $cl = 3; break;
                                case "-2": $cl = 4; break;
                                case "-1": $cl = 5; break;

                                case "1": $cl = 6; break;
                                case "2": $cl = 7; break;
                                case "3": $cl = 8; break;
                                case "4": $cl = 9; break;
                                case "5": $cl = 10; break;
                            }
                            $html = $html . $rowComment['nome']
                                    . '<br>Classificação: ' . $cl
                                    . '<br><p>'.$rowComment['comentario'].'</p>';
                        }
                    }

                    $html = $html. '</div>';
                }else{

                    $html = "<p>Erro: Atividade não é publica</p>";
                }

                
                
                
                
                
                
            }
            //comment get sql: SELECT utilizadores.nome,quantidade,comentario,avaliacoes.id_ativ FROM utilizadores JOIN avaliacoes ON avaliacoes.id_util = utilizadores.id WHERE id_ativ = 40 
            
            
        } else {

          $html = "<p>Erro: Atividade não encontrada</p>";
        }
    }else{
        $html = 'Erro: Dados inválidos.<br><a href="/index.php">Voltar</a>';
    }
    
    
    $conn->close();
    
    $html = $html . "<br><br><br><br>";
    
    create_header("displayativcss1", "validadeAtivRateForm");
    
    create_content($html);
    
    create_footer();
    

