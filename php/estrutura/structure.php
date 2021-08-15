<?php

    require_once dirname(__FILE__).'/config.php';
    session_get_cookie_params(SESSIONTIME);
    session_start();
    
    $title="Paginas Amarelas Projeto";
    
    $html="";
    
    
    function create_header($css, $js){
        if(trim($css) === ""){
            
            $css = "default/default";
        }
        if(trim($js) === ""){
            
            $js = "default/default";
        }
        echo '<!DOCTYPE html>
                <html lang="pt">
                    <head>
                        <title>Procurar Atividades Portuguesas</title>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" type="text/css" href="/css/MenuAndFooter.css">
                        <link rel="stylesheet" type="text/css" href="/css/'.$css.'.css">
                        <link rel="icon" type="image/ico" href="/res/imagens/site/favicon.ico"/>
                        <script src="/js/'.$js.'.js"></script> 
                    </head><body>';
    }
    
    
    function create_content($html){
        
        $menuContent = '<div class="menuBotDiv"><a href="/login.php"><button class="menubot" ><b>Entrar</b></button></a> <a href="/registar.php"><button class="menubot" ><b>Registar</b></button></a>';
        
        if(isset($_SESSION['nome']) && isset($_SESSION['id'])){
            $menuContent ='<div class="menuBotDiv"><a href="/conteudo/perfis/perfil.php"><button class="menubot" ><b>Perfil</b></button></a>';
            $menuContent = $menuContent . ' <a href="/sair.php"><button class="menubot" ><b>Sair</b></button></a>';
        }
        
        $menuContent = $menuContent . ' <a href="/contactar.php"><button class="menubot" ><b>Contacte-nos</b></button></a></div>';
        
        
        echo '<div id="menu"><div id="logoBot"><a href="/index.php"><img id="logo" src="/css/images/papLogoV3.png" alt="Logotipo/placeholders"></a> '.$menuContent.' </div></div><div id="underMenu"><div id="underLogoBot"><a href="/index.php"><img id="underLogo" src="/css/images/papLogoV3.png" alt="Logotipo/placeholders"></a> '.$menuContent.' </div></div>'
        . '<div id="content">'
                . '<div id="contentContainer1"><div id="centerD">'.$html.'</div></div>';
    }
    
    
    function create_footer(){
        echo '</body>
                </html>
                ';
    }

