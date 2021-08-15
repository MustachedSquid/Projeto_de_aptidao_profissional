function validateUserRegistrationFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    if(!validadeEmail()){
        return false;
    }
    if(!validadePassword()){
        return false;
    }
    

    document.getElementById("regForm").submit();
        
    

}

function validadeName() {

    let cNome = document.getElementById("campoNome");
    
    let sup = document.getElementById("cNameSup");
    
    let nome = document.forms["regForm"]["campoNome"].value;


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

function validadeEmail() {
    
    
    let cEmail = document.getElementById("campoEmail");
    
    let sup = document.getElementById("cEmailSup");
    
    let email = document.forms["regForm"]["campoEmail"].value;
    
    
    return true;
}

function validadePassword() {

    
    let cPass = document.getElementById("campoPassword");
    let cPassConf = document.getElementById("campoPasswordConf");
    
    
    let sup = document.getElementById("cPassSup");
    
    let supC = document.getElementById("cPassConfSup");
    
    let pass = document.forms["regForm"]["campoPassword"].value;
    let passConf = document.forms["regForm"]["campoPasswordConf"].value;

    
    if (pass === "") {
//        alert("Palavra-passe vazia, só pode conter Letras, Numeros e os sinais _.,!?");
        cPass.style.border = "2px solid red";
        sup.innerHTML = "A Palavra-passe só pode conter letras, numeros, espaços, ! ? . , _ ";
        
        return false;
        
    }


    if (pass.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("Palavra-passe inválida, só pode conter Letras, Numeros e os sinais _.,!?");
        cPass.style.border = "2px solid red";
        sup.innerHTML = "A Palavra-passe só pode conter letras, numeros, espaços, ! ? . , _ ";
        return false;

    }

    if (pass !== passConf) {
//        alert("As palavras-passe não são iguais");
        cPassConf.style.border = "2px solid red";
        supC.innerHTML = "As palavras-passe não são iguais";
        
        cPass.style.border = "2px solid red";
        sup.innerHTML = "As palavras-passe não são iguais";
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

function focInEmail(){
    
    let cEmail = document.getElementById("campoEmail");
    
    cEmail.style.border = "";
    
    let sup = document.getElementById("cEmailSup");
    sup.innerHTML = "";
    
}

function focOutEmail(){
    validadeEmail();
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

function focInPassConf(){
    
    let cPassConf = document.getElementById("campoPasswordConf");
    
    cPassConf.style.border = "";
    
    let sup = document.getElementById("cPassConfSup");
    sup.innerHTML = "";
    
    let cPass = document.getElementById("campoPassword");
    
    cPass.style.border = "";
    
    let supP = document.getElementById("cPassSup");
    supP.innerHTML = "";
}

function focOutPassConf(){
    validadePassword();
    
}

//main function
function main() {

    let campoNome = document.getElementById("campoNome");
    let campoEmail = document.getElementById("campoEmail");
    let campoPass = document.getElementById("campoPassword");
    let campoPassConf = document.getElementById("campoPasswordConf");
    
    campoNome.addEventListener("focus",focInNome);
    campoNome.addEventListener("focusout",focOutNome);
    
    campoEmail.addEventListener("focus",focInEmail);
    campoEmail.addEventListener("focusout",focOutEmail);
    
    campoPass.addEventListener("focus",focInPass);
    campoPass.addEventListener("focusout",focOutPass);
    
    campoPassConf.addEventListener("focus",focInPassConf);
    campoPassConf.addEventListener("focusout",focOutPassConf);
    
    
}

window.addEventListener("load", main);
