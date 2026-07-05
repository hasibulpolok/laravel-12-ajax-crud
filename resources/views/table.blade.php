<table class="table table-bordered table-hover">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->address }}</td>

                <td>
                    <button type="button" class="btn btn-primary btn-sm editStudent" data-id="{{ $student->id }}">
                        Edit
                    </button>

                    <button type="button" class="btn btn-danger btn-sm deleteStudent" data-id="{{ $student->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach

    </tbody>

</table>
