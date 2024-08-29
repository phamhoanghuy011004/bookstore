@extends('admin.main')

@section('content')
    <form name="user-form" action="{{ route('users.store') }}" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Enter full name">
            </div>

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter user name">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email address">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="form-control" placeholder="Enter gender">
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="active" type="radio" id="active" name="status" checked>
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="inactive" type="radio" id="inactive" name="status">
                    <label for="inactive" class="custom-control-label">Inactive</label>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
        @csrf
    </form>
@endsection
