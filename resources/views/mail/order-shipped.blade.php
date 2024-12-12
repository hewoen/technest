<x-customer-email>
    <h2>{{ __('Ihre Bestellung') }} {{ $orderId }} {{ __('wurde versendet!') }}</h2>
    <p>{{ __('Hallo') }} {{ $customerName }},</p>
    <p>
        {{ __('Wir freuen uns, Ihnen mitteilen zu können, dass Ihre Bestellung mit der Nummer') }} 
        <strong>{{ $orderId }}</strong> {{ __('am') }} <strong>{{ $shippingDate }}</strong> {{ __('versendet wurde.') }}
    </p>
    <h3>{{ __('Sendungsverfolgung:') }}</h3>
    <p>
        {{ __('Sie können den Status Ihrer Lieferung jederzeit über den folgenden Link verfolgen:') }}
    </p>
    <p>
        <a href="{{ $trackingUrl }}">{{ __('Sendung verfolgen') }}</a>
    </p>
    <h3>{{ __('Details:') }}</h3>
    <ul>
        <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $orderDate }}</li>
        <li><strong>{{ __('Versanddatum:') }}</strong> {{ $shippingDate }}</li>
    </ul>
    <p>{{ __('Vielen Dank, dass Sie bei') }} <strong>{{ config('app.name') }}</strong> {{ __('bestellt haben!') }}</p>
</x-customer-email>