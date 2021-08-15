function validateUserRegistrationFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    

    document.getElementById("ativForm").submit();
        
    

}

function validadeName() {

    let cNome = document.getElementById("campoNome");
    
    
    let nome = cNome.value;


    if (nome === "") {
//        alert("O nome está vazio");
        return false;
    }

    if (nome.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("O nome só pode conter letras");
        return false;
    }
    
    return true;



}


function focInNome(){
    
}

function focOutNome(){
    validadeName();
}


//main function
function main() {

    let campoNome = document.getElementById("campoNome");
    
    campoNome.addEventListener("focus",focInNome);
    campoNome.addEventListener("focusout",focOutNome);
    
    
}

window.addEventListener("load", main);
