<?php


    require_once 'configPath.php';
    require_once PATH . 'papPhpConfigs/dbConstants.php';
    require_once PATH . 'php/db/connect.php';


    function get_top(): string
    {
        $conn = create_connection();

        $html = "";

        $sqlQuantidade = "SELECT SUM(quantidade) AS top, id_ativ FROM `avaliacoes` JOIN atividades ON atividades.id = id_ativ WHERE atividades.isPublic LIKE 1 GROUP BY id_ativ ORDER BY top DESC";

        $resultQuantidade = $conn->query($sqlQuantidade);
        
        if ($resultQuantidade->num_rows > 0) {

            
            $i=0;
            while($rowQ = $resultQuantidade->fetch_assoc()){
                
                
                $i++;
                
                $sql = "SELECT atividades.id,nome,descricao,local,imagens.img0,isPublic,linkMaps,atividades.id_utilizador FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE atividades.id = ".$rowQ['id_ativ']."";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    
                    $row = $result->fetch_assoc();
                            
                    $local = $row['local'];
                    if($local === 'none'){
                        $local = '';
                    }

                    if($i===1 || $i===4 || $i===7 ){
                        $html = $html . '<div class="recoAtivFlex">';
                    }
                    
                    $html = $html . '<div class="recoAtivWrap"><a class="aR" href="conteudo/atividades/ativ.php?a='.$row['nome'].'"><div class="recoAtiv"><h3>'.$i.'</h3><h1>' . $row['nome'] . '</h1>' . $local . '<br>'
                        . '<img id="ativImg0" src="' . $row['img0'] . '" alt=""></div></a></div>';
                    
                    
                    if($i === 3 || $i===6 ||$i===9 ){
                        $html = $html . '</div>';
                    }
                }
                if($i===9){
                    break;
                }
            }
        } else {
            
            return "Não existe nada para recomendar";
        }
        
        return $html;
    }