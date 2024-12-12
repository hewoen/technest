<x-customer-email>
    <h2>{{ __('Bestellung') }} {{ $orderNumber }} {{ __('storniert') }}</h2>
    <p>{{ __('Hallo') }} {{ $customerName }},</p>
    <p>
        {{ __('Wir möchten Sie darüber informieren, dass Ihre Bestellung mit der Bestellnummer') }} 
        <strong>{{ $orderId }}</strong> {{ __('storniert wurde.') }}
    </p>
    <h3>{{ __('Details zur Stornierung:') }}</h3>
    <ul>
        <li><strong>{{ __('Bestelldatum:') }}</strong> {{ $orderDate }}</li>
        <li><strong>{{ __('Stornierungsdatum:') }}</strong> {{ $cancellationDate }}</li>
    </ul>
    <p>
        {{ __('Falls bereits eine Zahlung erfolgt ist, wird der Betrag innerhalb von 5–7 Werktagen auf Ihr Konto zurückerstattet. Sollten Sie hierzu Fragen haben, können Sie uns jederzeit kontaktieren.') }}
    </p>
    <h3>{{ __('Kontaktmöglichkeiten:') }}</h3>
    <p>
        - <strong>{{ __('E-Mail:') }}</strong> support@{{ config('app.name') }}.com<br>
        - <strong>{{ __('Telefon:') }}</strong> +49 (0)123 456 789
    </p>
</x-customer-email>
<div class="email-footer">
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Alle Rechte vorbehalten.</p>
</div>
</div>
</x-customer-email>