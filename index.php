<?php
    
    require_once 'php/estrutura/structure.php';
    require_once 'php/estrutura/load_local.php';
    require_once 'php/admin_ativ/top.php';
    require_once 'php/db/connect.php';

    
    $top_html = get_top();

    $html = "";
    
    $doRecommendations = true;
    if(isset($_POST['campoPesquisa']) || isset($_GET['p'])){
        $doRecommendations = false;
    }
    
    $conn = create_connection();

    $categorias="";
    if ($conn->connect_error) {
        $html = $html . "Erro de SQL: " . $conn->connect_error;
    }else{

        $sqlCat = "SELECT atividades.id,nome,descricao,local,linkMaps,isPublic,atividades.id_utilizador,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade";
        $resultCat = $conn->query($sqlCat);
        if ($resultCat->num_rows > 0) {
            while($rowCat = $resultCat->fetch_assoc()){  
                if(trim($rowCat['categoria']) !== ""){
                    $categorias = $categorias . '<option value = "'.$rowCat['categoria'].'">'.$rowCat['categoria'].'</option>';
                }
            }                
        }

    }
    
    $html = '
            <div id="container1">
                <div id="searchContainer">
                    <div id="box">
                        <form action="index.php" id="searchForm" name="searchForm" onsubmit="return validateSearchFormAndSubmut()" method="POST">
                        <input id="campoPesquisa" name="campoPesquisa" type="text" placeholder="Pesquisa..." ><input placeholder="Localidade" list="locais" name="campoLocal" id="campoLocal"><datalist id="locais">'. get_local_options().'</datalist><input placeholder="Categoria" list="categorias" name="campoCategoria" id="campoCategoria"><datalist id="categorias">'. $categorias.'</datalist>


                        <input id="submit" type="image" src="/css/images/search2.jpg" alt="Submit" />
                        </form>
                    </div>
                </div>';    
    
    if($doRecommendations){
        $html = $html .'<br><br>
                <h2 id="recoTitle" >Recomendações</h2>
                <div id="recomendations">
                    '.$top_html.'
                </div><br><br><br>';
        
        
        
    }else{ //Incase of search
        $pesquisa="";
        if(isset($_POST['campoPesquisa'])){
            
            $pesquisa = $_POST['campoPesquisa'];
        }else if(isset($_GET['p'])){
            $pesquisa = $_GET['p'];
        }
        
        $local = "";
        if(isset($_POST['campoLocal'])){
            
            $local = $_POST['campoLocal'];
        }else if(isset($_GET['l'])){
            $local = $_GET['l'];
        }
        
        $categoria = "";
        if(isset($_POST['campoCategoria'])){
            $categoria = $_POST['campoCategoria'];
        }else if(isset($_GET['c'])){
            $categoria = $_GET['c'];
        }
        
        $sqlEnd = "";
            
        $html = $html . '<br><a href="index.php"><button class="adminBot">Ver recomendações</button></a><a href="index.php?p='.$pesquisa.'&l='.$local.'&c='.$categoria.'&o=nome"><button class="adminBot">Ordenar por nome</button></a><a href="index.php?p='.$pesquisa.'&l='.$local.'&c='.$categoria.'&o=local"><button class="adminBot">Ordenar por local</button></a><h2 id="recoTitle" >Resultados</h2>
                <div id="recomendations">';
        if($local !== 'none' && trim($local) !== "" && preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $local)){
            $sqlEnd = $sqlEnd . "AND LOWER(local) LIKE LOWER('".$local."') ";
        }

        if($categoria !== 'none' && trim($categoria) !== "" && preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $categoria)){
            $sqlEnd = $sqlEnd . "AND LOWER(categoria) LIKE LOWER('".$categoria."') ";
        }
            
        
       
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

        if ($conn->connect_error) {
            $html = $html . "Erro de SQL: " . $conn->connect_error;
        }else{

            $result=null;

            if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa) || $pesquisa === ""){

                $order = "nome";
                if(isset($_GET["o"])){
                    $order = $_GET["o"];
                }
                $sql = "SELECT atividades.id,nome,descricao,local,img0,isPublic,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('%".$pesquisa."%') ".$sqlEnd . " ORDER BY $order";
                $result = $conn->query($sql);


            }else{

              $html = $html  . "<p>Dados inválidos</p>";
            }


            if ($result->num_rows > 0) {


                while($row = $result->fetch_assoc()){
                    if($row['isPublic']==="1"){

                        $local = $row['local'];
                        if($local === 'none'){
                            $local = '';
                        }

                        $html = $html . '<div class="ativWrap"><a href="../../conteudo/atividades/ativ.php?a='.$row['nome'].'"><div class="ativDiv" id="ativSrcDiv"><h1>'.$row['nome'].'</h1>'.$row['categoria'].'<br>'.$local.'<br>'
                            . '<img id="ativImg0" src="'.$row['img0'].'" alt=""> <br>'
                            . '<p>'.$row['descricao'].'</p></div></a>'
                    . '<br></div>'
                                . '<p class="breaker"></p>';
                    }


                }
            } else {

              $html = $html  . "<p>Não foram encontradas atividades</p>";
            }
        }
        $html = $html .'</div><br><br><br>';
        $conn->close();
    }

    $html = $html . '</div><br>'; //end
    
    
    
    create_header("indexcss2","validadeSearchForm");
    
    create_content($html);
    
    create_footer();
    
    
