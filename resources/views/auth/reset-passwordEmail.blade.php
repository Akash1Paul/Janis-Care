<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password Form</title>
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
</head>
<body>
<div class="container">

  <div>
    @if(session('status'))
      <p>{{ session('status') }}</p>
    @endif
  </div>
      <p>Please follow this link to reset your password:</p>
      <a href="{{ $resetLink }}">Click Here</a>
  
</div>
</body>
</html>
