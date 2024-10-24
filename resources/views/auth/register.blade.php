@extends('frontend.layout.app')
@section('content')
    <!-- signin-->
    <div class="signin">
        <div class="form-container">
            <div class="content">
                <h2>SIGN UP TO ACCOUNT</h2>
                <p>Enter Your Email & Password to Login</p>
            </div>
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <input type="text" name="name" placeholder="First Name" required>
                    <input type="text" name="email" value="{{ old('email') }}" required
                        class="@error('email') is-invalid @enderror" placeholder="Enter Your Email">
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-row">
                    {{-- <input type="text" name="firstName" placeholder="User Name" required> --}}
                    <input type="text" name="phonenumber" placeholder="Phone Number" required>
                </div>

                {{-- <div class="form-row">
                    <input type="text" name="city" placeholder="City" required>
                    <input type="text" name="state" placeholder="State" required>
                </div> --}}

                <div class="form-row-full">
                    <input type="password" id="password" name="password" required
                        class="@error('password') is-invalid @enderror" placeholder="Password">
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
                <div class="form-row-full">
                    <input type="password" id="confirm_password" name="confirm-password"
                         required
                        class="@error('confirm-password') is-invalid @enderror" placeholder="confirm-password">
                    <span class="toggle-password" onclick="toggleconPassword()">👁</span>
                </div>
                <div class="form-row-full">
                    <select name="roles" class="form-select" required="required">
                        <option disabled selected value="">select role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="extra-options">
                    <label>
                        <input type="radio" name="rememberMe"> Remember Me
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="signup">Sign Up</button>
                <div class="text">
                    <p>Don't Have Account? <a href="login.html">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        }

        function toggleconPassword() {
            var passwordField = document.getElementById("confirm_password");
            var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        }
    </script>
@endsection
