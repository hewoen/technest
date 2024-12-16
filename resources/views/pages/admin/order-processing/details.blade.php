<x-app-layout>
    <section class="py-5 px-5">
        <h3>{{ __('Informationen zur Bestellung') }}</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">{{ __('Bestellnummer') }}</th>
                    <th scope="col d-none" class="d-none d-lg-table-cell">{{ __('Bestelldatum') }}</th>
                    <th scope="col">{{ __('Bestellstatus') }}</th>
                    <th scope="col">{{ __('Zahlungsmethode') }}</th>
                    <th scope="col">{{ __('Zahlungsstatus') }}</th>
                    <th scope="col">{{ __('Kunde') }}</th>
                    <th scope="col">{{ __('Umsatz') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $customer = json_decode($order->delivery_address);
                @endphp
                <tr>
                    <th class="d-none d-lg-table-cell" scope="row">{{ $order->id }}</th>
                    <td class="d-none d-lg-table-cell">{{ $order->created_at }}</td>
                    <td>{{ $order->order_status->label() }}</td>
                    <td>{{ $order->payment_method->label() }}</td>
                    <td>{{ $order->payment_status->label() }}</td>
                    <td>
                        {{ $customer->salutation }}<br>
                        {{ $customer->prename }} {{ $customer->lastname }}<br>
                        <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a><br>
                        {!! $customer->phone!="" ?  $customer->phone . "<br>" : "" !!}
                        {{ $customer->street }} {{ $customer->house_number }}<br>
                        {{ $customer->zip }} {{ $customer->place }}
                    </td>
                    <td>{{ $order->total }}</td>
                </tr>
            </tbody>
        </table>
        <h3>{{ __('Enthaltene Produkte') }}</h3>
        <hr>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">#</th>
                    <th scope="col d-none" class="d-none d-lg-table-cell"></th>
                    <th scope="col">{{ __('Produkt') }}</th>
                    <th scope="col">{{ __('Anzahl') }}</th>
                    <th scope="col">{{ __('Umsatz') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $i => $orderDetail)
                    <tr>
                        <th class="d-none d-lg-table-cell" scope="row">{{ $i + 1 }}</th>
                        <td class="d-none d-lg-table-cell"><img src="{{ $orderDetail->product->images[0]->path }}" class="thumbnail" alt=""></td>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->amount }}</td>
                        <td>{{ number_format($orderDetail->product->price * $orderDetail->amount, 2, ',', '.') }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>{{ __('Bestellhistorie') }}</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">{{ __('Datum') }}</th>
                    <th scope="col d-none" class="d-none d-lg-table-cell">{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderHistory as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->status->label() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>{{ __('Aktion') }}</h3>
        <form action="{{ route('order-processing.update', $order->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center">
                <div class="form-group me-2">
                    <label for="action">{{ __('Aktion auswählen') }}</label>
                    <select style="width:200px;" class="form-control" id="action" name="action">
                        <option value="mark_as_paid">{{ __('Als bezahlt markieren') }}</option>
                        <option value="mark_as_shipped">{{ __('Als versendet markieren') }}</option>
                        <option value="cancel_order">{{ __('Bestellung stornieren') }}</option>
                    </select>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Aktion ausführen') }}</button>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>
