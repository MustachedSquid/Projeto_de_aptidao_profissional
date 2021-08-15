<?php

    
    
    require_once 'php/estrutura/structure.php';
    require_once 'php/db/connect.php';

    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(!isset($_SESSION['admin'])){
        
        header("Location: /admin/index.php");
    }
    
    if(!isset($_GET['id'])){
        header("Location: /admin/ver_ticket.php");
    }
    
    $html = "";
    
    $conn = create_connection();
    
    $id = $_GET['id'];
    
    if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $id)){
        
        $sql = "SELECT * FROM tickets WHERE id = ".$id.";";
                

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        
            $est=1;
            if($row['estado']==='1'){
                $est=0;
            }
                
            $sql2 = "UPDATE tickets SET estado=$est WHERE id = $id";

            $result = $conn->query($sql2);
            

            

        }else{

            create_header("admincss1", "validadeLogInForm");
            create_content("Erro: Ticket não existe");
            create_footer();

            die();
        }
        
    }else{

        create_header("admincss1", "validadeLogInForm");
        create_content("Erro: Dados inválidos");
        create_footer();
        die();
    }
    
    
    
    $conn->close();
    
    header("Location: /admin/ver_tickets.php");
    