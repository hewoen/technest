<x-customer-email>
    <h2>{{ __('Bestellung storniert') }} </h2>
    <p>{{ __('Hallo') }} {{ $customerName }},</p>
    <p>
        {{ __('Wir möchten Sie darüber informieren, dass Ihre Bestellung mit der Bestellnummer') }} 
        <strong>{{ $order->id }}</strong> {{ __('storniert wurde.') }}
    </p>
    <h3>{{ __('Details zur Stornierung:') }}</h3>
    <ul>
        <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $order->created_at }}</li>
        <li><strong>{{ __('Stornierungsdatum:') }}</strong> {{ $cancellDate }}</li>
    </ul>
    <p>
        {{ __('Falls bereits eine Zahlung erfolgt ist, wird der Betrag innerhalb von 5–7 Werktagen auf Ihr Konto zurückerstattet. Sollten Sie hierzu Fragen haben, können Sie uns jederzeit kontaktieren.') }}
    </p>
<div class="email-footer">
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Alle Rechte vorbehalten.</p>
</div>
</div>
</x-customer-email>