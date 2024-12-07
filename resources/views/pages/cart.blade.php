<x-app-layout>
    <section class="py-5 px-5">
        @if(count($cart) == 0)
            <div class="d-flex justify-content-center">
                <h2>Der Warenkorb ist leer</h2>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a class="btn btn-dark me-2" href="{{ route('home') }}">Einkauf fortsetzen</a>
            </div>
        @else
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">#</th>
                    <th scope="col d-none" class="d-none d-lg-table-cell"></th>
                    <th scope="col">Produkt</th>
                    <th scope="col">Anzahl</th>
                    <th scope="col">Preis</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $i => $item)
                    <tr>
                        <th class="d-none d-lg-table-cell" scope="row">{{ $i + 1 }}</th>
                        <td class="d-none d-lg-table-cell"><img src="{{ $item['product']->images[0]->path }}" class="thumbnail" alt=""></td>
                        <td>{{ $item['product']->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" id="form-{{ $item['product']->id }}">
                                @csrf
                                @method('PUT')
                                <div class="d-flex align-items-center my-2">
                                    <button type="button" class="btn btn-danger decrement" data-id="{{ $item['product']->id }}">-</button>
                                    <input style="width: 50px;" class="form-control" value="{{ $item['amount'] }}" type="text" name="amount" id="amount-{{ $item['product']->id }}">
                                    <button type="button" class="btn btn-success increment" data-id="{{ $item['product']->id }}">+</button>
                                </div>
                            </form>
                        </td>
                        <td>{{ number_format($item['product']->price * $item['amount'], 2, ',', '.') }} €</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item['product']->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Entfernen</button>
                            </form>
                        </td>
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
            <h4>Gesamtpreis: {{ number_format($total, 2, ',', '.') }} €</h4>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a class="btn btn-dark me-2" href="{{ route('home') }}">Einkauf fortsetzen</a>
            <button class="btn btn-primary">Zur Kasse</button>
        </div>
        @endif
    </section>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('.decrement').on('click', function() {
                    let id = $(this).data('id');
                    let amount = $('#amount-' + id);
                    if (parseInt(amount.val()) > 0) {
                        amount.val(parseInt(amount.val()) - 1);
                        $('#form-' + id).submit();
                    }
                });

                $('.increment').on('click', function() {
                    let id = $(this).data('id');
                    let amount = $('#amount-' + id);
                    amount.val(parseInt(amount.val()) + 1);
                    $('#form-' + id).submit();
                });

                $('.delete-form').on('submit', function(e) {
                    if (!confirm('Sind Sie sicher, dass Sie diesen Artikel entfernen möchten?')) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
