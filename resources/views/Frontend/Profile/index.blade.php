@extends('Frontend.Home.main')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            @include('Frontend.Profile.nav')
            <div class="col-md-9 border-right">
                @yield('profile_content')
            </div>
        </div>
    </div>
@endsection
