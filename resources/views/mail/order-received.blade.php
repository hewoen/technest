<x-customer-email>
    <h2>{{ __('Vielen Dank für Ihre Bestellung, !') }}</h2>
    <p>
        {{ __('Wir haben Ihre Bestellung mit der Nummer') }} <strong>{{ $order_id }}</strong> {{ __('erhalten') }}.
        {{ __('Sobald wir Ihre Zahlung bestätigt haben, wird Ihre Bestellung bearbeitet.') }}
    </p>
    <hr>
    <div>
        <h3>{{ __('Bestellte Artikel') }}</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">{{ __('Produkt') }}</th>
                    <th scope="col">{{ __('Anzahl') }}</th>
                    <th scope="col">{{ __('Preis pro Stück') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->amount }}</td>
                        <td>{{ $orderDetail->product->price € }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><b>{{ (__('Gesamtbetrag: ')) }}</b> {{ $total }}</p>
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
    <p>{{ __('Vielen Dank, dass Sie bei uns einkaufen!') }}</p>
</div>
</x-customer-email>