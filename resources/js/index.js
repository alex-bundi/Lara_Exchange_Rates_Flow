window.addEventListener("load", function(){
    toggleLoader();
    
})

function toggleLoader (){
    let loader = document.getElementById("preloader");
    loader.style.display ="none";
}

function getCurrencyCodes () {
    url = 'http://127.0.0.1:8000/currencyCodeData';
    fetch(url)
    .then(function(res){
        console.log(res.text())
    })
}

getCurrencyCodes();