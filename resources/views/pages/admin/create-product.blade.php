<x-app-layout>
    <div class="container ">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">{{ __('Produkt hinzufügen') }} <a href="{{ route('dashboard') }}"
                    class="btn btn-primary">{{ __('Zurück') }}</a></div>
            <div class="card-body">
                <div class="col-md-auto">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('products.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Name') }}</label>
                            <input value='{{ old('name') }}' name="name" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">{{ __('Bilder') }}</label>
                            <input class="form-control"  type="file" id="files" name="images[]" multiple>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="exampleCheck1">{{ __('Bestand') }}</label>
                            <input value="{{ old('stock') }}" style="width: 80px;" type="number" name="stock" class="form-control" id="quantity"
                                name="quantity" value="1" min="1">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="exampleCheck1">{{ __('Preis') }}</label>
                            <input value="{{ old('price') }}" style="width: 80px;" type="number" name="price" step="0.01" placeholder="0.00" class="form-control" name="price" id="quantity"
                                name="price" >
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ __('Beschreibung:') }}</label>
                            <textarea class="form-control" id="editor" name="description" id="comment">{!! old('description') !!}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">{{ __('Produkt erstellen') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <x-slot name="scripts">
        <script>
            tinymce.init({
                selector: 'textarea#editor',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        </script>
    </x-slot>
</x-app-layout>
