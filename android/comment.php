<?php
    /*Error codes:

    * 0 = Missing data
    * 1 = Ativ doesn't exist
    * 2 = wrong password
    * 3 = invalid data
    * 4 = connection failed
    * 5 = success


    */
    const SERVERNAME = ""; //TODO: Adicionar dados de bd.
    const USERNAME = ""; //TODO: Adicionar dados de bd.
    const PASSWORD = ""; //TODO: Adicionar dados de bd.
    const DBNAME = ""; //TODO: Adicionar dados de bd.


    $html = "";

    if(!isset($_POST['campoIdAtiv']) || !isset($_POST['campoComentario']) || !isset($_POST['campoRate']) || !isset($_POST['campoId'])){
        $html = "0;Dados em falta";
    }

    $id = $_POST['campoIdAtiv'];
    $rate = intval($_POST['campoRate']);
    $comment = $_POST['campoComentario'];
    $id_user = $_POST['campoId'];

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    // Check connection
    if ($conn->connect_error) {

        $html = "4;Timeout";
    }else{

        if(preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $id)){

            $sql = "SELECT atividades.id,nome FROM atividades WHERE id = $id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if($rate>0 && $rate<=10 && preg_match("/^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$/", $comment)){

                    $rateValue = 0;
                    switch ($rate){
                        case 1: $rateValue = -5; break;
                        case 2: $rateValue = -4; break;
                        case 3: $rateValue = -3; break;
                        case 4: $rateValue = -2; break;
                        case 5: $rateValue = -1; break;
                        case 6: $rateValue = 1; break;
                        case 7: $rateValue = 2; break;
                        case 8: $rateValue = 3; break;
                        case 9: $rateValue = 4; break;
                        case 10: $rateValue = 5; break;
                    }
                    $sql2 = "INSERT INTO `avaliacoes` (`quantidade`, `comentario`, `id_ativ`, `id_util`) VALUES ('".$rateValue."', '".$comment."', '".$row['id']."', '".$id_user."');";

                    $result = $conn->query($sql2);

                    $html = "5;Sucesso";
                }else{
                    $html = "3;Dados de comentario inválidos";
                }



            }else{
                $html = "1;Dados em falta";
            }

        }else{
            $html = "3;Dados inválidos";
        }

    }

    $conn->close();
    echo $html;