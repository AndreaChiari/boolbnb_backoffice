<html>

<head>@vite(['resources/js/app.js']) </head>

<body>
    <div class="wrapper">
        <div class="checkout container">
            <div class="credit-card-wrapper mt-5 d-flex justify-content-center">
                <div class="credit">
                    <div class="card-inner">
                        <div class="front">
                            <img src="https://i.ibb.co/PYss3yv/map.png" class="map-img">
                            <div class="row justify-content-between align-items-center">
                                <img src="https://i.ibb.co/G9pDnYJ/chip.png" class="chip-img">
                                <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="60px" class="visa">
                            </div>
                            <div class="rows card-no">
                                <input type="text" id="card-number" disabled>
                            </div>
                            <div class="row card-holder">
                                <p>BY</p>
                                <p>TEAM-6</p>
                            </div>
                            <div class="row name">
                                <p>nome e cognome</p>
                                <input type="text" id="expir" disabled>
                            </div>
                        </div>
                        <div class="back">
                            <img src="https://i.ibb.co/PYss3yv/map.png" class="map-img">
                            <div class="bar"></div>
                            <div class="row card-cvv ">
                                <div class="mb-2">
                                    <img src="https://i.ibb.co/S6JG8px/pattern.png">
                                </div>
                                <p>000</p>
                            </div>

                            <div class="row signature">
                                <p>CUSTOMER SIGNATURE</p>
                                <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="80px">
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            @if (count($errors) > 0)
                <p class="alert alert-danger text-center my-3">Transazione fallita</p>
            @endif
            <form method="post" id="payment-form"
                action="{{ route('admin.payments.checkout', ['apartment' => $apartment->id, 'sponsorship' => $sponsorship->id]) }}">
                @csrf
                <section>
                    <label for="amount">
                        <span class="input-label text-white">Prezzo:</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount"
                                value="{{ $sponsorship->price }}" readonly>
                        </div>
                    </label>
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button btn-pay bordered mt-3"><span>Paga ora</span></button>
            </form>
            <div class="d-flex justify-content-end">
                <a class="btn-pay bordered p-2 d-flex align-items-center justify-content-center"
                    href="{{ route('admin.apartments.index') }}"><span class="font-weight-bold">Torna alla
                        home</span></a>
            </div>
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
