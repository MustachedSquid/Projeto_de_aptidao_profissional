<?php

    require_once '../../php/estrutura/structure.php';
    require_once '../../php/db/connect.php';

    if(!isset($_SESSION['id']) && !isset($_SESSION['nome'])){
        header("Location: /index.php");
    }
    
    $html = '<div id="container1">
                <div id="container">
                    <div id="box">
                        <form id="ativForm" name="ativForm" action="/php/admin_ativ/create.php" onsubmit="return validateAtivCreationFormAndSubmit()" method="POST">
                            Nome da atividade: <br>
                            <input class="input" id="campoNome" type="text" name="campoNome"><br><br><sup id="cNameSup"></sup>
                            
                            <input  id="submit" name="botSubmit" type="submit" value="Criar">
                        </form>
                    </div>
                </div>
            </div>
         
            ';
    
    create_header("atividadecss2","validadeAtivCreateForm");
    
    create_content($html);
    
    create_footer();

