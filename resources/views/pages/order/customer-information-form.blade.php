<x-app-layout>
    <x-order-step-statusbar step="1" />

    <div class="container mt-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">Liefer- und Rechnungsadresse <button
                    onclick="if(confirm('Möchten Sie wirklich den Bestellprozess an dieser Stelle abbrechen?')) window.location.replace('{{ route('cart.index') }}')"
                    class="btn btn-primary">Zurück</button></div>
            <div class="card-body">
                <form method="POST" action="{{ route('order.process-customer-information') }}">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="salutation">{{ __('Anrede') }}*</label>
                                    <select id="salutation" name="salutation" style="width: 70px;" class="form-control">
                                        <option></option>
                                        <option @selected(old('salutation') == __('Herr'))>{{ __('Herr') }}</option>
                                        <option @selected(old('salutation') == __('Frau'))>{{ __('Frau') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="prename">{{ __('Vorname') }}*</label><br>
                                    <input class="form-controll" value="{{ old('prename') }}" type="text"
                                        name="prename" id="prename">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="lastname">{{ __('Nachname') }}*</label><br>
                                    <input class="form-controll" value="{{ old('lastname') }}" type="text"
                                        name="lastname" id="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="street">{{ __('Straße') }}*</label><br>
                                    <input class="form-controll" value="{{ old('street') }}" type="text"
                                        name="street" id="street">
                                </div>
                            </div>
                            <div class="col">

                                <div class="form-group">
                                    <label for="street">{{ __('Hausnummer') }}*</label><br>
                                    <input class="form-controll" value="{{ old('house_number') }}" type="text"
                                        name="house_number" id="house_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="zip">{{ __('Postleitzahl') }}*</label><br>
                                    <input class="form-controll" value="{{ old('zip') }}" type="text"
                                        name="zip" id="zip">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="place">{{ __('Ort') }}*</label><br>
                                    <input class="form-controll" value="{{ old('place') }}" type="text"
                                        name="place" id="place">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mail">{{ __('E-Mail') }}*</label><br>
                                    <input class="form-controll" value="{{ old('email') }}" type="text"
                                        name="email" id="email">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">{{ __('Telefonnummer (optional)') }} </label><br>
                                    <input class="form-controll" value="{{ old('phone') }}" type="text"
                                        name="phone" id="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mt-2">Weiter</button>
                    </div>
                </form>
            </div>
</x-app-layout>
