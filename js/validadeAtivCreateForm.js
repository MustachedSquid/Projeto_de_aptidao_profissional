function validateAtivCreationFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    

    document.getElementById("ativForm").submit();
        
    

}

function validadeName() {

    let cNome = document.getElementById("campoNome");
    
    let sup = document.getElementById("cNameSup");
    
    let nome = cNome.value;


    if (nome === "") {
//        alert("O nome está vazio");
        sup.innerHTML = ("O nome está vazio");
        cNome.style.border = "2px solid red";
        return false;
    }

    if (nome.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("O nome só pode conter letras");
        sup.innerHTML = "<sup>O nome só pode conter letras, numeros, espaços, ! ? . , _ </sup>";
        cNome.style.border = "2px solid red";
        return false;
    }
    
    return true;



}


function focInNome(){
    
    let cNome = document.getElementById("campoNome");
    
    cNome.style.border = "";
    
    let sup = document.getElementById("cNameSup");
    sup.innerHTML = "";
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
