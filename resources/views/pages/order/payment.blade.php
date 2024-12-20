@php
use App\Enums\PaymentMethod;
@endphp
<x-app-layout>
    <x-order-step-statusbar step="3" />
    <section class="py-5 px-5">
       <h4>{{ __('Bitte wählen Sie Ihre Zahlungsmethode') }}</h4>
       <form action="{{ route('order.processPayment') }}" method="post">
         @csrf
         <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="{{ PaymentMethod::BANK_TRANSFER->value }}" checked>
            <label class="form-check-label" for="exampleRadios1">
                {{ __('Banküberweisung (Bearbeitunszeit: 1-3 Werktage)') }}
            </label>
         </div>
         <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="{{ PaymentMethod::STRIPE->value }}">
            <label class="form-check-label" for="exampleRadios2">
               {{ __('Kreditkarte, Paypal, Sofortüberweisung (sofort über Stripe)') }}
            </label>
         </div>
         <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary">{{ __('Kostenpflichtig bestellen') }}</button>
         </div>
       </form>
    </section>
</x-app-layout>
