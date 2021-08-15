<?php
    
    require_once 'php/estrutura/structure.php';

    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: index.php");
    }
    
    $html = '
            
            <div id="container1">
                <div id="container">
                    <div id="box">
                        <form action="php/session/login.php" id="logForm" name="logForm" onsubmit="return validateUserLogInFormAndSubmit()" method="POST">
                        Nome de utilizador:<br>
                        <input class="input" type="text" name="campoNome" id="campoNome"><br><sup id="cNameSup"></sup><br>
                        Password:<br>
                        <input class="input" type="password" name="campoPassword" id="campoPassword"><br><sup id="cPassSup"></sup><br>
                        <input id="submit" type="submit" value="Log In"></form>
                    </div>
                </div>
            </div>
         ';
    
    create_header("registercss1","validadeLogInForm");
    
    create_content($html);
    
    create_footer();
