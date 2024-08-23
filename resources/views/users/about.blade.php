@include('users.header')
@yield('header')
@yield('mobile-header')
@include('users.cart')
@yield('mobile-menu')

<body>
 
  <main id="main">
    <section id="about">
      <div class="container" data-aos="fade-up">

        <header class="section-header text-center mt-1">
          <h3>About Us</h3>
          
        </header>

        

        <div class="row about-extra">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{'user/img/about-extra-1.svg'}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0" data-aos="fade-left">
            <h4>About Janis Care</h4>
            <p>Janis Care, incepted in 2020, is our initiative to take the battle against COVID-19 into our hands.</p>
            <p>
              The pandemic rocked the world, took many lives, and changed several other lives forever. People lost loved ones, jobs, and in the end, hope. The frontliners were doing their best but watching them suffer without proper, good quality, protective gear was heart-wrenching.
            </p>
            <p>
              We wanted to make a difference for society by helping it be protected and secure. We wanted to secure the frontliners so they could do their best to protect the infected.
            </p>
            <p>Thus, Janis Care was established.</p>
          </div>
        </div>

        <div class="row about-extra">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
            <img src="user/img/about-extra-2.svg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-right">
            <h4>Our Infrastructure</h4>
            <p>
              Our endeavour started and grew manifold within a few months.
            </p>
            <p>
              We have our manufacturing plant in Surat with state-of-the-art machinery to create our high-quality products. Our masks are manufactured in a sophisticated infrastructure supervised by the best medical experts. The products are packed and distributed across the country.
            </p>
            <p>
              We ensure that our products reach far and wide, to frontliners and commoners, and to every part of the society. 
            </p>
            <p>We take pride in being able to provide India with the high-quality protective gear it needs to fight this deadly virus.</p>
          </div>

        </div>

      </div>
    </section>
  </main>
</body>


@include('users.footer')