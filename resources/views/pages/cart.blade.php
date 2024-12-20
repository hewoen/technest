<x-app-layout>
    <section class="py-5 px-5 cart">
        @if(count($cart) == 0)
            <div class="d-flex justify-content-center">
                <h2>{{ __('Der Warenkorb ist leer') }}</h2>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a class="btn btn-dark me-2" href="{{ route('home') }}">{{ __('Einkauf fortsetzen') }}</a>
            </div>
        @else
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col d-none" class="d-none d-lg-table-cell">#</th>
                    <th scope="col d-none" class="d-none d-lg-table-cell"></th>
                    <th scope="col">{{ __('Produkt') }}</th>
                    <th scope="col">{{ __('Anzahl') }}</th>
                    <th scope="col">{{ __('Preis') }}</th>
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
                            <form action="{{ route('cart.destroy', $item['product']->id) }}" method="POST" id="delete-form-{{ $item['product']->id }}">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:;" onclick="document.getElementById('delete-form-{{ $item['product']->id }}').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                    </svg>
                                </a>
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
            <h4>{{ __('Gesamtpreis') }}: {{ number_format($total, 2, ',', '.') }} €</h4>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a class="btn btn-dark me-2" href="{{ route('home') }}">{{ __('Einkauf fortsetzen') }}</a>
            <a href="{{ route('order.customer-information') }}" class="btn btn-primary">{{ __('Zur Kasse') }}</a>
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
                    if (!confirm('{{ __('Sind Sie sicher, dass Sie diesen Artikel entfernen möchten?') }}')) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
