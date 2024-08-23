<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password Form</title>
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
</head>

<style>* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html,
body {
  height: 100%;
}

html {
  background: linear-gradient(to right bottom, #ded3f4, #2e24f0);
  background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
  height: 100%;
  background-attachment: fixed;
}

body {
  font-family: sans-serif;
  line-height: 1.4;
  display: flex;
}

.container {
  width: 400px;
  margin: auto;
  padding: 36px 48px 48px 48px;
  background-color: #f2efee;

  border-radius: 11px;
  box-shadow: 0 2.4rem 4.8rem rgba(0, 0, 0, 0.15);
}

.login-title {
  padding: 15px;
  font-size: 22px;
  font-weight: 600;
  text-align: center;
}

.login-form {
  display: grid;
  grid-template-columns: 1fr;
  row-gap: 16px;
}

.login-form label {
  display: block;
  margin-bottom: 8px;
}

.login-form input {
  width: 100%;
  padding: 1.2rem;
  border-radius: 9px;
  border: none;
}

.login-form input:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(253, 242, 233, 0.5);
}

.btn--form {
  background-color: #2e24f0;
  color: #fdf2e9;
  align-self: end;
  padding: 8px;
}

.btn,
.btn:link,
.btn:visited {
  display: inline-block;
  text-decoration: none;
  font-size: 20px;
  font-weight: 600;
  border-radius: 9px;
  border: none;

  cursor: pointer;
  font-family: inherit;

  transition: all 0.3s;
}

button {
  outline: 1px solid #2e24f0;
}

.btn--form:hover {
  background-color: #fdf2e9;
  color: #2e24f0;
}</style>
<body>
<div class="container">


  <div>
     @if($errors->any())
    <div class="alert alert-danger">
      <h3 style="color:red;text-align:center">Invalid Credential</h3>
    </div>
  @endif

  <form action="{{ url('reset-password/') }}" method="POST" class="login-form">
    @csrf
<input type="hidden" name="token" value="{{ $token }}">

    
      <input type="hidden" name="email" id="email" value="{{ $email }}" readonly >
    <div>
      <label for="password">New Password:</label>
      <input type="text" name="password" id="password" required placeholder="Enter Password">
   
    </div>
    <div>
      <label for="password_confirmation">Confirm Password:</label>
      <input type="text" name="password_confirmation" id="password_confirmation" required placeholder="Enter Confirm Password">
    </div>
    <button type="submit" class="btn btn--form">Reset Password</button>
  </form>


</div>

</body>
</html>
