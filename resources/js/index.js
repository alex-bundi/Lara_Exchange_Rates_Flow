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
                    toInput.add(toOptions);
                }  
                );
            });
        })
       
    } catch (error) {
        console.error('Error fetching data:', error);
    }

}

getCurrencyCodes();

// To display input error messages
function error (message) {
    
    message = message;
    const errorMessageElement = document.getElementById('error_message');

    errorMessageElement.textContent = message;
    errorMessageElement.style.visibility = "visible";
    errorMessageElement.style.color = "red";

    setTimeout(() => errorMessageElement.remove(), 3000); // Remove warning after 3 secs
}

function getCurrentRates () {

    let ratesForm = document.getElementById('conversion_rates');
    ratesForm.addEventListener('submit', (event) => {
        event.preventDefault();
        
        let amountInput = Number(document.getElementById('currency_amount').value.trim());
        let fromInput = document.getElementById('from');
        let toInput = document.getElementById('to');
        console.log(amountInput);
        if (!amountInput) {
            error('Please fill in the field to search for value...');
        }
    })
}
getCurrentRates();



