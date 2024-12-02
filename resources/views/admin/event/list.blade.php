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
    <form method="GET" action="{{ route('event.search') }}" class="search-form">
        <div>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter ID">
        </div>
        <div>
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter event name">
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter location">
        </div>
        <div>
            <label for="start_time">Start Time:</label>
            <input type="date" id="start_time" name="start_time">
        </div>
        <div>
            <label for="end_time">End Time:</label>
            <input type="date" id="end_time" name="end_time">
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
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- Event Table -->
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Description</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td>{{ $event->status ? 'Active' : 'Inactive' }}</td>
                <td><img class="img-thumbnail" style="width: 100px" src="{{$event->image}}" alt=""></td>
                <td>{{ $event->created_at }}</td>
                <td>{{ $event->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('event.edit', $event->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{ route('event.destroy', $event->id) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('pagination.default', ['paginator' => $list])
@endsection
