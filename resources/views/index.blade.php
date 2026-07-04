<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="p-5 bg-primary text-white text-center">
        <h1>Ajax Laravel Crud</h1>

    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Student List</h2>

            <!-- Button to Open Modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                New Student
            </button>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                    <tr>

                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>

                    </tr>
                @endforeach




            </tbody>
        </table>

    </div>

    <!-- Footer -->
    <div class="mt-5 p-4 bg-dark text-white text-center">
        <p>Footer</p>
    </div>
    @include('entry')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   


    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $(document).on('submit', '#StudentEntry', function (e) {
            e.preventDefault();

            let Mydata = new FormData(this);

            $.ajax({
                url: "{{ route('student.store') }}",
                method: "POST",
                data: Mydata,
                processData: false,
                contentType: false,

                success: function (response) {
                    console.log(response);
                },

                error: function (err) {
                    let errors = err.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });
                }
            });

        });

    });
</script>




</body>

</html>
