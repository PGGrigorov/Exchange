@extends('layouts.admin_dashboard')

@section('content')
@if (auth()->user())
@if (auth()->user()->is_blocked == 0)
<div class="container">
  <div class="row justify-content-center p-2">
    <div class="col-1">
      <a href="{{ route('admin.create') }}" class="btn btn-success btn-sm d-block mb-2"><i class="fa-solid fa-user-plus"></i></a>
    </div>
  </div>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                {{ __('Registered users') }} 
                
              </div>

              <div class="card-body admin-card-body">
                        @foreach ($users as $user)
                      {{-- User stats --}}
                          <div class="col-md-12 col-lg-4 text-center bg-white p-2 rounded">
                              {{-- Avatar --}}
                              {{-- {{dd($user->avatar)}} --}}
                              <img src="/storage/avatars/{{ $user->avatar}}" alt="{{auth()->user()->name}}'s avatar"
                                  class="w-50 rounded-circle">
              
                              {{-- User name --}}
                              <h2>
                                {{-- Checks if user is admin and shows badge --}}
                                @if ($user->is_admin == 0)
                                <i class="fa-solid fa-circle-check text-danger"></i>
                                @else
                                <i class="fa-solid fa-circle-check text-success"></i>
                                @endif
                                  {{$user->name}}
                                
                                {{-- Checks if user is blocked and shows badge --}}
                                @if ($user->is_blocked == 0)
                                <i class="fa-solid fa-ban text-danger"></i>
                                @else
                                <i class="fa-solid fa-ban text-success"></i>
                                @endif
                              </h2>

                              {{-- User email --}}
                              <p>
                                  {{$user->email}}
                              </p>
              
                              {{-- Checks if user is admin --}}
                              @if ($user->is_admin != 0)
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.demote', $user->id) }}" class="btn btn-info">Demote {{$user->name}}</a>
                                @endif
                              </div>
                              @else
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.promote', $user->id) }}" class="btn btn-info">Promote {{$user->name}}</a>
                                @endif
                              </div>
                              
                              @endif

                              @if ($user->is_blocked != 0)
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.unblock', $user->id) }}" class="btn btn-warning">Unblock {{$user->name}}</a>
                                @endif
                              </div>
                              @else
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.block', $user->id) }}" class="btn btn-warning">Block {{$user->name}}</a>
                                @endif
                              </div>
                              @endif

                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{route('admin.delete.user', $user->id) }}" class="btn btn-danger">Delete {{$user->name}}</a>
                                @endif
                              </div>
                      </div>
                        @endforeach
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@else
<h1 class="text-center">You are blocked</h1>
@endif
@else
<script>window.location = "{{ route('login') }}";</script>
@endif
@endsection
