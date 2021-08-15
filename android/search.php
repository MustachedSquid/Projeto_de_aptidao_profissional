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
    if(!isset($_POST['campoPesquisa']) || !isset($_POST['campoLocal'])){
        $html = "0;Dados em falta";
    }else{
        $pesquisa = $_POST['campoPesquisa'];
        $local = $_POST['campoLocal'];

        $sqlEnd = "";

        if($local !== 'none'){
            $sqlEnd = "AND LOWER(local) LIKE LOWER('".$local."')";
        }
        //SELECT atividades.id,nome,descricao,cidade,img0 FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE nome LIKE '%Ink%' 


        // Check connection
        if ($conn->connect_error) {$html = "4,Timeout";
        }
        $result = null;

        if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $pesquisa) || $pesquisa === ""){

            $sql = "SELECT atividades.id,nome,local,descricao,img0,linkMaps,isPublic,categoria FROM atividades LEFT OUTER JOIN imagens ON atividades.id=imagens.id_atividade WHERE LOWER(nome) LIKE LOWER('%".$pesquisa."%') ".$sqlEnd . "ORDER BY nome";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {


                while($row = $result->fetch_assoc()){
                    $lm = $row['linkMaps'];
                    if(trim($lm)===""){
                        $lm="none";
                    }
                    $cat = $row['categoria'];
                    if(trim($cat)===""){
                        $cat="none";
                    }

                    if($row['isPublic']==="1"){
                        $html = $html . $row['id'].';'.$row['nome'].';'.$cat.';'.$row['local'].';'.$row['descricao'].';'.$row['img0'].';' . "" .$lm.'#';
                    }

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

