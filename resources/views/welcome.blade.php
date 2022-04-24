@extends('layouts.welcome_dashboard')
@section('content')
@if (!auth()->user())
<div class="welcome">
    <div class="container">
        <div class="row">
            <main role="main" class="inner cover text-center d-flex flex-column mt-5">
                <h1 class="cover-heading text-white display-3">Exchange Your Rate</h1>
                <p class="lead">
                    <a href="{{ route('login') }}" class="btn btn-lg btn-danger m-1">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-lg btn-secondary m-1">Register</a>
                </p>
            </main>
        </div>
    </div>
</div>
@else
<script>
    window.location = "{{ route('api.index') }}";

</script>
@endif
@endsection
