<?php
    
    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';
    
    session_set_cookie_params(7200);
    session_start();
    
    if(!isset($_SESSION['id']) || !isset($_SESSION['nome'])){
        header("Location: /index.php");
    }
    
    $nome = $_SESSION['nome'];
    
    $conn = create_connection();
    $sql = "SELECT * FROM utilizadores WHERE nome LIKE '".$nome."'" ;
    $result = $conn->query($sql);
    $isCurrent = false;
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()){
            $html = $html . '<div class="ativDiv"><h1>'.$row['nome'].'</h1></div><br>';
        

            if($_SESSION['nome']===$row['nome']){
                $isCurrent = true;
            }
        }
        
        if($isCurrent){
            $html = $html . '<a href="/conteudo/atividades/criar_atividade.php"><button class="adminBot" >Adicionar uma atividade</button></a><br>'
                    . '<a href="ver_tudo.php"><button class="adminBot" >Ver as minhas atividades</button></a>'
                    . '<br><br>'
                    . '<a href="apagar_utilizador.php"><button class="adminBot" >Apagar utilizador</button></a>';
        }
        
        
        
        
    } else {
        
      $html = "Não foi possivél carregar os dados do utilizador";
    }

    create_header("displayusercss1","");
    
    create_content($html);
    
    create_footer();
    

?>