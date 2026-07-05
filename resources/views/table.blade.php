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