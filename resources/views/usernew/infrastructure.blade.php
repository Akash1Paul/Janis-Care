@include('usernew.header')
@yield('header')
<style>
  .infrastructure
  {
    color: #0D41E1 !important;
  }
</style>

    <div class="infrastructure-banner">
        <div class="container">
            <div class="content">
                <h1>In House Manufacturing</h1>

                <ul>
                    <li>Medicines</li>
                    <li>Surgical Solutions</li>
                    <li>Medical Equipments</li>
                </ul>

                <img src="{{url('usernew/img/african.png')}}" alt="">
            </div>
        </div>
    </div>

    <div class="Manufacturing">
        <div class="container">
            <h3>Our Manufacturing Process</h3>
            <p>We take pride in our comprehensive in-house manufacturing process that allows us to control quality, reduce costs, and ensure  timely <br /> delivery of products. Our facilities are equipped with the latest technology and machinery to meet the highest standards of production.</p>
        </div>

        <img src="{{url('usernew/img/caucasian.png')}}" alt="">
    </div>

    <div class="house-supplly">
        <div class="container">
            <h3>In-House Supply Chain</h3>
            <p>Seamless and efficient supply chain management.</p>

            <ul class="d-flex justify-content-center">
                <li><img src="{{url('usernew/img/house-inner.png')}}" alt=""></li>
            </ul>
        </div>
    </div>

    <div class="Manufacturing">
        <div class="container">
            <h3>Streamlined Supply Chain Operations</h3>
            <p>Our in-house supply chain Processes allow us for real-time inventory monitoring and logistics management. We ensure that every component is available when needed, Product is timely delivered.</p>

            <img src="{{url('usernew/img/newly.png')}}" class="img-newly" alt="">
        </div>

        
    </div>

    <div class="house-supplly">
        <div class="container">
            <h3>In-House Customer Support</h3>
            <p>Seamless and efficient supply chain management.</p>

            <ul class="d-flex justify-content-center">
                <li><img src="{{url('usernew/img/custommer-support.png')}}" alt=""></li>
            </ul>
        </div>
    </div>

    <div class="support-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content">
                        <h3>Simplified Online <br>
                            Ordering</h3>

                        <img src="{{url('usernew/img/order.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="content">
                        <h3>Customer Support <br>
                            Excellence</h3>

                        <img src="{{url('usernew/img/checking.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="content">
                        <h3>Online Platform for <br>
                            Order Placements</h3>

                        <img src="{{url('usernew/img/e-commerce.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('usernew.footer')