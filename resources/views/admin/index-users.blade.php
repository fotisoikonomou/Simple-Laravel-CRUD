<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.users_list')</title>
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/datatables.css')}}" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang.switch', 'en') }}">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang.switch', 'gr') }}">Ελληνικά</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           @lang('messages.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">

 @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
</div>
<div class="container mt-5">
    <h2>@lang('messages.users_list')</h2>
    <div class="mb-3">
        <a href="{{ route('admin.create') }}" class="btn btn-primary mb-2">@lang('messages.create_user')</a>
        <!-- <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-2">@lang('messages.create_role')</a> -->
        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary mb-2">@lang('messages.roles')</a>
    </div>

    <div class="table-responsive">
        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('messages.id')</th>
                    <th>@lang('messages.name')</th>
                    <th>@lang('messages.username')</th>
                    <th>@lang('messages.email')</th>
                    <th>@lang('messages.active')</th>
                    <th>@lang('messages.roles')</th>
                    <th>@lang('messages.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_active ? __('messages.activeyes') : __('messages.nonactive') }} </td>
                    <td>
                @foreach($user->roles as $role)
                    <span style="{{ $role->is_deleted ? 'text-decoration: line-through;' : '' }}">
                        {{ $role->name }}{{ $role->is_deleted ? ' (Deleted)' : '' }}
                    </span><br>
                @endforeach
            </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">@lang('messages.edit')</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">@lang('messages.delete')</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('dataTables/datatables.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
</script>
</body>
</html>