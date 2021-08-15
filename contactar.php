<?php

    require_once 'php/estrutura/structure.php';

    
    $email = "";
    
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        
    }
            
    
    
    
    $html = '<div id="container1">
                <div id="container">
                    <div id="box">
                        <form id="ticketForm" name="ticketForm" action="/php/admin_user/create_ticket.php" onsubmit="return validateTicketFormAndSubmit()" method="POST">
                            Qual é o seu problema:<br>
                            <input class="input" id="campoNome" type="text" name="campoNome"><br><br><sup id="cNameSup"></sup><br>
                            
                            Descricreva o problema:<br>
                            
                            <textarea class="input" id="campoDescricao" name="campoDescricao" cols="40" rows="5"></textarea><br><br><sup id="cDescSup"></sup><br>

                            Email:<br>
                            <input class="input" id="campoEmail" type="text" name="campoEmail" value="'.$email.'"><br><sup id="cEmailSup"></sup><br>
                            
                            <input  id="submit" name="botSubmit" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
         
            ';
    
    create_header("ticketcss1","validadeTicketCreateForm");
    
    create_content($html);
    
    create_footer();

