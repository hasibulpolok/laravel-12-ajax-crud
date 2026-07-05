<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel AJAX CRUD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="p-5 bg-primary text-white text-center">
    <h2>Laravel AJAX CRUD</h2>
</div>

<div class="container mt-5">

    <div id="successMessage"></div>

    <div class="d-flex justify-content-between mb-3">
        <h3>Student List</h3>

        <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#myModal">
            New Student
        </button>
    </div>

 @include('table')

</div>

@include('entry')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>

$.ajaxSetup({

    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }

});

$(document).ready(function(){

    $("#StudentEntry").submit(function(e){

        e.preventDefault();

        $(".error_text").text("");

        $("#saveStudent")
            .prop("disabled",true)
            .text("Saving...");

        let formData = new FormData(this);

        $.ajax({

            url:"{{ route('student.store') }}",

            type:"POST",

            data:formData,

            processData:false,

            contentType:false,

            success:function(response){

                $("#saveStudent")
                    .prop("disabled",false)
                    .text("Save Student");

                $("#successMessage").html(

                    `<div class="alert alert-success alert-dismissible fade show">

                        ${response.msg}

                        <button class="btn-close"
                                data-bs-dismiss="alert"></button>

                    </div>`

                );

                $("#StudentEntry")[0].reset();

                $(".error_text").text("");

                bootstrap.Modal.getInstance(
                    document.getElementById('myModal')
                ).hide();

                setTimeout(function(){

                    location.reload();

                },500);

            },

            error:function(xhr){

                $("#saveStudent")
                    .prop("disabled",false)
                    .text("Save Student");

                if(xhr.status==422){

                    $.each(xhr.responseJSON.errors,function(key,value){

                        $("."+key+"_error").text(value[0]);

                    });

                }

            }

        });

    });

});

</script>

</body>
</html>