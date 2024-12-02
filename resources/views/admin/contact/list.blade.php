@extends('admin.main')

@section('content')
    <!-- Style for the search form -->
    <style>
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
            align-items: flex-end;
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
            align-self: flex-end;
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
    <form method="GET" action="{{ route('contact.search') }}" class="search-form">
        <div>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter ID">
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter name">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter email">
        </div>
        <div>
            <label for="message">Message:</label>
            <input type="text" id="message" name="message" placeholder="Enter message">
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- Contact Table -->
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->message }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>{{ $contact->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('contact.edit', $contact->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{ route('contact.destroy', $contact->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('pagination.default', ['paginator' => $list])
@endsection
