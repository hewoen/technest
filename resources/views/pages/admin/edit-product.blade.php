<x-app-layout>
  <div class="container ">
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
      @endif
      <div class="card">
          <div class="card-header d-flex justify-content-between">Produkt bearbeiten <a href="{{ route('dashboard') }}"
                  class="btn btn-primary">Zurück</a></div>
          <div class="card-body">
              <div class="col-md-auto">
                  <form enctype="multipart/form-data" method="POST" action="{{ route('products.update',$product->id) }}">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input value='{{ $product->name }}' name="name" type="text" class="form-control" id="exampleInputEmail1"
                              aria-describedby="emailHelp" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Bilder</label>
                        <div>
                        @foreach ($product->images as $image)
                            <img src="{{ $image->path }}" class="thumbnail" alt="">
                        @endforeach
                        </div>
                          <input class="form-control"  type="file" id="files" name="images[]" multiple>
                      </div>
                      <div class="form-group">
                          <label class="form-check-label" for="exampleCheck1">Bestand</label>
                          <input value="{{ $product->stock }}" style="width: 80px;" type="number" name="stock" class="form-control" id="quantity"
                              name="quantity" value="1" min="1">
                      </div>
                      <div class="form-group">
                          <label class="form-check-label" for="exampleCheck1">Preis</label>
                          <input value="{{ $product->price }}" style="width: 80px;" type="number" name="price" step="0.01" placeholder="0.00" class="form-control" name="price" id="quantity"
                              name="price" >
                      </div>
                      <div class="form-group">
                          <label for="comment">Beschreibung:</label>
                          <textarea class="form-control" id="editor" name="description" id="comment">{!! $product->description !!}</textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mt-2">Produkt ändern</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  {{-- <div class="row justify-content-md-center">
      <div class="col-md-auto">
          <form enctype="multipart/form-data" method="POST" action="{{ route('products.store') }}">
              <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="Enter Name">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlFile1">Images</label>
                  <input type="file" id="files" name="files[]" multiple>
              </div>
              <div class="form-group">
                  <label class="form-check-label" for="exampleCheck1">Stock</label>
                  <input style="width: 70px;" type="number" class="form-control" id="quantity" name="quantity"
                      value="1" min="1">
              </div>
              <div class="form-group">
                  <label for="comment">Description:</label>
                  <textarea class="form-control" rows="5" id="comment"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div> --}}
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
