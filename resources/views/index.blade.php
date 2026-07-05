<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link active" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Student</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">

        <div id="successMessage"></div>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Student List</h2>

            <button type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#myModal">
                New Student
            </button>

        </div>

        @include('table')

    </div>

    <!-- Footer -->
    <div class="mt-5 p-4 bg-dark text-white text-center">
        <p>Footer</p>
    </div>

    @include('entry')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            $("#StudentEntry").submit(function (e) {

                e.preventDefault();

                $(".error_text").text("");

                $("#saveStudent").prop("disabled", true).text("Saving...");

                let formData = new FormData(this);

                $.ajax({

                    url: "{{ route('student.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        $("#saveStudent").prop("disabled", false).text("Save Student");

                        $("#successMessage").html(`
                            <div class="alert alert-success alert-dismissible fade show">
                                ${response.msg}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `);

                        $("#StudentEntry")[0].reset();

                        $(".error_text").text("");

                        bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')).hide();

                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    },

                    error: function (xhr) {

                        $("#saveStudent").prop("disabled", false).text("Save Student");

                        $(".error_text").text("");

                        if (xhr.status == 422) {

                            $.each(xhr.responseJSON.errors, function (key, value) {

                                $("." + key + "_error").text(value[0]);

                            });

                        }

                    }

                });

            });

        });

    </script>

</body>

</html>