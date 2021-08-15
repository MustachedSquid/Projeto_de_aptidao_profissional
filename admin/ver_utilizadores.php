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
                         <a href="ver_tickets.php"><button class="adminBot" >Ver tickets</button></a><h2>Utilizadores</h2>';
    $conn = create_connection();
    
    $html = $html . '<div id="srcWrap"><form action="ver_utilizadores.php" id="searchForm" name="searchForm" onsubmit="return validateSearchFormAndSubmut()" method="POST">
                        <input id="campoPesquisa"  class="input" name="campoPesquisa" type="text" placeholder="Pesquisar por nome..." >

                        <input id="submit" type="submit" src="/css/images/search2.jpg" value="Pesquisar"/></form></div><div id="tableDiv" ">';
        
    $sql = "SELECT * FROM utilizadores WHERE LOWER(nome) LIKE LOWER('%$pesquisa%')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $html = $html . ' <form method="POST" action="delete_user.php" id="delForm"></form><table id="contentTable">
                            <tr id="tableHeader"><th>Id</th><th>Nome</th><th>E-mail</th><th>Ação</th><th><input class="adminBotSmall" type="submit" name="submit" value="X" form="delForm"><br><input type="checkbox" onClick="toggle(this)" /></th></tr>';
                             
        $i=0;
        while($row = $result->fetch_assoc()){
                
            $id = $row['id'];
            $nome = $row['nome'];
            $email = $row['email'];
            
            
            
            
            $html = $html . '<tr id="tab'.$i.'"'."><td>$id</td><td>$nome</td><td>$email</td><td>".'<a href="delete_user.php?id='.$id.'"><button class="adminBotSmall">X</button></a>'."</td>".'</td><td><input type="checkbox" name="checkboxes[]" value="'.$id.'" form="delForm"></td></tr>';
            
            
            if($i === 0){
                $i = 1;
            }else{
                $i = 0;
            }
            
            
        }
        $html = $html . "</table> ";
            
        
    } else {
        
      $html =$html . "<p>Não foram encontrados utilizadores</p>";
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


