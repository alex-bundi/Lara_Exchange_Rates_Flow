window.addEventListener("load", function(){
    toggleLoader();
    
})

function toggleLoader (){
    let loader = document.getElementById("preloader");
    loader.style.display ="none";
}

async function getCurrencyCodes () {
    try {
        await fetch('http://127.0.0.1:8000/currencyCodeData')
        .then((res) => res.json())
        .then((res) => {
            console.log(JSON.stringify(res[0][0])) 
        })
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    

    
}

getCurrencyCodes();