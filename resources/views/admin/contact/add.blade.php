@extends('admin.main')

@section('content')
    <form name="contact-form" action="{{ route('contact.store') }}" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" placeholder="Enter your message" rows="4" required></textarea>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>
@endsection
