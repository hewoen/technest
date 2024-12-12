<x-customer-email>
    <div class="email-body">
        <h2>{{ __('Bestätigung Ihrer Zahlung') }}</h2>
        <p>{{ __('Hallo') }} {{ $userName }},</p>
        <p>
            {{ __('Wir freuen uns, Ihnen bestätigen zu können, dass wir Ihre Zahlung für die Bestellung') }}
            <strong>{{ $orderId }}</strong> 
            {{ __('erfolgreich erhalten haben.') }}
        </p>
        <h3>{{ __('Details zur Zahlung:') }}</h3>
        <ul>
            <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $orderDate }}</li>
            <li><strong>{{ __('Zahlungsdatum:') }}</strong> {{ $paymentDate }}</li>
            <li><strong>{{ __('Gesamtbetrag:') }}</strong> {{ $total }} €</li>
        </ul>
        <p>
            {{ __('Ihre Bestellung wird nun weiter bearbeitet. Sobald sie versendet wurde, erhalten Sie eine weitere E-Mail mit den Versanddetails.') }}
        </p>
        <p>
            {{ __('Falls Sie Fragen haben oder Unterstützung benötigen, können Sie uns gerne kontaktieren:') }}
            <br>
            <strong>{{ __('E-Mail:') }}</strong> support@{{ config('app.name') }}.com
        </p>
        <p>{{ __('Vielen Dank für Ihren Einkauf bei') }} <strong>{{ config('app.name') }}</strong>!</p>
    </div>
    
</x-customer-email>