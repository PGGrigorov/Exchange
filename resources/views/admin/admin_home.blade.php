@extends('layouts.admin_dashboard')

@section('content')
@if (auth()->user())
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Registered users') }}</div>

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
                                @if ($user->is_admin == 0)
                                <i class="fa-solid fa-circle-check text-danger"></i>
                                @else
                                <i class="fa-solid fa-circle-check text-success"></i>
                                @endif
                                  {{$user->name}}
                              </h2>
                              <p>
                                  {{$user->email}}
                              </p>
              
                              {{-- Checks if user is admin --}}
                              @if ($user->is_admin != 0)
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.demote', $user->id) }}" class="btn btn-warning">Demote {{$user->name}}</a>
                                @endif
                              </div>
                              @else
                              <div class="p-2">
                                @if (auth()->user()->id != $user->id)
                                <a href="{{ route('admin.promote', $user->id) }}" class="btn btn-warning">Promote {{$user->name}}</a>
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
<script>window.location = "{{ route('login') }}";</script>
@endif
@endsection
