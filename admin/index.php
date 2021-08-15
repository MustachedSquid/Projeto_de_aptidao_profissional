<?php

    require_once 'php/estrutura/structure.php';

    
    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: /index.php");
        
    }
    
    if(isset($_SESSION['admin'])){
        if($_SESSION['admin']===true){
            header("Location: admin.php");
        }
    }
    
    $html = '<div id="container1">
                <div id="container">
                    <div id="box">
                    <h2>Administração</h2>
                        <form action="admin.php" id="logForm" name="logForm" onsubmit="return validateUserLogInFormAndSubmit()" method="POST">
                        Nome:<br>
                        <input class="input" type="text" name="campoNome" id="campoNome"><br><sup id="cNameSup"></sup><br>
                        Password:<br>
                        <input class="input" type="password" name="campoPassword" id="campoPassword"><br><sup id="cPassSup"></sup><br>
                        <input id="submit" type="submit" value="Log In"></form>
                    </div>
                </div>
            </div>
         ';
    
    
    create_header("admincss1", "validadeLogInForm");
    
    create_content($html);
    
    create_footer();