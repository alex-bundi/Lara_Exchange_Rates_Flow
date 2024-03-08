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
function error(message) {
    const errorMessageElement = document.getElementById('error_message');
    
    if (errorMessageElement) {
        errorMessageElement.textContent = message;
        errorMessageElement.classList.remove("hidden");
        errorMessageElement.style.color = "red";

        setTimeout(() => errorMessageElement.remove(), 10000); // Remove warning after 10 secs
    } else {
        // console.error("Error message element not found");
        location.reload(); // Avoids the element being null
    }
}

function getCurrentRates () {

    let ratesForm = document.getElementById('conversion_rates');
    ratesForm.addEventListener('submit', (event) => {
        event.preventDefault();
        
        let amountInput = parseFloat(document.getElementById('currency_amount').value.trim());
        let fromInput = document.getElementById('from').value;
        let toInput = document.getElementById('to').value.trim();
        
        if (!amountInput) {
            return error('Please fill in this field...');
        }
        if (amountInput ===  0) {
            return error('Please input a number.');
        } else {
            let fromCode = fromInput.trim().split('-');
            let toCode = toInput.trim().split('-');

            let convertRates = {
                amount: amountInput,
                fromCurrency: fromCode[0],
                toCurrency: toCode[0]
            } 

            let token = document.querySelector('input[name=_token').value;
            let url = 'http://127.0.0.1:8000/postRates';

            fetch(url, {
                method:'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-Token': token
                },
                body: JSON.stringify({
                    data:convertRates
                })
            })
            .then(res => res.text())
            .then((res) => {
                let responseType = JSON.parse(res)
                // if (responseType.message === 'Success'){
                   
                // }else {
                //     console.error('There is no response');
                // }
                console.log(responseType.message);
            })
            .catch((error) => console.error(error))

        }

        

    })
}
getCurrentRates();



