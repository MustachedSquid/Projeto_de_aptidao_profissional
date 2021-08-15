function validateUserLogInFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    if(!validadePassword()){
        return false;
    }
    

    document.getElementById("logForm").submit();
        
    

}

function validadeName() {

    let cNome = document.getElementById("campoNome");
    
    let sup = document.getElementById("cNameSup");
    
    let nome = document.forms["logForm"]["campoNome"].value;


    if (nome === "") {
//        alert("O nome está vazio");
        sup.innerHTML = "O nome está vazio";
    
        cNome.style.border = "2px solid red";
        return false;
    }

    if (nome.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("O nome só pode conter letras");
        sup.innerHTML = "O nome só pode conter letras, numeros, espaços, ! ? . , _ ";
        cNome.style.border = "2px solid red";
        return false;
    }
    
    return true;



}


function validadePassword() {

    
    let cPass = document.getElementById("campoPassword");
    
    let sup = document.getElementById("cPassSup");
    
    let pass = document.forms["logForm"]["campoPassword"].value;

    
    if (pass === "") {
//        alert("Palavra-passe vazia, só pode conter Letras, Numeros e os sinais _.,!?");
        cPass.style.border = "2px solid red";
        sup.innerHTML = "A Palavra-passe só pode conter letras, numeros, espaços, ! ? . , _ ";
        
        return false;
        
    }


    if (pass.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$$") === null) {
//        alert("Palavra-passe inválida, só pode conter Letras, Numeros e os sinais _.,!?");
        cPass.style.border = "2px solid red";
        sup.innerHTML = "A Palavra-passe só pode conter letras, numeros, espaços, ! ? . , _ ";
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

function focInPass(){
    
    let cPass = document.getElementById("campoPassword");
    
    cPass.style.border = "";
    
    let sup = document.getElementById("cPassSup");
    sup.innerHTML = "";
    
}

function focOutPass(){
    validadePassword();
}

//main function
function main() {
    
    let campoNome = document.getElementById("campoNome");
    let campoPass = document.getElementById("campoPassword");
    
    campoNome.addEventListener("focus",focInNome);
    campoNome.addEventListener("focusout",focOutNome);
    
    campoPass.addEventListener("focus",focInPass);
    campoPass.addEventListener("focusout",focOutPass);
    
    
}

window.addEventListener("load", main);
