<x-app-layout>
    <div class="admin-dashboard">
        <div class="d-flex justify-content-end mt-1 px-1 mr-2">
            <a class="btn btn-primary" href="{{ route('products.create') }}">{{ __('Produkt hinzufügen') }}</a>
        </div>
        <section class="py-5">
            <x-product-list :products="$products" role="admin" />
        </section>
    </div>
</x-app-layout>
