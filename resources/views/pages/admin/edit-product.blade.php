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
                    <form id="editProductForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="order" name="order" value="{[]}">
                        <input type="hidden" id="delete" name="delete" value="{[]}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input value='{{ $product->name }}' name="name" type="text" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Bilder</label>
                            <div id="images">
                                @foreach ($product->images as $image)
                                    {{-- <img draggable ondrag="console.log('drag')" ondragover="event.preventDefault()" ondrop="console.log(event.target.getAttribute('data-id'))" src="{{ $image->path }}" data-id="{{ $image->id }}" class="thumbnail" alt=""> --}}
                                    <img src="{{ $image->path }}" data-id="{{ $image->id }}" class="thumbnail me-1"
                                        alt="">
                                @endforeach
                            </div>
                            <input class="form-control" type="file" id="files" name="images[]" multiple>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="exampleCheck1">Bestand</label>
                            <input value="{{ $product->stock }}" style="width: 80px;" type="number" name="stock"
                                class="form-control" id="quantity" name="quantity" value="1" min="1">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="exampleCheck1">Preis</label>
                            <input value="{{ $product->price }}" style="width: 80px;" type="number" name="price"
                                step="0.01" placeholder="0.00" class="form-control" name="price" id="quantity"
                                name="price">
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
            let draggedImageId = null;

            function dragImage(event) {
                draggedImageId = event.target.getAttribute('data-id');
            }



            let imagesOrder = [];
            $(document).ready(function() {
                imagesOrder = getImageSources();
                attachEventListeners();

                $('#editProductForm').on('submit', function(e) {
                    let imagesToDelete = getImagesToDelete();

                    if(imagesToDelete.length > 0){
                        if(!confirm('Sind Sie sicher, dass Sie die ausgewählten Bilder löschen möchten?')){
                            e.preventDefault();
                        }
                        else{
                            document.getElementById('delete').value = JSON.stringify(imagesToDelete);
                        }
                    }
                    
                });
            });

            function getImagesToDelete(){
                let imagesToDelete = [];
                let images = document.getElementById('images').getElementsByTagName('img');
                for (let img of images) {
                    if (img.classList.contains('marked-image')) {
                        imagesToDelete.push(img.getAttribute('data-id'));
                    }
                }
                return imagesToDelete;
            }


            function attachEventListeners() {
                $("#images img").on('click',function(e){
                    e.target.classList.toggle('marked-image');
                });
                $("#images img").on('dragstart', dragImage);
                $("#images img").on('dragover', function(event) {
                    event.preventDefault();
                });
                $("#images img").on('drop', function(event) {
                    event.preventDefault();
                    let droppedImageId = event.target.getAttribute('data-id');
                    swapImages(draggedImageId, droppedImageId);
                });
            }



            function swapImages(from, to) {
                let fromIndex = imagesOrder.findIndex(img => img.id == from);
                let toIndex = imagesOrder.findIndex(img => img.id == to);
                let temp = imagesOrder[fromIndex];
                imagesOrder[fromIndex] = imagesOrder[toIndex];
                imagesOrder[toIndex] = temp;
                writeImagesToDom(imagesOrder);
            }

            function updateOrderField() {
                const orderField = document.getElementById('order');
                orderField.value = JSON.stringify(imagesOrder);
            }

            function writeImagesToDom(imgSources) {
                const imagesDiv = document.getElementById('images');
                imagesDiv.innerHTML = ''; // Clear the existing content

                imgSources.forEach(img => {
                    const imgElement = document.createElement('img');
                    imgElement.src = img.src;
                    imgElement.setAttribute('data-id', img.id);
                    imgElement.setAttribute('class', 'thumbnail me-1');

                    imagesDiv.appendChild(imgElement);
                    
                });
                attachEventListeners();
                updateOrderField();
            }

            function getImageSources() {
                const imagesDiv = document.getElementById('images');
                const imgElements = imagesDiv.getElementsByTagName('img');
                const imgSources = [];

                for (let img of imgElements) {
                    imgSources.push({
                        src: img.src,
                        id: img.getAttribute('data-id')
                    });
                }

                return imgSources;
            }

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
