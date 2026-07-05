<table class="table table-bordered table-hover">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>

                <td>
                    <button type="button" class="btn btn-primary btn-sm editProduct" data-id="{{ $product->id }}">
                        Edit
                    </button>

                    <button type="button" class="btn btn-danger btn-sm deleteProduct" data-id="{{ $product->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No products found</td>
            </tr>
        @endforelse

    </tbody>

</table>
