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
    
    if(!isset($_GET['id']) || !isset($_GET['nome']) ){
        
        header("Location: /admin/ver_atividades.php");
    }
    
    $pesquisa="";
    if(isset($_POST['campoPesquisa'])){
        $pesquisa = $_POST['campoPesquisa'];
    }
    $conn = create_connection();
    
        
    $id_ativ_get=$_GET['id'];
    
    
    $nome=$_GET['nome'];
    $html = '<div id="container1">
                <div id="container">
                    <div id="box" "><a href="ver_atividades.php"><button class="adminBot" >Ver todas as Atividades</button></a>
                         <a href="ver_utilizadores.php"><button class="adminBot" >Ver todos os Utilizadores</button></a>
                         <a href="ver_tickets.php"><button class="adminBot" >Ver tickets</button></a><h2>Comentários de '.$nome.'</h2>';
    
    
    $html = $html . '<div id="srcWrap"><form action="ver_comentarios.php?id='.$id_ativ_get.'&nome='.$nome.'" id="searchForm" name="searchForm" onsubmit="return validateSearchFormAndSubmut()" method="POST">
                        <input id="campoPesquisa"  class="input" name="campoPesquisa" type="text" placeholder="Pesquisar por nome de utilizador..." >

                        <input id="submit" type="submit" src="/css/images/search2.jpg" value="Pesquisar"/></form></div><div id="tableDiv" ">';
        
    $sql = "SELECT avaliacoes.id,quantidade,comentario,id_ativ,utilizadores.nome FROM avaliacoes JOIN utilizadores ON utilizadores.id = avaliacoes.id_util WHERE id_ativ = $id_ativ_get AND utilizadores.nome LIKE '%".$pesquisa."%'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        
        $html = $html . '<form method="POST" action="delete_rate.php" id="delForm"></form> <table id="contentTable">
                            <tr id="tableHeader"><th>Id</th><th>Quantidade</th><th>Texto</th><th>Atividade</th><th>Utilizador</th><th>Ação</th><th><input class="adminBotSmall" type="submit" name="submit" value="X" form="delForm"><br><input type="checkbox" onClick="toggle(this)" /></th></tr>';

        $i=0;
        
        while($row = $result->fetch_assoc()){
                
            
            
            $id = $row['id'];
            $quantidade = "" . $row['quantidade'];
            $comentario = $row['comentario'];
            $id_ativ = "" . $row['id_ativ'];
            $user = $row['nome'];
            
            
            /*$html = $html . '<a href="ativ.php?a='.$row['nome'].'"><div class="ativDiv" id="ativSrcDiv"><h1>'.$row['nome'].'</h1>'.$local.'<br>'
                . '<img id="ativImg0" src="'.$row['img0'].'" alt=""> <br>'
                . '<p>'.$row['descricao'].'</p></div></a>'
                . '<br>';*/
            
            
            $html = $html . '<tr id="tab'.$i.'"'."><td>$id</td><td>$quantidade</td><td>$comentario</td><td>$id_ativ: $nome</td><td>$user</td><td>".'<a href="delete_rate.php?id='.$id.'&id_ativ='.$id_ativ.'&nome_ativ='.$nome.'"><button class="adminBotSmall">X</button></a>'."</td>".'</td><td><input type="checkbox" name="checkboxes[]" value="'.$id.'" form="delForm"></td></tr>';
            
            if($i === 0){
                $i = 1;
            }else{
                $i = 0;
            }
            
            
            
        }
        $html = $html . "</table> ";
            
        
        
    } else {
        
      $html =$html . "<p>Não foram encontrados comentários</p>";
    }
    
    $html = $html . '</div>
                </div>
            </div></div>';
    $html = $html .'<br><br><br>';
    $html = $html .'<br><br><br>';
    $conn->close();

    create_header("admincss1", "checkboxes");

    create_content($html);
    
    create_footer();


