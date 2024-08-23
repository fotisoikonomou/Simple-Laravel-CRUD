<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.create_user')</title>
    <!-- Include the Bootstrap CSS framewok -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Include the jQuery library -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
                            {{ __('Logout') }}
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
        <h2 class="mb-4">@lang('messages.create_user')</h2>

        <!-- Display the Validation Errors if any -->
       
        @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="createUserForm" novalidate method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">@lang('messages.name'):</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">@lang('messages.username')</label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required>
                </div>
            </div>
 


            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">@lang('messages.password')</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">@lang('messages.confirm_password'):</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>
                <div class="col-md-6 form-check mt-4">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input">
                    <label for="is_active" class="form-check-label">@lang('messages.active')</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">@lang('messages.roles')</label>
                @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}" class="form-check-input">
                    <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">@lang('messages.Save_User')</button>
            <a href="{{ route('listUsers') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
        </form>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   
    <script>

var validationMessages = {
        nameRequired: "@lang('messages.name_required')", 


        usernameRequired: "@lang('messages.username_required')",
       
    };
        $(document).ready(function() {
         
            console.log("jQuery ok!!.");

            $('#createUserForm').on('submit', function(event) {
                // Clear previous error messages
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                let isValid = true;

                // Validate the Name check if is empty
                if ($('#name').val().trim() === '') {
                    isValid = false;
                    $('#name').addClass('is-invalid');
                    $('#name').after('<div class="invalid-feedback">' +  validationMessages.nameRequired +'</div>');
                }

                // Validate Username check if is empty
                if ($('#username').val().trim() === '') {
                    isValid = false;
                    $('#username').addClass('is-invalid');
                    $('#username').after('<div class="invalid-feedback">' + validationMessages.usernameRequired +'</div>');
                }

                // Validate Email check based on google search email pattern I found
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

                // Validate the Password not empty
                if ($('#password').val().trim() === '') {
                    isValid = false;
                    $('#password').addClass('is-invalid');
                    $('#password').after('<div class="invalid-feedback">Password is required.</div>');
                }

                // Validate the Password Confirmation
                if ($('#password_confirmation').val().trim() === '') {
                    isValid = false;
                    $('#password_confirmation').addClass('is-invalid');
                    $('#password_confirmation').after('<div class="invalid-feedback">Password confirmation is required.</div>');
                } else if ($('#password').val().trim() !== $('#password_confirmation').val().trim()) {
                    isValid = false;
                    $('#password_confirmation').addClass('is-invalid');
                    $('#password_confirmation').after('<div class="invalid-feedback">Passwords do not match.</div>');
                }

                // Prevent form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>