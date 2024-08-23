@include('usernew.header')
@yield('header')
<style>
    .contact {
        color: #0D41E1 !important;
    }
</style>
<!-- Banner section -->
<section class="contact-main">
<section class="banner contact-banner">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 contact-banner-content">
                <div class="content">
                    <h3>Contact Us</h3>

                    <ul>
                        <li>
                            <h5>Medicines</h5>
                        </li>
                        <li>
                            <h5>Surgical Solutions</h5>
                        </li>
                        <li>
                            <h5>Medical Equipments</h5>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-7">
                <img class="img-fluid" src="{{url('usernew/img/Group 9552.png')}}" alt="" style="margin-top:60px">
            </div>
            {{-- <div class="col-lg-3">
            </div>
            <div class="col-lg-5 ">
                <img src="{{url('usernew/img/Janis-Hand.png')}}" alt="" class="Janis-Hand">
            </div> --}}
        </div>
    </div>
</section>
<section class="map" style="position: relative;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
        <div class="location">
            <div class="row" style="padding-top: 30px;">
                <div class="col-lg-8">
                    <img src="{{url('usernew/img/location.png')}}" alt="" style="height:316px; width:630px">
                </div>
                <div class="col-lg-4 ">
                    <h5 class="address">Address</h5>
                    <p>Block No.: 79, Siyada Road, Khudvel,<br> Kaliyari, Chikhli, Dist. Navsari,<br> Gujarat -396 540. INDIA</p>
                    <h5 class="address">Email</h5>
                    <p>E-mail: info@janiscare.com</p>
                    <h5 class="address">Phone</h5>
                    <p>+91 63 5111 0446</p>
                </div>
            </div>
        </div>
            </div>
        </div>
    
    <div class="contact-pic">
        {{-- <img src="{{url('usernew/img/Group 11.png')}}" class="group-11" alt="">
        <img src="{{url('usernew/img/Group 12.png')}}" class="cnt-janis " alt="">
        <img src="{{url('usernew/img/Group 12.png')}}" class="cnt-janis2 " alt=""> --}}
    </div>
    <div class="text-center">
        <h2>Inquiry Form</h2>
    </div>
        <div class="form">
            <img src="{{url('usernew/img/Group 11.png')}}" class="cnt-janis3" alt="">
            <img src="{{url('usernew/img/Group 12.png')}}" class="cnt-janis " alt="">
            <img src="{{url('usernew/img/Group 12.png')}}" class="cnt-janis2 " alt="">
            <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-10">
                    <form action="{{url('contact')}}" method="POST">
                        @csrf
                        <div class="row">  
                            <div class="col-md-6 mb-3">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Name" required>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone" required>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="company" value="{{old('company')}}" class="form-control" placeholder="Company" required>
                                @error('company')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" id="" cols="20" rows="5" placeholder="Message" required>{{old('message')}}</textarea>
                                @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 text-center mt-4">
                            <button class="btn btn-primary contact-btn" type="submit">Submit</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div> 
</section>

</section>

@include('usernew.footer')