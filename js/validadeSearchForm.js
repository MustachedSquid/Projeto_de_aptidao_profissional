function validateSearchFormAndSubmut() {
    
    return validadeSearch();
    
    

    
        
    

}

function validadeSearch() {

    let cPesq = document.getElementById("campoPesquisa");
    
    let cLocal = document.getElementById("campoLocal");
    
    let pesq = document.forms["searchForm"]["campoPesquisa"].value;
    
    /*
    if(cLocal.value !== "none"){
        return true;
    }*/
    
    if (pesq === "") {
//        alert("O nome está vazio");
//        cPesq.style.border = "2px solid red";
        
//        cPesq.placeholder = "Pesquisa vazia";
        return true;
    }
    
    
    if (pesq.match("^[\r\n|\n|\ráàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ!?.,a-zA-Z0-9_ ]+?$") === null) {
//        alert("O nome só pode conter letras");
        
        cPesq.placeholder = "Erro: Caracteres inválidos!";
        cPesq.style.border = "2px solid red";
        return false;
    }
    
    return true;



}


function validadeLocal() {
    
    let cLocal = document.getElementById("campoLocal");
    
    cLocal.style.border = "";

    return true;



}

function focInPesq(){
    
    let cPesq = document.getElementById("campoPesquisa");
    
    cPesq.style.border = "";
    
    let pes = cPesq.value;
    
    cPesq.placeholder = "Pesquisa...";
}

function focOutPesq(){
}

function focInLocal(){
    
    let cLocal = document.getElementById("campoLocal");
    
    
}

function focOutLocal(){
    validadeLocal();
}

//main function
function main() {
    
    let campoPesq = document.getElementById("campoPesquisa");
    let campoLocal = document.getElementById("campoLocal");
    
    campoPesq.addEventListener("focus",focInPesq);
    campoPesq.addEventListener("focusout",focOutPesq);
    
    campoLocal.addEventListener("focus",focInLocal);
    campoLocal.addEventListener("focusout",focOutLocal);
    
    
}

window.addEventListener("load", main);
