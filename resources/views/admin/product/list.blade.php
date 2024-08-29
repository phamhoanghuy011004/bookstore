@extends('admin.main')

@section('content')
    <!-- Style for the search form -->
    <style>
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
            align-items: flex-end; /* Canh lề dưới cùng cho các trường nhập liệu */
        }

        .search-form div {
            flex: 1;
            min-width: 150px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            flex: none;
            align-self: flex-end; /* Đảm bảo nút nằm thẳng hàng với các trường nhập liệu */
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            background-color: #fff;
        }
    </style>

    <!-- Search Form -->
    <form method="GET" action="{{ route('product.search') }}" class="search-form">
        <div>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter ID">
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter name">
        </div>
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" placeholder="Enter author">
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" placeholder="Enter category">
        </div>
        <div>
            <label for="publish_at">Publish Date:</label>
            <input type="date" id="publish_at" name="publish_at">
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div>
            <label for="price_min">Min Price:</label>
            <input type="number" id="price_min" name="price_min" placeholder="Min price" step="0.01">
        </div>
        <div>
            <label for="price_max">Max Price:</label>
            <input type="number" id="price_max" name="price_max" placeholder="Max price" step="0.01">
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- Product Table -->
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
            <th>Publish year</th>
            <th>Image</th>
            <th>Active</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $product)
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

                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('product.edit', $product->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{ route('product.destroy', $product->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('pagination.default', ['paginator' => $list])
@endsection
