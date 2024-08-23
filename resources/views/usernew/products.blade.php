@include('usernew.header')
@yield('header')
<style>
  .products
  {
    color: #0D41E1 !important;
  }
  .card-header .title {
    font-size: 20px;
 
    color: #000;
}
.card-header .accicon {
  float: right;
  font-size: 20px;  
  width: 1.2em;
}
.card-header{
  cursor: pointer;
  border-bottom: none;
}
.card{
  border: 1px solid #ddd;
}
.card-body{
  border-top: 1px solid #ddd;
}
.card-header:not(.collapsed) .rotate-icon {
  transform: rotate(180deg);
}
</style>
  <!-- Banner section -->
  <section class="banner product-banner">
    <div class="container">
        <div class="content">
           <h3>Products</h3>



           <ul>
             <li><img src="{{url('usernew/img/rupee.png')}}" alt=""> <span>Affordable</span></li>
             <li><img src="{{url('usernew/img/diamond.png')}}" alt=""> <span>Best Quality</span></li>
             <li><img src="{{url('usernew/img/car.png')}}" alt=""> <span>Timely Delivery</span></li>
           </ul>
        </div>
    </div>
 </section>
<!-- Banner section end -->

<!-- product -->

<section class="product">
 <div class="container">

   
   <div class="row">
     <div class="col-lg-3">
       <div class="content">

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        
     
        <div class="accordion" id="accordionExample">
          <div class="card">
              <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
                  <span class="title">Availability</span>
                  <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
              </div>
              <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                  <div class="card-body">
                    <ul class="pl-4 pt-3">
                      <li>In stock ({{$instock}})</li>
                      <li>Out of stock ({{$outofstock}})</li>
                     </ul>
                  </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">     
                  <span class="title">Category</span>
                  <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
              </div>
              <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                  <div class="card-body">
                    <ul class="catagory-ul pt-3">
                      @foreach ($catagory as $item)
                        <li>{{$item->category_name}}</li>
                     @endforeach
                    </ul>
                  </div>
              </div>
          </div>
         
      </div>







{{-- 
          <div class="heading">
           <h5>Availability</h5>
           <i class="fa-solid fa-angle-up"></i>
          </div>

          <ul class="pl-4 pt-3">
           <li>In stock ({{$instock}})</li>
           <li>Out of stock ({{$outofstock}})</li>
          </ul>

          <div class="heading mt-5">
           <h5>Category</h5>
          </div>

          <ul class="catagory-ul pt-3">
            @foreach ($catagory as $item)
              <li>{{$item->category_name}}
                <i class="fa-solid fa-angle-up"></i>
              </li>
           @endforeach
          </ul> --}}
       </div>
     </div>
     <div class="col-lg-9">
       <div class="product-list">
          <div class="container">

           <div class="short-by">
             <ul>
              <li>Showing 1-6 of 6 Results</li>
              <li>
                <select name="" class="nice-select" id="select-sorting">
                  <option value="" selected disabled>Sort By</option>
                  <option>Default sorting</option>
                  <option value="new">Sort by new arrivals</option>
                  <option value="lth">Sort by price: low to high</option>
                  <option value="htl">Sort by price: high to low</option>
                </select>
              </li>

              {{-- <li>
               {{-- <div class="img-box">
                 <span class="span-border"><img src="{{url('usernew/img/Group 9438.png')}}" alt=""></span>
                 <span><img src="{{url('usernew/img/Group 9439.png')}}" alt=""></span>
               </div> 
              </li> --}}
             </ul>
          </div>

           <div class="row"  id="show">
            @foreach ($products as $key => $item)
             <div class="col-lg-4">
               <div class="product-box">
                 <div class="img">
                   <a href="{{url('product/' . $item->product_id)}}"><img src="{{ url('image/' . $item->image) }}" alt=""></a>
                 </div>
                 <input type="hidden" id="product_id{{ $item->product_id }}"
                 name="" value="{{ $item->product_id }}">
                 
                 <div class="content">
                   <h3>{{ $item->product_name }} </h3>
                   @if (auth()->check())
                    @if ($item->discount_price)
                    <p class="text-new">
                      ₹ <span id="price{{ $item->product_id }}">{{ $item->discount_price }}</span>
                      <span>₹ {{ $item->price }}</span></p>
                    @else
                    <p class="text-new" >
                      ₹ <b id="price{{ $item->product_id }}">{{ $item->price  }}</b>
                      </p>
                    @endif
                    @else
                    {{-- <p class="text-new">
                      ₹ {{ $item->price  }}
                      </p> --}}
                  @endif
                   <p class="text">{{$item->description}}.</p>
                   @if (auth()->check())
                   <ul class="d-flex justify-content-between aling-items-center mt-5">
                     <li><button  id="cart2{{ $item->product_id }}"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button></li>
                     
                     <li class="pt-2"><a href="">
                  @foreach ($stock as $value)
                      @if(is_object($value) && property_exists($value, 'product_id') && $value->product_id == $item->product_id)
                          {{ $value->stocks }} Available ?  {{ $value->stocks }} Available :   Not Available
                      @endif
                  @endforeach
              
                    
                    </a></li>
                   </ul>
                   @endif
                 </div>
               </div>
             </div>
            
                      @if (auth()->check())
                         

                              <input type="hidden"
                                  value="{{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }}"
                                  name="no_of_products"
                                  id="no_of_products{{ $item->product_id }}"
                                  class="cart-plus-minus-box"
                                  oninput="validateMinimumValue(this, {{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }})">

                              <script>
                                  function validateMinimumValue(input, minValue) {
                                      if (input.value < minValue) {
                                          input.value = minValue; // Set the input value to the minimum value
                                      }
                                  }
                              </script>


                         
                      @endif
                  
             @endforeach

           
           </div>

          </div>
       </div>
     </div>
   </div>
 </div>
 
</section>
@foreach ($products as $key => $item)
<script>
    $(document).ready(function() {



        $('#cart2{{ $item->product_id }}').on('click',function() {
            var product_id = $('#product_id{{ $item->product_id }}').val();
            var price = $('#price{{ $item->product_id }}').text();
            var moq = $('#no_of_products{{ $item->product_id }}').val();
             //alert(price);return;
            jQuery.ajax({
                url: '{{ url('cart/add') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: product_id,
                    moq: moq,
                    price: price
                },
                success: function(response) {
                    // $('#add_to_cart_modal1{{ $item->product_id }}').modal('show');
                    alert('Successfully added to your Cart');
                    location.reload();
                }
            });
        });

    });
</script>
@endforeach
@include('usernew.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@if(auth()->check())
<script>
  $(document).ready(function() {
      $('#select-sorting').change(function() {
          var sort_value = $('#select-sorting').val();
          jQuery.ajax({
              url: '{{ url('filter-products-auth') }}',
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                  sort_value: sort_value,
              },
              success: function(response) {
                  $('#show').html(response.data1);
                

              }
          });
      });
  });
</script>
@else
<script>
  $(document).ready(function() {
      $('#select-sorting').change(function() {
          var sort_value = $('#select-sorting').val();
          jQuery.ajax({
              url: '{{ url('filter-products') }}',
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                  sort_value: sort_value,
              },
              success: function(response) {
                  $('#show').html(response.data);
                 // $('#show2').html(response.data1);

              }
          });
      });
  });
</script>


@endif