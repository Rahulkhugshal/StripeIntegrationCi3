<!DOCTYPE html>
<html>
<head>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body>
    
   <div class="card-container">
        <div class="card">
            <div class="card-header">
            <?php 
                if(!empty($msg)){
                    echo 'Payment '.$msg;
                }else{
                    echo ' Pay Now !';
                }
            ?>
            </div>
            <div class="card-body">
                <p>Enter your card details to complete the payment.</p>
                <form id="payment-form" action='<?php echo base_url('Checkout')?>' method='post'>
                    <!-- Stripe Element -->
                    <div id="card-element" class="input-element"></div>
                    <div id="card-errors" role="alert"></div>
                    <button class="btn" id="submit-button" type="submit">Pay Now</button>
                </form>
            </div>
            <div class="card-footer">
                <small>Powered by RahulKhugshal</small>
            </div>
        </div>
    </div>
    <script>
        var stripe = Stripe(''); // Replace with your publishable key
        var elements = stripe.elements();

        // Create an instance of the card Element.
        var card = elements.create('card',
        {
            style: {
                base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSize: "16px",
                    "::placeholder": { color: "#aab7c4" },
                },
                invalid: {
                    color: "#fa755a",
                },
            },
    });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form.
            form.submit();
        }
    </script>
</body>
</html>
