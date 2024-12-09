<x-app-layout>
    <x-order-step-statusbar step="3" />
    <section class="py-5 px-5">
       <h4>Bitte wählen Sie Ihre Zahlungsmethode</h4>
       <form action="{{ route('order.processPayment') }}" method="post">
         @csrf
         <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="bank_transfer" checked>
            <label class="form-check-label" for="exampleRadios1">
                Per Banküberweisung (1-2 Werktage Bearbeitungszeit)
            </label>
         </div>
         <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="stripe">
            <label class="form-check-label" for="exampleRadios2">
                Sofort Paypal, Klarna, Kreditkarte (Stripe)
            </label>
         </div>
         <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary">Kostenpflichtig bestellen</button>
         </div>
       </form>
    </section>
</x-app-layout>
