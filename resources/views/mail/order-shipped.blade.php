<x-customer-email>
    <h2>{{ __('Ihre Bestellung') }} {{ $order->id }} {{ __('wurde versendet!') }}</h2>
    <p>{{ __('Hallo') }} {{ $customerName }},</p>
    <p>
        {{ __('wir freuen uns, Ihnen mitteilen zu können, dass Ihre Bestellung mit der Nummer') }} 
        <strong>{{ $order->id }}</strong> {{ __('soeben versendet wurde.') }} 
    </p>
    <h3>{{ __('Details:') }}</h3>
    <ul>
        <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $order->created_at }}</li>
        <li><strong>{{ __('Versanddatum:') }}</strong> {{ $shippedDate }}</li>
    </ul>
    <p>{{ __('Vielen Dank, dass Sie bei') }} <strong>{{ config('app.name') }}</strong> {{ __('bestellt haben!') }}</p>
</x-customer-email>