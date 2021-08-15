<?php
    
    //Search for activities file
    
    require_once 'php/estrutura/structure.php';
    require_once 'php/db/connect.php';

    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(!isset($_SESSION['admin'])){
        
        header("Location: /admin/index.php");
    }
    
    $pesquisa="";
    if(isset($_POST['campoPesquisa'])){
        $pesquisa = $_POST['campoPesquisa'];
    }
    
    $html = '<div id="container1">
                <div id="container">
                    <div id="box" "><a href="ver_atividades.php"><button class="adminBot" >Ver todas as Atividades</button></a>
                         <a href="ver_utilizadores.php"><button class="adminBot" >Ver todos os Utilizadores</button></a>
                         <a href="ver_tickets.php"><button class="adminBot" >Ver tickets</button></a><h2>Atividades</h2>';
    $conn = create_connection();
    
    $html = $html . '<div id="srcWrap"><form action="ver_atividades.php" id="searchForm" name="searchForm" onsubmit="return validateSearchFormAndSubmut()" method="POST">
                        <input id="campoPesquisa"  class="input" name="campoPesquisa" type="text" placeholder="Pesquisar por nome..." >

                        <input id="submit" type="submit" src="/css/images/search2.jpg" value="Pesquisar"/></form></div>
                    <div id="tableDiv" ">';
        
    
    $sql = "SELECT atividades.id,nome,descricao,local,img0,isPublic,id_utilizador,linkMaps,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('%$pesquisa%') ORDER BY nome";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $html = $html . '<form method="POST" action="delete_ativ.php" id="delForm"></form><table id="contentTable">
                            <tr id="tableHeader"><th>Id</th><th>Nome</th><th>Descrição</th><th>Categoria</th><th>Local</th><th>Link da Imagem</th><th>Visibilidade</th><th>Dono</th></th><th>Google Maps</th><th>Ação</th><th><input class="adminBotSmall" type="submit" name="submit" value="X" form="delForm"><br><input type="checkbox" onClick="toggle(this)" /></th></tr>';
              
        $i=0;
        
        while($row = $result->fetch_assoc()){
                
            
            
            $id = $row['id'];
            $nome = $row['nome'];
            $descricao = $row['descricao'];
            $local = $row['local'];
            $linkMaps = $row['linkMaps'];
            $id_user = $row['id_utilizador'];
            $visibilidade = "" . $row['isPublic'];
            $imagem = $row['img0'];
            $categoria = $row['categoria'];
            
            if($local === 'none'){
                $local = 'N/A';
            }
            
            $maps = '<a href="'.$linkMaps.'"><button class="adminBotSmall">Abrir</button></a>';
            if($linkMaps === "none"){
                $maps = 'N/A';
            }
            
            if($visibilidade === "0"){
                $visibilidade = 'Privado';
            }else if($visibilidade === "1"){
                $visibilidade = 'Publico';
            }
            
            
            /*$html = $html . '<a href="ativ.php?a='.$row['nome'].'"><div class="ativDiv" id="ativSrcDiv"><h1>'.$row['nome'].'</h1>'.$local.'<br>'
                . '<img id="ativImg0" src="'.$row['img0'].'" alt=""> <br>'
                . '<p>'.$row['descricao'].'</p></div></a>'
                . '<br>';*/
            
            
            $html = $html . '<tr id="tab'.$i.'"'."><td>$id</td><td>$nome</td><td>$descricao</td><td>$categoria</td><td>$local</td><td>$imagem</td><td>$visibilidade</td><td>$id_user</td><td>".$maps."</td><td>".'<a href="ver_comentarios.php?id='.$id.'&nome='.$nome.'"><button class="adminBotSmall">C</button></a><a href="delete_ativ.php?id='.$id.'"><button class="adminBotSmall">X</button></a>'.'</td><td><input type="checkbox" name="checkboxes[]" value="'.$id.'" form="delForm"></td></tr>';
            
            if($i === 0){
                $i = 1;
            }else{
                $i = 0;
            }
            
            
            
        }
        $html = $html . "</table> ";
            
        
        
    } else {
        
      $html = $html . "<p>Não foram encontradas atividades</p>";
    }
    
    $conn->close();
    
        $html = $html . '</div>
                </div>
            </div></div>';
    
    $html = $html .'<br><br><br>';
    
    $html = $html .'<br><br><br>';
    create_header("admincss1", "checkboxes");

    create_content($html);
    
    create_footer();


