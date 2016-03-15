@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h2>Users</h2>
        <button class="right button-delete" v-delete-btn route="{{ route('admin.user.cache:clear') }}">Clear User Cache</button>
        <table class="tables">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Member Since</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="text-align: center;">
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                        <td>
                            <a class="button" href="{{ route('admin.user.show', ['user' => $user->username]) }}">
                                <i class="fa fa-user"></i>  Show
                            </a>

                            <button class="button-delete" v-delete-btn route="{{ route('admin.user.destroy', ['user' => $user->username]) }}"><i class="fa fa-trash"></i>  Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection