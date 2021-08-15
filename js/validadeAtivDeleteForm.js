function validateAtivDeleteFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    

    document.getElementById("ativForm").submit();
        
    

}

function validadeId() {

    let cId = document.getElementById("campoId");
    
    let id = cId.value;


    if (id === "") {
        return false;
    }

    if (id.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {


        return false;
    }
    
    return true;



}

//main function
function main() {

    let campoNome = document.getElementById("campoId");
    
    
}

window.addEventListener("load", main);
