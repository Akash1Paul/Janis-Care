@include('usernew.header')
@yield('header')
<style>
    .header{
        background: #fff;
    }
    .login
  {
    color: #0D41E1 !important;
  }
</style>
<section class="login">
    <img src="{{url('usernew/img/Group 11.png')}}" class="group-11" alt="">
    <img src="{{url('usernew/img/group14.png')}}" class="group-111" alt="">
    <img src="{{url('usernew/img/Group 12.png')}}" class="group-122" alt="">
    <img src="{{url('usernew/img/Group 12.png')}}" class="group-123" alt="">
    <div class="container">

        <div class="form-box">
            <div class="header">
                <h4>Welcome back to <span>Janis Care</span></h4>

                <h3>Reset Password</h3>
                @if ($errors->any())
                <div class="alert alert-danger mt-0">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif
                
                <form action="{{url('forgetpassword')}}" method="POST">
                    @csrf
                    <input type="email" name="email" class="input" placeholder="Email">
                    <input type="password" name="password" class="input" placeholder="New Password">
                    <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password">
                    <ul class="d-flex justify-content-between">
                        <li><input type="checkbox"> <label for="">Remember me</label></li>
                        <li><a href="{{url('user-login')}}">Login</a></li>
                    </ul>

                    <a href=""><button type="submit" class="login-button">Submit</button></a>
                </form>
               
            </div>
        </div>
    </div>
 </section>
 @include('usernew.footer')