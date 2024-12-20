<x-app-layout>
    <x-order-step-statusbar step="3" />
    <div class="row">
        <div class="col mt-2">
            <div id="checkout">
                <!-- Checkout will insert the payment form here -->
            </div>
        </div>
    </div>
 
    <x-slot name="scripts">
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            // Initialize Stripe.js
            const stripe = Stripe(
                '{{ config('services.stripe.public_key') }}'
    
            );
    
            initialize();
    
            // Fetch Checkout Session and retrieve the client secret
            async function initialize() {
                const fetchClientSecret = async () => {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    const response = await fetch("{{ route('stripe.create-checkout-session') }}", {
                        method: "POST",
                        body: formData
                    });
                    const {
                        clientSecret
                    } = await response.json();
                    return clientSecret;
                };
    
                // Initialize Checkout
                const checkout = await stripe.initEmbeddedCheckout({
                    fetchClientSecret,
                });
    
                // Mount Checkout
                checkout.mount('#checkout');
            }
        </script>
    </x-slot>
</x-app-layout>