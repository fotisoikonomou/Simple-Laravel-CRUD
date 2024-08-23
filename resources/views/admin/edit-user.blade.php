<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.edit_user')</title>
    <!-- Include the Bootstrap framework -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Include the jQuery library -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('listUsers') }}">@lang('messages.users_list')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.roles.index') }}">@lang('messages.roles')</a>
                    </li> -->
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
        <h2 class="mb-4">@lang('messages.edit_user')</h2>

        <!-- Display the Validation Errors if any
          -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}" novalidate>
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">  @lang('messages.name')</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">  @lang('messages.username')</label>
                    <input type="text" id="username" name="username" class="form-control"
                        value="{{ old('username', $user->username) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <input type="email" id="email"  name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">@lang('messages.password')</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="form-text text-muted">@lang('messages.Leave_blank_to_keep_the_current_password')</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">@lang('messages.confirm_password')</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control">
                </div>
                <div class="col-md-6 form-check mt-4">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input"
                        {{ old('is_active',  $user->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">@lang('messages.active')</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">@lang('messages.roles'):</label>
                @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                        class="form-check-input"
                        {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}
                        {{ $role->is_deleted ?  'checked disabled' : '' }}>
                    <label for="role{{ $role->id  }}"  class="form-check-label"
                        style="{{ $role->is_deleted ?  'text-decoration: line-through;' : '' }}">
                        {{ $role->name }} {{ $role->is_deleted ? '(Deleted)' : '' }}
                    </label>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary"> @lang('messages.update_role')</button>
            <a href="{{ route('listUsers') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
        </form>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log("jQuery is ok.");

            $('#editUserForm').on('submit', function(event) {
                // Clear the previous error messages if exist
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                let isValid = true;

                // Validate Name check if it is empty
                if ($('#name').val().trim() === '') {
                    isValid = false;

                    $('#name').addClass('is-invalid');

                    $('#name').after('<div class="invalid-feedback">Name is required.</div>');
                }

                // Validatethen Username check if it is empty
                if ($('#username').val().trim() === '') {
                    isValid = false;

                    $('#username').addClass('is-invalid');
                    $('#username').after('<div class="invalid-feedback">Username is required.</div>');
                }

                // Validate the Email based on a pattern I found on stack overflow
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if ($('#email').val().trim() === '') {
                    isValid = false;

                    $('#email').addClass('is-invalid');
                    $('#email').after('<div class="invalid-feedback">Email is required.</div>');
                } else if (!emailPattern.test($('#email').val().trim())) {
                    isValid = false;

                    $('#email').addClass('is-invalid');
                    $('#email').after('<div class="invalid-feedback">Please enter a valid email address.</div>');
                }

                // Validate the Password (if changed)
                if ($('#password').val().trim() !== '' && $('#password').val().trim().length < 6) {
                    isValid = false;
                    $('#password').addClass('is-invalid');
                    $('#password').after('<div class="invalid-feedback">Password must be at least 6 characters long.</div>');
                }

                // Validate the Password Confirmation (if a new password is provided)
                if ($('#password').val().trim() !== '') {
                    if ($('#password_confirmation').val().trim() === '') {
                        isValid = false;

                        $('#password_confirmation').addClass('is-invalid');
                        $('#password_confirmation').after('<div class="invalid-feedback">Password confirmation is required.</div>');
                    } else if ($('#password').val().trim() !== $('#password_confirmation').val().trim()) {
                        isValid = false;

                        $('#password_confirmation').addClass('is-invalid');
                        $('#password_confirmation').after('<div class="invalid-feedback">Passwords do not match.</div>');
                    }
                }

                // Prevent the form to submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>