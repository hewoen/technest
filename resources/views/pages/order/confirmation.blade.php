<x-app-layout>
    <x-order-step-statusbar step="4" />
    <section class="py-5 px-5">
        <h4>{{ __('Vielen Dank für Ihre Bestellung') }}!</h4>
        <div>
            {{ __('Ihnen wurde soeben eine Eingangsbestätigung per E-Mail zugesandt.') }} <br>
        </div>
        @if ($paymentMethod=="bank_transfer")
            <div>
                <hr>
                {{ __('Sie haben sich für eine Zahlung per Banküberweisung entschieden.') }} <br>
                {{ __('Bitte überweisen Sie den Gesamtbetrag Ihrer Bestellung auf das unten stehende Konto. Ihre Bestellung wird bearbeitet, sobald die Zahlung bei uns eingegangen ist.') }}
                <div class="mt-2">
                    <b>{{ __('Kontoinhaber') }}:</b> Technet <br>
                    <b>{{ __('Bank') }}:</b> Musterbank AG <br>
                    <b>{{ __('IBAN') }}:</b> DE89 3704 0044 0532 0130 00 <br>
                    <b>{{ __('BIC (SWIFT)') }}:</b> COBADEFFXXX <br>
                    <b>{{ __('Verwendungszweck') }}:</b> {{ __(' Bestellnummer') }} {{ $order_id }}

                </div>

            </div>
        @endif
    </section>


</x-app-layout>
