<?php
    /*Error codes:
    
     * 0 = Missing data
     * 1 = User doesn't exist
     * 2 = wrong password
     * 3 = invalid data
     * 4 = connection failed
     * 5 = success
     
     
    */

    //Search for activities file
    const SERVERNAME = ""; //TODO: Adicionar dados de bd.
    const USERNAME = ""; //TODO: Adicionar dados de bd.
    const PASSWORD = ""; //TODO: Adicionar dados de bd.
    const DBNAME = ""; //TODO: Adicionar dados de bd.


    // Create connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    $html = "";
    if(!isset($_POST['campoPesquisa'])){
        $html = "0;Dados em falta";
    }else {

        $pesquisa = $_POST['campoPesquisa'];
        //SELECT atividades.id,nome,descricao,cidade,img0 FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE nome LIKE '%Ink%' 


        // Check connection
        if ($conn->connect_error) {$html = "4,Timeout";
        }
        $result = null;

        if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa)){

            $sqlComment = "SELECT utilizadores.nome,quantidade,comentario,avaliacoes.id_ativ FROM utilizadores JOIN avaliacoes ON avaliacoes.id_util = utilizadores.id WHERE id_ativ = ".$pesquisa.";";
            $resultComment = $conn->query($sqlComment);

            if ($resultComment->num_rows > 0) {
                while($rowComment = $resultComment->fetch_assoc()){

                    $rateValue = 0;
                    switch ($rowComment['quantidade']){
                        case -5: $rateValue = 1; break;
                        case -4: $rateValue = 2; break;
                        case -3: $rateValue = 3; break;
                        case -2: $rateValue = 4; break;
                        case -1: $rateValue = 5; break;
                        case 1: $rateValue = 6; break;
                        case 2: $rateValue = 7; break;
                        case 3: $rateValue = 8; break;
                        case 4: $rateValue = 9; break;
                        case 5: $rateValue = 10; break;
                    }
                    $html = $html . ''. $rowComment['nome'].';'. $rateValue . ';'. $rowComment['comentario'].'#';
                }
            } else {

                $html = "1;Nada foi encontrado";
            }
        }else{
            $html ="3:Dados inválidos";
        }



    }
    
    
    $conn->close();

        
    echo $html;

