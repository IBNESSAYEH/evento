@extends('layouts.layout')
@section('content')
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            @if(session()->has('user'))
            @php
                $user = session('user');
            @endphp

            <div class="alert alert-primary">
                @if(isset($user['name']))
                    <p>Name: {{ $user['name'] }}</p>
                @endif

                @if(isset($user['email']))
                    <p>Email: {{ $user['email'] }}</p>
                @endif

                @if(isset($user['password']))
                    <ul class="alert alert-danger">
                        @foreach($user['password'] as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if(isset($user['profile']))
                    <p>Profile: {{ $user['profile'] }}</p>
                @endif
            </div>
        @endif

        <form action="{{ route("signup") }}" method="POST" enctype="multipart/form-data" id="myForm">
            @csrf

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Register</p>
            </div>
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Name :</label>
              <input type="text" name="name" id="name" class="form-control form-control-lg"
                placeholder="Enter your name" />
              <span id="nameError" class="text-danger"></span>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Email address :</label>
              <input type="text" name="email" id="email" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <span id="emailError" class="text-danger"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Password :</label>
              <input type="password" name="password" id="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <span id="passwordError" class="text-danger"></span>
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Confirm Password :</label>
              <input type="password" name="password_confirmation" id="passwordconf" class="form-control form-control-lg"
                placeholder="Confirm password" />
              <span id="passwordConfirmationError" class="text-danger"></span>
            </div>
            <div class="form-outline mb-3">
              <input type="file" name="profile" id="profile" class="form-control form-control-lg" />
              <span id="profileError" class="text-danger"></span>
            </div>

            <input type="submit" name="submit" class="btn btn-primary" value="register">
          </form>
        </div>
      </div>
    </div>

  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('myForm').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const passwordConfirmation = document.getElementById('passwordconf').value.trim();
            const profile = document.getElementById('profile').value.trim();
            let isValid = true;

            if (!validateName(name)) {
                isValid = false;
            }

            if (!validateEmail(email)) {
                isValid = false;
            }

            if (!validatePassword(password)) {
                isValid = false;
            }

            if (!validatePasswordConfirmation(password, passwordConfirmation)) {
                isValid = false;
            }

            if (!validateProfile(profile)) {
                isValid = false;
            }

            return isValid;
        }

        function validateName(name) {
            if (name === "") {
                displayError('nameError', 'Name is required');
                return false;
            } else if (!/^[a-zA-Z]+$/.test(name)) {
                displayError('nameError', 'Name must contain only characters');
                return false;
            } else if (name.length <= 3) {
                displayError('nameError', 'Name must be more than 3 characters');
                return false;
            } else {
                clearError('nameError');
                return true;
            }
        }

        function validateEmail(email) {
            if (email === "") {
                displayError('emailError', 'Email address is required');
                return false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                displayError('emailError', 'Invalid email address');
                return false;
            } else {
                clearError('emailError');
                return true;
            }
        }

        function validatePassword(password) {
            if (password === "") {
                displayError('passwordError', 'Password is required');
                return false;
            } else if (password.length < 8 || password.length > 20) {
                displayError('passwordError', 'Password must be between 8 and 20 characters');
                return false;
            } else if (!/[A-Z]/.test(password)) {
                displayError('passwordError', 'Password must contain at least 1 uppercase letter');
                return false;
            } else if (!/[a-z]/.test(password)) {
                displayError('passwordError', 'Password must contain at least 1 lowercase letter');
                return false;
            } else if (!/\d/.test(password)) {
                displayError('passwordError', 'Password must contain at least 1 digit');
                return false;
            } else if (!/[^a-zA-Z0-9]/.test(password)) {
                displayError('passwordError', 'Password must contain at least 1 special character');
                return false;
            } else {
                clearError('passwordError');
                return true;
            }
        }

        function validatePasswordConfirmation(password, passwordConfirmation) {
            if (passwordConfirmation === "") {
                displayError('passwordConfirmationError', 'Please confirm your password');
                return false;
            } else if (password !== passwordConfirmation) {
                displayError('passwordConfirmationError', 'Passwords do not match');
                return false;
            } else {
                clearError('passwordConfirmationError');
                return true;
            }
        }

        function validateProfile(profile) {
            if (profile === "") {
                displayError('profileError', 'Profile image is required');
                return false;
            } else {
                clearError('profileError');
                return true;
            }
        }

        function displayError(elementId, errorMessage) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = errorMessage;
        }

        function clearError(elementId) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = "";
        }
    });
</script>






@endsection
