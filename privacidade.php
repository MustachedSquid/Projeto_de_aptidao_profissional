<?php
    
    require_once 'php/estrutura/structure.php';
    require_once 'php/estrutura/load_local.php';
    

    $js = "";
    $html = '
            <div id="container1">
                <div id="container">
                    <div id="box">
                
                        <h1>Política de Privacidade</h1>
                        
                        <h3>O que é o site Procurar Atividades Portuguesas:</h3>
                        
                        <p>Este web site foi criado no âmbito de um projeto Escola, e foi desenvólvido por um estudante do 12º ano de Escolaridade, em Portugal.</p>
                        
                        <h3>O site Procurar Atividades Portuguesas recolhe os seguintes dados:</h3>
                     
                        - Endereço de IP;<br>
                        - Nome de Utilizador;<br>
                        - Endereço de Email;<br>
                        - Palavra-passe;<br>
                        - Imagens enviadas pelo utilizador;<br>
                        - Localização de atividades enviadas;<br>
                        - Outros dados enviados pelo utilizador.<br>
                        
                        <h3>O site Procurar Atividades Portuguesas utiliza Cookies:</h3>
                        
                        <p>É utilizado um Cookie para guardar um identificador da sessão do utilizador.</p>
                        
                        <h3>Como é que o site Procurar Atividades Portuguesas utiliza os dados:</h3>
                        
                        <p>Os dados coletados são utilizados apenas para o funcionamento do site e não serão utilizados para publicidade ou enviados para terceiros.<br>
                        O endereço de Email e palavras-passe são dados privados.<br>
                        As palavras-passe são encriptadas.<br>
                        O nome de utilizador e informações enviadas para a criação de uma página de atividade ou comentário, serão publicamente acessíveis através do site Procurar Atividades Portuguesas.</p>
                        
                        <h3>Onde é que o site Procurar Atividades Portuguesas armazena os dados:</h3>
                        
                        <p>Os dados são armazenados numa base de dados juntamente com o site.</p>
                        
                        <h3>Direitos do utilizador:</h3>
                        
                        <p>O utilizador pode navegar pelo site sem criar conta e sem coleta de dados.<br>
                        Se optar por criar uma conta, é necessário o envio de dados.<br>
                        A qualquer momento o utilizador pode apagar todos os seus dados em conjunto com a sua conta, através de um botão encontrado no perfil da conta de utilizador.</p>

                    </div>
                </div>
            </div>
         <br><br><br>';
    
    
    
    create_header("registercss1","");
    
    create_content($html);
    
    create_footer();
    
    
