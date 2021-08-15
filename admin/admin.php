<?php



    require_once "php/estrutura/structure.php";

    CONST ADMINNAME = "admin";
    CONST ADMINPASS = "123admin123";



    $js = "";
    $html ="";
    
    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(isset($_POST['campoNome']) && isset($_POST['campoPassword'])){
        $nome = $_POST['campoNome'];
        $password = $_POST['campoPassword'];

        if($nome === ADMINNAME && $password === ADMINPASS){
            $_SESSION['admin'] = true;
        }else{
            session_unset();
            $html = "<p>Dados inválidos</p>";
        }
    }
    
    if(isset($_SESSION['admin'])){
        if($_SESSION['admin']===true){
            
            //Codigo caso ja tenha a sessão iniciada
            $html = '<div id="container1">
                <div id="container">
                    <div id="box" ">
                         <h2>Administração</h2><br>
                         <a href="ver_atividades.php"><button class="adminBot" >Ver todas as Atividades</button></a><br>
                         <a href="ver_utilizadores.php"><button class="adminBot" >Ver todos os Utilizadores</button></a><br>
                         <a href="ver_tickets.php"><button class="adminBot" >Ver tickets</button></a>
                    </div>
                </div>
            </div>
            ';
        }
    }else{
        header("Location: /admin/index.php");
    }



    create_header("admincss1", "validadeLogInForm");
    create_content($html);
    create_footer();

    

