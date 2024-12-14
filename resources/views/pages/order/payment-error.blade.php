<x-app-layout>
    <x-order-step-statusbar step="4" />
    <section class="py-5 px-5">
        <h4>{{ __('Fehler bei der Zahlungsabwicklung') }}!</h4>
        <div>
        </div>
        {{ __('Bei der Zahlungsabwicklung über unseren Zahlungsdienstleister Stripe ist zu einem Fehler gekommen. Bitte nehmen Sie Kontakt mit dem Support auf ') }} <a href="mailto:support@technet.test">support@technet.test</a> <br>
        {{ __('Ihre Stripe Session-ID lautet: ') }} {{ $stripe_session_id }}
    </section>


</x-app-layout>
