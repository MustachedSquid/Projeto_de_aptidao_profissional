<?php

    
    
    require_once 'php/estrutura/structure.php';
    require_once 'php/db/connect.php';

    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(!isset($_SESSION['admin'])){
        
        header("Location: /admin/index.php");
    }

    $deleteOne = true;
    if(!isset($_GET['id'])){
        if (!isset($_POST['submit'])) {
            header("Location: /admin/ver_tickets.php");
        }
        $deleteOne = false;
    }
    
    $html = "";
    
    $conn = create_connection();
    if( $deleteOne){
        $id = $_GET['id'];

        if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $id)){

            $sql = "SELECT * FROM tickets WHERE id = ".$id.";";


            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();



                $sql2 = "DELETE FROM tickets  WHERE id=".$id;

                $result = $conn->query($sql2);




            }else{

                $html = "Erro: Ticket não existe";
            }

        }else{

            $html = "Erro: Dados inválidos";
        }
    }else{
        $id = 0;
        foreach ($_POST['checkboxes'] as $selected){
            $id = $selected;

            if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $id)){

                $sql = "SELECT * FROM tickets WHERE id = ".$id.";";


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();



                    $sql2 = "DELETE FROM tickets  WHERE id=".$id;

                    $result = $conn->query($sql2);




                }else{

                    $html = "Erro: Ticket não existe";
                }

            }else{

                $html = "Erro: Dados inválidos";
            }
        }
    }


create_header("admincss1", "validadeLogInForm");
    create_content($html);
    create_footer();
    
    
    $conn->close();
    
    header("Location: /admin/ver_tickets.php");
    