@extends('layouts.app')
@section('content')

{{-- Account  --}}


@if (auth()->user())
{{-- If user is logged --}}
<div class="container">
    <div class="row">

        {{-- User stats --}}
        <div class="col-md-12 col-lg-3 text-center bg-white p-2 rounded">
            {{-- Avatar --}}
            <img src="storage/avatars/{{ auth()->user()->avatar}}" alt="{{auth()->user()->name}}'s avatar"
                class="w-50 rounded-circle">

            {{-- User name --}}
            <h2>
                {{auth()->user()->name}}
            </h2>
            <p>
                {{auth()->user()->email}}
            </p>

            {{-- Checks if user is admin --}}
            @if (auth()->user()->is_admin != 0)
            <div class="p-2">
                <a href="{{ route('admin.home', auth()->user()->id) }}" class="btn btn-primary">Admin Panel</a>
                <a href="{{ route('admin.demote', auth()->user()->id) }}" class="btn btn-warning">Demote Yourself</a>
            </div>
            @endif
        </div>


        {{-- User settings --}}
        <div class="col-md-12 col-lg-6 p-2">
            <h2 class="text-center mb-0">
                {{auth()->user()->name}}'s setings
            </h2>
            <form action="{{ route('user.update', auth()->user()->id) }}" method="POST" name="user_update"
                id="user_update" enctype="multipart/form-data">
                @csrf
                {{-- Name --}}
                <div class="form-group p-2">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" name="name" placeholder="{{auth()->user()->name}}">
                </div>

                {{-- Email --}}
                <div class="form-group p-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="{{auth()->user()->email}}">
                </div>

                <div class="form-group p-2">
                    <label for="check_email"> Repeat Email</label>
                    <input type="email" class="form-control" name="check_email" placeholder="{{auth()->user()->email}}">
                </div>

                {{-- Password --}}
                <div class="form-group p-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="*******">
                </div>

                {{-- Password Repeat --}}
                <div class="form-group p-2">
                    <label for="check_password">Repeat Password</label>
                    <input type="password" class="form-control" name="check_password" placeholder="*******">
                </div>

                {{-- Avatar --}}
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>
                <div class="p-2 ">
                    <input type="submit" class="btn btn-danger" value="Update">
                    <input type="reset" class="btn btn-light" value="Reset">
                </div>
            </form>
        </div>
    </div>
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    if ($("#user_update").length > 0) {
        $("#user_update").validate({
                rules: {
                    name: {
                        required: false,
                        maxlength: 50
                    },
                    email: {
                        required: false,
                        maxlength: 100,
                        email: true,
                    },
                    password: {
                        required: false,
                        maxlength: 300
                    },
                    avatar: {
                        required: false,
                    },
                    messages: {
                        name: {
                            maxlength: "Your name maxlength should be 50 characters long."
                        },
                        email: {
                            email: "Please enter valid email",
                            maxlength: "The email name should less than or equal to 100 characters",
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
                            url: "{{url('user')}}",
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
@else

{{-- If user is not logged --}}
<script>
    window.location = "{{ route('login') }}";

</>
@endif

@endsection
