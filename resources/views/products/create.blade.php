@extends('layout.app')
@section('content')
    <div class="container">
        <form action="" id='myForm' method="POST">
            <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Product Name</label>
                        <input id='productName' type="text" name="name" class="form-control" required placeholder="Product Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label f>SKU</label>
                        <input type="text" class="form-control" name="sku" id="productSku" placeholder="sku">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Description</label>
                        <textarea type="text" id="productDes" class="form-control" name="description" rows="4" cols="50"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Short Description</label>
                        <textarea type="text" id="productShortDes" class="form-control" name="short_description" rows="4"
                            cols="50"></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Brand</label>
                        <select id="productBrand" name="brand_id" required  class="form-control">
                            <option value="" selected>Choose...</option>
                            <option value="1">walton</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" id="productPrice">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Discount Price</label>
                        <input type="number" class="form-control" name="dis_price" required  id="productDisPrice">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Category</label>
                        <select id="productCategory" name="category_id" required  class="form-control">
                            <option value="" selected>Choose...</option>
                            <option value="1">walton</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" id="productStock">
                    </div>
                </div>

                <table class="table table-bordered" id="dynamicTable">
                    <tr>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="size[]" placeholder="size" class="form-control" /></td>
                        <td><input type="text" name="color[]" placeholder="color" class="form-control" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        </td>
                    </tr>
                </table>

                <button type="submit" class="btn btn-primary">Create</button>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $('#myForm').submit(function(e) {
            e.preventDefault();
            const form = document.getElementById('myForm');
            const formData = new FormData(form);
            createProduct(formData);
        });
        function createProduct(data) {
            axios.post('/product', data, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(function(response) {
                    if (response.data == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Created Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.getElementById("myForm").reset();
                    } else {

                    }
                }).catch(function(error) {

                });
        }

        var i = 0;

        $("#add").click(function() {

            $("#dynamicTable").append(
                '<tr><td><input type="text" name="size[]" placeholder="size" class="form-control" /></td><td><input type="text" name="color[]" placeholder="color" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
