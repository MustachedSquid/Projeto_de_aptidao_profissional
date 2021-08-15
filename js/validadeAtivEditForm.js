function validateAtivEditFormAndSubmit() {
    
    if(!validadeName()){
        return false;
    }
    
    if(!validadeDescricao()){
        return false;
    }
    
    if(!validadeLinkMaps()){
        return false;
    }
    

    document.getElementById("editAtivForm").submit();
        
    

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

    if ( descricao.trim() === "") {
        return true;
    }
    if (descricao.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
        sup.innerHTML = "<sup>A descrição só pode conter letras, numeros, espaços, ! ? . , _ </sup>";
        cDesc.style.border = "2px solid red";
        return false;
    }
    
    return true;



}

function validadeLinkMaps() {

    let cLink = document.getElementById("campoLinkMaps");
    
    let sup = document.getElementById("cLinkSup");
    
    let linkMaps = cLink.value;
    

    if(linkMaps.match("none")){
        return true;
    }
    
    if (linkMaps.match("^https:\/\/www.google.[A-Za-z]+\/maps\/[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?&|%+.@!:\/,-=]+?$") === null
            && linkMaps.match("^https:\/\/goo.gl\/maps\/[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ%+.@!:\/,-=]+?$") === null ) {
//        alert("O nome só pode conter letras");
        sup.innerHTML = "<sup>O link não é válido! </sup>";
        cLink.style.border = "2px solid red";
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

function focInDescricao(){
    
    let cDesc = document.getElementById("campoDescricao");
    
    cDesc.style.border = "";
    
    let sup = document.getElementById("cDescSup");
    sup.innerHTML = "";
}

function focOutDescricao(){
    validadeDescricao();
}

function focInLinkMaps(){
    
    let cLink = document.getElementById("campoLinkMaps");
    
    cLink.style.border = "";
    
    let sup = document.getElementById("cLinkSup");
    sup.innerHTML = "";
}

function focOutLinkMaps(){
    validadeLinkMaps();
}


//main function
function main() {

    let campoNome = document.getElementById("campoNome");
    
    campoNome.addEventListener("focus",focInNome);
    campoNome.addEventListener("focusout",focOutNome);
    
    
    let campoDescricao = document.getElementById("campoDescricao");
    
    campoDescricao.addEventListener("focus",focInDescricao);
    campoDescricao.addEventListener("focusout",focOutDescricao);
    
    
    let campoLinkMaps = document.getElementById("campoLinkMaps");
    
    campoLinkMaps.addEventListener("focus",focInLinkMaps);
    campoLinkMaps.addEventListener("focusout",focOutLinkMaps);
    
    
}

window.addEventListener("load", main);
