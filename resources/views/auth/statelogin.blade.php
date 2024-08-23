
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <h2 class="login-title"><img src="{{ url('img/janiscare-logo.svg') }}" style="width:200px;height:100px" alt="not found"></h2>

    @if($errors->any())
  <div class="alert alert-danger">
  <h3 style="color:red;text-align:center">Invalid Credential</h3>
  </div>
@endif

    <form action="{{ url('admin/statelogin') }}" method="POST" class="login-form">
      @csrf
      <div>
        <label for="email">Email</label>
        <input
               id="email"
               type="email"
               placeholder="Enter Email"
               name="email"
              
               />
               <span style="color:red">@error('email'){{$message}}@enderror</span>
      </div>

      <div>
        <label for="password">Password</label>
        <input
               id="password"
               type="number"
               placeholder="password"
               name="password"
             
               />
               <span style="color:red">@error('password'){{$message}}@enderror</span>
      </div>
     

      <button class="btn btn--form" type="submit" value="Log in">
        Submit
      </button>

    </form>
</div>

<!-- partial -->  
</body>
</html>
