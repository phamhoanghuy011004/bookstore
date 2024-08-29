@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Bio</th>
            <th>Date of Birth</th>
            <th>Nationality</th>
            <th>Email</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $author)
            <tr>
                <td>{{$author->id}}</td>
                <td>{{$author->name}}</td>
                <td>{{$author->bio}}</td>
                <td>{{$author->date_of_birth}}</td>
                <td>{{$author->nationality}}</td>
                <td>{{$author->email}}</td>
                <td>{{$author->status}}</td>
                <td>
                    @if($author->photo)
                        <img class="img-thumbnail" style="width: 100px" src="{{$author->photo}}" alt="Author Photo">
                    @endif
                </td>
                <td>{{$author->created_at}}</td>
                <td>{{$author->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/authors/edit/{{$author->id}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="/admin/authors/destroy/{{$author->id}}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $list])
@endsection
