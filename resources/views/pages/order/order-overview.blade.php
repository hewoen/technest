<x-app-layout>
    <x-order-step-statusbar step="2" />
    <section class="py-5 px-5">
        <h2>{{ __('Rechnungs- und Lieferadresse') }}</h2>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="salutation">{{ __('Anrede') }}</label>
                    <select disabled id="salutation" name="salutation" style="width: 70px;" class="form-control">
                        <option></option>
                        <option @selected($customerInformation['salutation'] == __('Herr'))>{{ __('Herr') }}</option>
                        <option @selected($customerInformation['salutation'] == __('Frau'))>{{ __('Frau') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="prename">{{ __('Vorname') }}</label><br>
                        <input class="form-controll" value="{{ $customerInformation['prename'] }}" disabled
                            type="text" name="prename" id="prename">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lastname">{{ __('Nachname') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['lastname'] }}"
                            type="text" name="lastname" id="lastname">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="street">{{ __('Straße') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['street'] }}"
                            type="text" name="street" id="street">
                    </div>
                </div>
                <div class="col">

                    <div class="form-group">
                        <label for="street">{{ __('Hausnummer') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['house_number'] }}"
                            type="text" name="house_number" id="house_number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="zip">{{ __('Postleitzahl') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['zip'] }}" type="text"
                            name="zip" id="zip">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="place">{{ __('Ort') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['place'] }}"
                            type="text" name="place" id="place">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="mail">{{ __('E-Mail') }}</label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['email'] }}"
                            type="text" name="email" id="email">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone">{{ __('Telefonnummer (optional)') }} </label><br>
                        <input class="form-controll" disabled value="{{ $customerInformation['phone'] }}"
                            type="text" name="phone" id="phone">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h4>{{ __('Artikel') }}</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">#</th>
                    <th scope="col">{{ __('Produkt') }}</th>
                    <th scope="col">{{ __('Anzahl') }}</th>
                    <th scope="col">{{ __('Preis') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $i => $item)
                    <tr>
                        <th class="d-none d-lg-table-cell" scope="row">{{ $i + 1 }}</th>
                        <td>{{ $item['product']->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST"
                                id="form-{{ $item['product']->id }}">
                                @csrf
                                @method('PUT')
                                <div class="d-flex align-items-center my-2">
                                    {{ $item['amount'] }}
                                </div>
                            </form>
                        </td>
                        <td>{{ number_format($item['product']->price * $item['amount'], 2, ',', '.') }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            @php
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['product']->price * $item['amount'];
                }
            @endphp
            <h4>{{ __('Gesamtpreis') }}: {{ number_format($total, 2, ',', '.') }} €</h4>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <form action="{{ route('order.payment') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Weiter') }}</button>
            </form>
        </div>
    </section>

</x-app-layout>
