<html>

<head>@vite(['resources/js/app.js']) </head>

<body>
    <div class="wrapper">
        <div class="checkout container">
            <header>
                <div class="credit-card-wrapper mt-5">
                    <div class="credit-card">
                        <div class="credit-card__front">
                            <div class="credit-card__front__top"></div>
                            <div class="credit-card__front__middle">
                                <div class="text-black credit-card__card-number mt-3">
                                    <input type="text" id="card-number" disabled>
                                </div>
                                <div class="text-black credit-card__expiration-date">
                                    <input type="text" id="expir" disabled>
                                </div>
                                <div class="credit-card__chip">
                                    <div class="credit-card__chip__inner"></div>
                                </div>
                            </div>
                            <div class="credit-card__front__bottom"></div>
                        </div>
                        <div class="credit-card__back"></div>
                    </div>
                </div>
            </header>
            @if (session('msg'))
                <div class="alert alert-success">
                    <p>tuttapposto</p>
                </div>
            @endif
            @if (count($errors) > 0)
                <p>errore</p>
            @endif

            <form method="post" id="payment-form"
                action="{{ route('admin.payments.checkout', ['apartment' => $apartment->id, 'sponsorship' => $sponsorship->id]) }}">
                @csrf
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount"
                                value="{{ $sponsorship->price }}">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Test Transaction</span></button>
            </form>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.36.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
    <script>
        const cardInput = document.getElementById("card-number");
        const cardNumberInput = document.getElementById("credit-card-number");
        const expiInput = document.getElementById("expir");
        const expirationInput = document.getElementById("expiration");

        cardNumberInput.addEventListener("input", () => {
            cardInput.value = cardNumberInput.value.replace(/\s+/g, '').replace(/(\d{4})/g, '$1 ').trim();

        });

        expirationInput.addEventListener("input", () => {
            expiInput.value = expirationInput.value.replace(/(\d{2})/, '$1/').trim();
        });
    </script>



</body>

</html>
