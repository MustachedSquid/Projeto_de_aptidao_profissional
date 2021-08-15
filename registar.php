<?php
    

    require_once 'php/estrutura/structure.php';
    
    if(isset($_SESSION['id']) && isset($_SESSION['nome'])){
        header("Location: index.php");
    }
    
    $html = '<div id="container1">
                <div id="container">
                    <div id="box">
                        <form id="regForm" name="regForm" action="php/session/register.php" onsubmit="return validateUserRegistrationFormAndSubmit()" method="POST">
                            Nome de utilizador: <br>
                            <input class="input" id="campoNome" type="text" name="campoNome"><br><sup id="cNameSup"></sup>
                            <br>Email: <br>
                            <input class="input" id="campoEmail" type="text" name="campoEmail"><br><sup id="cEmailSup"></sup>
                            <br>Palavra-passe: <br>
                            <input class="input" id="campoPassword" type="password" name="campoPassword"><br><sup id="cPassSup"></sup>
                            <br>Repetir palavra-passe: 
                            <br><input class="input" id="campoPasswordConf" type="password" name="campoPasswordConf"><br><sup id="cPassConfSup"></sup>
                            <br><input id="submit" name="botSubmit" type="submit" value="Registar">
                        </form>
                        <a href="privacidade.php">Politica de Privacidade</a>
                    </div>
                </div>
            </div>
         
            ';
    
    create_header("registercss1","validadeRegForm");
    
    create_content($html);
    
    create_footer();

