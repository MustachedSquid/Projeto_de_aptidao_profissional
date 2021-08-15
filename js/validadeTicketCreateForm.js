function validateTicketFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    
    if(!validadeDescricao()){
        return false;
    }
    
    if(!validadeEmail()){
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
function validadeDescricao() {

    let cDesc = document.getElementById("campoDescricao");
    
    let sup = document.getElementById("cDescSup");
    
    let descricao = cDesc.value;
    

    if (descricao.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("O nome só pode conter letras");
        sup.innerHTML = "<sup>A descrição só pode conter letras, números ou _ , ! ? .</sup>";
        cDesc.style.border = "2px solid red";
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

function focInNome(){
    
    let cNome = document.getElementById("campoNome");
    
    cNome.style.border = "";
    
    let sup = document.getElementById("cNameSup");
    sup.innerHTML = "";
}

function focOutNome(){
    validadeName();
}

function focInDescricao(){
    
    let cDesc = document.getElementById("campoDescricao");
    
    cDesc.style.border = "";
    
    let sup = document.getElementById("cDescSup");
    sup.innerHTML = "";
}

function focOutDescricao(){
    validadeDescricao();
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

//main function
function main() {

    let campoNome = document.getElementById("campoNome");
    
    campoNome.addEventListener("focus",focInNome);
    campoNome.addEventListener("focusout",focOutNome);
    
    
    let campoDescricao = document.getElementById("campoDescricao");
    
    campoDescricao.addEventListener("focus",focInDescricao);
    campoDescricao.addEventListener("focusout",focOutDescricao);
    
    let campoEmail = document.getElementById("campoEmail");
    
    campoEmail.addEventListener("focus",focInEmail);
    campoEmail.addEventListener("focusout",focOutEmail);
}

window.addEventListener("load", main);
