<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
</head>

<body>

    <!-- Header -->
    <div class="p-5 bg-primary text-white text-center">
        <h1>Ajax Laravel CRUD</h1>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Student</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="#">Product</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Product List</h2>

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                New Product
            </button>

        </div>

        @include('product-table')

    </div>

    <!-- Footer -->
    <div class="mt-5 p-4 bg-dark text-white text-center">
        <p>Footer</p>
    </div>

    @include('product-entry')
    @include('product-edit')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000
        };

        $(document).ready(function() {

            // Add Product
            $("#ProductEntry").submit(function(e) {

                e.preventDefault();

                $(".error_text").text("");

                $("#saveProduct").prop("disabled", true).text("Saving...");

                let formData = new FormData(this);

                $.ajax({

                    url: "{{ route('product.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {

                        $("#saveProduct").prop("disabled", false).text("Save Product");

                        toastr.success(response.msg, "Success");

                        $("#ProductEntry")[0].reset();

                        $(".error_text").text("");

                        bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal'))
                            .hide();

                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },

                    error: function(xhr) {

                        $("#saveProduct").prop("disabled", false).text("Save Product");

                        $(".error_text").text("");

                        if (xhr.status == 422) {

                            $.each(xhr.responseJSON.errors, function(key, value) {

                                $("." + key + "_error").text(value[0]);

                            });

                        } else {

                            toastr.error("Something went wrong. Please try again.", "Error");

                        }

                    }

                });

            });

            // Load product into Edit modal
            $(document).on("click", ".editProduct", function() {

                let id = $(this).data("id");

                $.get("{{ url('product') }}/" + id + "/edit", function(product) {

                    $("#edit_id").val(product.id);
                    $("#edit_name").val(product.name);
                    $("#edit_price").val(product.price);
                    $("#edit_description").val(product.description);

                    $(".edit_name_error, .edit_price_error, .edit_description_error").text("");

                    bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal')).show();

                });

            });

            // Update Product
            $("#EditProductForm").submit(function(e) {

                e.preventDefault();

                $(".edit_name_error, .edit_price_error, .edit_description_error").text("");

                $("#updateProduct").prop("disabled", true).text("Updating...");

                let id = $("#edit_id").val();

                let formData = new FormData(this);

                $.ajax({

                    url: "{{ url('product') }}/" + id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {

                        $("#updateProduct").prop("disabled", false).text("Update Product");

                        toastr.success(response.msg, "Success");

                        bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal')).hide();

                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },

                    error: function(xhr) {

                        $("#updateProduct").prop("disabled", false).text("Update Product");

                        if (xhr.status == 422) {

                            $.each(xhr.responseJSON.errors, function(key, value) {

                                $(".edit_" + key + "_error").text(value[0]);

                            });

                        } else {

                            toastr.error("Something went wrong. Please try again.", "Error");

                        }

                    }

                });

            });

            // Delete Product
            $(document).on("click", ".deleteProduct", function() {

                if (!confirm("Are you sure you want to delete this product?")) {
                    return;
                }

                let id = $(this).data("id");

                $.ajax({

                    url: "{{ url('product') }}/" + id,
                    type: "POST",
                    data: {
                        _method: "DELETE"
                    },

                    success: function(response) {

                        toastr.success(response.msg, "Success");

                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },

                    error: function() {

                        toastr.error("Something went wrong. Please try again.", "Error");

                    }

                });

            });

        });
    </script>

</body>

</html>
