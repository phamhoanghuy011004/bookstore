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
        input[type="email"],
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
    <form method="GET" action="{{ route('user.search') }}" class="search-form">
        <div>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter ID">
        </div>
        <div>
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter fullname">
        </div>
        <div>
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" placeholder="Enter username">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email">
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter phone number">
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">Select status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- User Table -->
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Email Verified At</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('user.edit', $user->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{ route('user.destroy', $user->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('pagination.default', ['paginator' => $list])
@endsection
