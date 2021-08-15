function validateSearchFormAndSubmut() {
    
    return validadeSearch();
    
    

    
        
    

}

function validadeSearch() {

    let cPesq = document.getElementById("campoPesquisa");
    
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


function focInPesq(){
    
    let cPesq = document.getElementById("campoPesquisa");
    
    cPesq.style.border = "";


    cPesq.placeholder = "Pesquisa...";
}

function focOutPesq(){
}


//main function
function main() {
    
    let campoPesq = document.getElementById("campoPesquisa");
    
    campoPesq.addEventListener("focus",focInPesq);
    campoPesq.addEventListener("focusout",focOutPesq);
    
    
    
}

window.addEventListener("load", main);
