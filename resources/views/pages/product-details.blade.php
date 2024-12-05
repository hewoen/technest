<x-app-layout>
    <div class="product-details">
        <div class="row">
            <div class="col-1 d-block d-md-none">
            </div>
            <div class="col-10 d-block d-md-none">
                <h2>{{ $product->name }}</h2>
                <h6 class="my-2">Auf Lager: {{ $product->stock }} Stück</h6>
                <h6 class="my-2">Preis: {{ str_replace('.', ',', $product->price) }} €</h6>
                <div class="d-flex align-items-center my-2">
                    <button class="btn btn-danger decrement">-</button>
                    <input style="width: 50px;" class="form-control" value="0" type="text" name="amount" id="">
                    <button class="btn btn-success increment">+</button>
                </div>
                <button type="button" class="btn btn-dark put-into-cart">In den Warenkorb</button>
                <p>{!! $product->description !!}</p>
            </div>
            <div class="col-1 d-block d-md-none">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6"><img src="{{ $product->images[0]->path }}" alt=""></div>
            <div class="col-4 d-none d-md-block">
                <h2>{{ $product->name }}</h2>
                <h6 class="my-2">Auf Lager: {{ $product->stock }} Stück</h6>
                <h6 class="my-2">Preis: {{ str_replace('.', ',', $product->price) }} €</h6>
                <div class="d-flex align-items-center my-2">
                    <button class="btn btn-danger decrement">-</button>
                    <input style="width: 50px;" class="form-control" value="0" type="text" name="amount" id="">
                    <button class="btn btn-success increment">+</button>
                </div>
                <button type="button" class="btn btn-dark put-into-cart">In den Warenkorb</button>
                <p>{!! $product->description !!}</p>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                var notyf = new Notyf();

                $('.decrement').on('click', function() {
                    let amount = $('input[name="amount"]');
                    if (parseInt(amount.val()) > 0) {
                        amount.val(parseInt(amount.val()) - 1);
                    }
                });

                $('.increment').on('click', function() {
                    let amount = $('input[name="amount"]');
                    amount.val(parseInt(amount.val()) + 1);
                });

                $('.put-into-cart').on('click', function() {
                    //Send a Ajax request to route 'cart.add' with the product id and the amount
                    //Increment the cart amount in the navbar by 1 if the request was successful
                    if($('input[name="amount"]').val()==0)
                    {
                        alert('Bitte geben Sie eine Stückzahl ein!');
                        return;
                    }
                    $.ajax({
                        url: "{{ route('cart.store') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id: {{ $product->id }},
                            amount: $('input[name="amount"]').val()
                        },
                        success: function(response) {
                            notyf.success('Das Produkt wurde in den Warenkorb gelegt!');
                            let cartAmount = $('.cart-amount');
                            cartAmount.text(parseInt(cartAmount.text()) + 1);
                        },
                        error: function(response) {
                            //If the field response.msg exists, show the message with notyf.error() otherwise show a default message
                            const defaultErrorMessage = 'Das Produkt konnte nicht in den Warenkorb gelegt werden!';
                            try{
                                response = JSON.parse(response.responseText);
                            }
                            catch(e){
                                response = {message: defaultErrorMessage};
                            }

                            if (response.message) {
                                notyf.error(response.message);
                            } else {
                                notyf.error(defaultErrorMessage);
                            }
                        }

                    });
                });
            });
        </script>
    </x-slot>
</x-app-layout>
