@extends('layout.app')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products Tables</h6>
            </div>
            <div class="card-body">

                <form action="#" method="GET" class="form-filter form-create">
                    <div class="form-row justify-content-between">
                        <div class="col-md-3">
                            <select name="orderby" id="filter_order" class="form-control">
                                <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Price Range</span>
                                </div>
                                <input type="text" name="price_from"  id="filter_fprice aria-label="First name" placeholder="From" class="form-control">
                                <input type="text" name="price_to"  id="filter_tprice" aria-label="Last name" placeholder="To" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                                <select name="status" id="filter_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                                </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" id="filter" class="btn btn-primary float-right"><i class="fa fa-search">Filter</i></button>
                        </div>
                    </div>
                </form>



                <div class="table-responsive">
                    <table class="table table-bordered" id="pdataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>stock</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-lg" id="updateProductModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" id='updateForm' method="PUT">
                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Product Name</label>
                                    <input id='productName' type="text" name="name" class="form-control"
                                        placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label f>SKU</label>
                                    <input type="text" class="form-control" name="sku" id="productSku"
                                        placeholder="sku">
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
                                    <select id="productBrand" name="brand_id" class="form-control">
                                        <option selected>Choose...</option>
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
                                    <input type="number" class="form-control" name="dis_price" id="productDisPrice">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    <select id="productCategory" name="category_id" class="form-control">
                                        <option selected>Choose...</option>
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
                                    <td><input type="text" name="color[]" placeholder="color" class="form-control" />
                                    </td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add
                                            More</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a type="submit" data-id="" id="ProductEditConfirmBtn"
                                class="btn btn-primary">Update</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script type="text/javascript">
        getProductsData();
        function getProductsData() {
            $('#pdataTable').DataTable().destroy();

            var table = jQuery('#pdataTable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [50, 100, 500, -1],
                    [50, 100, 500, "All"]
                ],
                mark: true,
                columns: [{data: 'id',name: 'id'},
                    {data: 'name',name: 'Name'},
                    {data: 'sku',name: 'sku'},
                    {data: 'category_id',name: 'category'},
                    {data: 'price',name: 'price'},
                    {data: 'stock',name: 'Stock'},
                    {data: 'brand_id',name: 'Brand' },
                    {data: 'status',name: 'status' },
                    {data: 'action',name: 'action',}
                ],
                ajax: {
                    url: '{{ url('/products') }}',
                    data: function(d) {
                        $(".form-filter").serializeArray().map(function(x) {
                            d[x.name] = x.value;
                        });
                    }
                }
            });

            table.on('click', '.productDeleteIdBtn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                productDelete(id);
            });

            //product edit icon
            table.on('click', '.productEditIdBtn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                productDetails(id);
                $('#ProductEditConfirmBtn').attr('data-id', id);
                $('#updateProductModal').modal('show');
            });
            $('.form-filter').on('submit', function (e) {
                table.draw();
                e.preventDefault();
            });
        }


        let url = window.location.origin;

        function productDelete(id) {
            const del = url + '/product/' + id;
            axios.delete(del)
                .then(function(response) {
                    if (response.data == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        getProductsData();

                    } else {
                        getProductsData();
                    }
                }).catch(function(error) {});
        }

        // each product Details------------
        function productDetails(detailid) {
            const detailsUrl = url + '/product/' + detailid + '/edit';
            axios.get(detailsUrl)
                .then(function(response) {
                    if (response.status == 200) {
                        var jsonData = response.data;
                        $('#productName').val(jsonData.name);
                        $('#productSku').val(jsonData.sku);
                        $('#productBrand').val(jsonData.brand_id);
                        $('#productDes').val(jsonData.description);
                        $('#productShortDes').val(jsonData.short_description);
                        $('#productPrice').val(jsonData.price);
                        $('#productDisPrice').val(jsonData.dis_price);
                        $('#productStock').val(jsonData.stock);
                        $('#productCategory').val(jsonData.category_id);
                    } else {

                    }
                }).catch(function(error) {
                    return "somthing wrong";
                });
        }


        // $('#updateForm').submit(function(e) {
        //     e.preventDefault();
        //     const form = document.getElementById('updateForm');
        //     const formData = new FormData(form);

        //     console.log(formData);
        //     // var id = $(this).data('id');
        //     var id=$('#ProductEditConfirmBtn').data('id');;
        //     productUpdate(formData,id);
        // });


        // Product Update
        $('#ProductEditConfirmBtn').click(function() {
            var id = $(this).data('id');
            var productName = $('#productName').val();
            var productSku = $('#productSku').val();
            var productBrand = $('#productBrand').val();
            var productDes = $('#productDes').val();
            var productSdes = $('#productShortDes').val();
            var productPrice = $('#productPrice').val();
            var productDisPrice = $('#productDisPrice').val();
            var productStock = $('#productStock').val();
            var productCat = $('#productCategory').val();

            productUpdate(id, productName, productSku, productBrand, productDes, productSdes,
                productPrice, productDisPrice, productStock, productCat);
        })

        function productUpdate(id, productName, productSku, productBrand, productDes, productSdes,
            productPrice, productDisPrice, productStock, productCat) {

            var data = {
                name: productName,
                sku: productSku,
                brand_id: productBrand,
                description: productDes,
                short_description: productSdes,
                price: productPrice,
                dis_price: productDisPrice,
                stock: productStock,
                category_id: productCat,

            };

            console.log(data);
            const updateUrl = url + '/product/' + id;
            axios.put(updateUrl, data)
                .then(function(response) {

                    if (response.data == 1) {
                        $('#updateProductModal').modal('hide');
                        getProductsData();

                    } else {
                        $('#updateProductModal').modal('hide');
                        getproductsData();
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
