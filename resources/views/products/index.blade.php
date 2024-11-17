<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for the file input */
.form-group {
    margin-bottom: 1.5rem; /* Space between form groups */
}

.form-group label {
    font-weight: bold; /* Bold labels */
}

/* Style the file input */
.form-control[type="file"] {
    padding: 0.5rem; /* Padding for the input */
    border-radius: 0.25rem; /* Rounded corners */
    border: 1px solid #ced4da; /* Border color */
    transition: border-color 0.2s; /* Smooth transition for border color */
}

/* Change the border color on focus */
.form-control[type="file"]:focus {
    border-color: #80bdff; /* Focus border color */
    outline: none; /* Remove outline */
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Shadow effect */
}

/* Style the file input button */
.custom-file-upload {
    display: inline-block; /* Align inline */
    padding: 0.5rem 1rem; /* Padding for button */
    cursor: pointer; /* Pointer on hover */
    background-color: #007bff; /* Button color */
    color: white; /* Button text color */
    border-radius: 0.25rem; /* Rounded corners */
    border: none; /* Remove border */
}

/* Change button style on hover */
.custom-file-upload:hover {
    background-color: #0056b3; /* Darker shade on hover */
}
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Product Management</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="0" required>
            </div>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <h2>Existing Products</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Image</th> <!-- Added Image column -->
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <img src="{{ asset('images/demie.JPG') }}" alt="{{ $product->name }}" style="width: 100px; height: auto;" /> <!-- Correct use of asset() -->
                    </td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>