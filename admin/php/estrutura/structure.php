
<?php
    
    require_once 'config.php';
    
    session_get_cookie_params(SESSIONTIME);
    session_start();
    
    $title="Paginas Amarelas Projeto";
    
    $css = "default/default";
    $js = "default/default";
    
    $html="";
    
    function create_header($css, $js){
        echo '<!DOCTYPE html>
                <html lang="pt">
                    <head>
                        <title>Procurar Atividades Portuguesas</title>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" type="text/css" href="/admin/css/MenuAndFooterAdmin.css">
                        <link rel="stylesheet" type="text/css" href="/admin/css/'.$css.'.css">
                        <link rel="icon" type="image/ico" href="/res/imagens/site/favicon.ico"/>
                        <script src="/admin/js/'.$js.'.js"></script> 
                    </head><body>';
    }
    
    
    function create_content($html){
        
        $menuContent = "";
        
         if(isset($_SESSION['admin'])){
            $menuContent ='<div class="menuBotDiv"><a href="/admin/admin.php"><button class="menubot" ><b>Admin</b></button></a>';
            $menuContent = $menuContent . ' <a href="/admin/sair.php"><button class="menubot" ><b>Sair</b></button></a></div>';
        } 
        echo '<div id="menu"><div id="logoBot"><a href="/index.php"><img id="logo" src="/css/images/papLogoV3.png" alt="Logotipo/placeholders"></a> '.$menuContent.' </div></div><div id="underMenu"><div id="underLogoBot"><a href="/index.php"><img id="underLogo" src="/css/images/papLogoV3.png" alt="Logotipo/placeholders"></a> '.$menuContent.' </div></div>'
        . '<div id="content">'
                . '<div id="contentContainer1"><div id="centerD">'.$html.'</div></div>';
    }
    
    
    function create_footer(){
        echo '</body>
                </html>
                ';
    }

