@extends('admin.main')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

    <form method="GET" action="{{ route('product.search') }}">
        <div>
            <label for="id">Product ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter product ID">
        </div>

        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter product name">
        </div>

        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" placeholder="Enter author name">
        </div>

        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" placeholder="Enter category">
        </div>

        <div>
            <label for="publish_at">Publish Year:</label>
            <input type="number" id="publish_at" name="publish_at" placeholder="Enter publish year">
        </div>

        <div>
            <label for="price_min">Min Price:</label>
            <input type="number" id="price_min" name="price_min" step="0.01" placeholder="Enter minimum price">
        </div>

        <div>
            <label for="price_max">Max Price:</label>
            <input type="number" id="price_max" name="price_max" step="0.01" placeholder="Enter maximum price">
        </div>

        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit">Filter</button>
    </form>

    @if ($hasFilters)
        <table class="table">
            <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Description</th>
                <th>Content</th>
                <th>Price</th>
                <th>Publish Year</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->author }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->content }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->publish_at }}</td>
                    <th><img class="img-thumbnail" style="width: 100px" src="{{$product->image}}" alt=""></th>
                    <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Please apply a filter to see the product list.</p>
    @endif
@endsection
