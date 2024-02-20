window.addEventListener("load", function(){
    toggleLoader();
    
})

function toggleLoader (){
    let loader = document.getElementById("preloader");
    loader.style.display ="none";
}

async function getCurrencyCodes () {
    let fromInput = document.getElementById('from');
    let toInput = document.getElementById('to');

    
    try {
        await fetch('http://127.0.0.1:8000/currencyCodeData')
        .then((res) => res.json())
        .then((res) => {
            res.forEach((item) => {

                item.forEach((val) => {
                    // console.log(val)
                    // From dropdown options
                    let fromOptions = document.createElement('option');
                    fromOptions.text = `${val[0]} - ${val[2]}`;
                    fromInput.add(fromOptions)

                    // To dropdown options
                    let toOptions = document.createElement('option');
                    toOptions.text = `${val[0]} - ${val[2]}`;
                    toInput.add(toOptions)
                }  
                );
            });
        })
       
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    

    
}

getCurrencyCodes();