@extends('layouts.admin_dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Register a new user') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if ($("#user_update").length > 0) {
        $("#user_update").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        maxlength: 100,
                        email: true,
                    },
                    password: {
                        required: true,
                        maxlength: 300
                    },
                    messages: {
                        name: {
                            required: "The name is required to continue",
                            maxlength: "Your name maxlength should be 50 characters long."
                        },
                        email: {
                            required: "The name is required to continue",
                            email: "Please enter valid email",
                            maxlength: "The email name should less than or equal to 100 characters",
                        },
                        password: {
                            required: "The name is required to continue",
                            maxlength: "The password should less than or equal to 300 characters",
                        },
                    },
                    submitHandler: function (form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submit').html('Please Wait...');
                        $("#submit").attr("disabled", true);
                        $.ajax({
                            url: "{{url('admin.store')}}",
                            type: "POST",
                            data: $('#contactUsForm').serialize(),
                            success: function (response) {
                                $('#submit').html('Submit');
                                $("#submit").attr("disabled", false);
                                alert('Ajax form has been submitted successfully');
                                document.getElementById("contactUsForm").reset();
                            }
                        });
                    }
                })
        }
    }
</script>
@endsection
