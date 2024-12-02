<x-app-layout>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
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
    </div>

</x-app-layout>
