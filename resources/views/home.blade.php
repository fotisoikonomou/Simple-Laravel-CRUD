@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Language Switcher -->
    <div class="row justify-content-center">
        <div class="col-md-8 text-end">
            <a href="{{ route('lang.switch', 'en') }}" class="btn btn-link">
                {{ __('English') }}
            </a>
            <a href="{{ route('lang.switch', 'gr') }}" class="btn btn-link">
                {{ __('Ελληνικά') }}
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('messages.user_management')</div>

                <div class="card-body">
                @if (Auth::check()) 
              <div class="alert alert-success" role="alert">
              @lang('messages.entrance')

              <a href="{{ route('listUsers') }}" class="btn btn-primary" target="_blank">@lang('messages.dashboard')</a>
              </div>
           
             
           
          @else
          <div class="alert alert-danger" role="alert">
            <p>@lang('messages.Please log in to access the dashboard.')</p>
            </div>
          @endif
              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
