<x-customer-email>
    <div class="email-body">
        <h2>{{ __('Bestätigung Ihrer Zahlung') }}</h2>
        <p>{{ __('Hallo') }} {{ $customerName }},</p>
        <p>
            {{ __('Wir freuen uns, Ihnen mitteilen zu können, dass wir Ihre Zahlung für die Bestellung') }}
            <strong>{{ $order->id }}</strong> 
            {{ __('soeben erhalten haben.') }}
        </p>
        <h3>{{ __('Details zur Zahlung:') }}</h3>
        <ul>
            <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $order->created_at }}</li>
            <li><strong>{{ __('Zahlungsdatum:') }}</strong> {{ $paidDate  }}</li>
            <li><strong>{{ __('Gesamtbetrag:') }}</strong> {{ number_format($order->total,2,".",",") }} €</li>
        </ul>
        <p>
            {{ __('Ihre Bestellung wird nun weiter bearbeitet. Sobald sie versendet wurde, erhalten Sie eine weitere E-Mail mit den Versanddetails.') }}
        </p>
        <p>
            {{ __('Falls Sie Fragen haben oder Unterstützung benötigen, können Sie uns gerne kontaktieren:') }}
                </p>
        <p>{{ __('Vielen Dank für Ihren Einkauf bei') }} <strong>{{ config('app.name') }}</strong>!</p>
    </div>
    
</x-customer-email>