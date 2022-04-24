@extends('layouts.admin_dashboard')
@section('content')

{{-- Account  --}}


@if ($user)
{{-- If user is logged --}}
    <div class="container">
        <div class="row">
            {{-- User stats --}}
            <div class="col-md-12 col-lg-3 text-center bg-white p-2 rounded">
                {{-- Avatar --}}
                {{-- {{dd($user->avatar)}} --}}
                <img src="/storage/avatars/{{ $user->avatar}}" alt="{{auth()->user()->name}}'s avatar"
                    class="w-50 rounded-circle">

                {{-- User name --}}
                <h2>
                    {{$user->name}}
                </h2>
                <p>
                    {{$user->email}}
                </p>

                {{-- Checks if user is admin --}}
                @if ($user->is_admin != 0)
                <div class="p-2">
                    <a href="{{ route('admin.demote', $user->id) }}" class="btn btn-warning">Demote {{$user->name}}</a>
                </div>
                @else
                <div class="p-2">
                    <a href="{{ route('admin.promote', $user->id) }}" class="btn btn-warning">Promote {{$user->name}}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@else

{{-- If user is not logged --}}
<h2 class="text-black text-center">
    <a href="{{route('login')}}" class="text-decoration-none text-black">
        Login to access the user page
    </a>
</h2>
@endif

@endsection
