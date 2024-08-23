@include('usernew.header')
@yield('header')

    <!-- Banner section -->
      <section class="product-banner-newly">
        <div class="container">
            <h1>Product Details</h1>
        </div>
      </section>
    <!-- Banner section end -->

    <section class="add-cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cart-box-img">
                        <img src="{{ url('image/' . $product[0]->image) }}" alt=""  id="main">
                    </div>
                    <script>
                      const change = src => {
                          document.getElementById('main').src = src
                      }
                  </script>
                     <div class="row mt-3">
                      @foreach (explode(',', $product[0]->others_image) as $item)
                        <div class="col-lg-4">
                            <img src="{{ url('storage/' . $item) }}" alt=""  onclick="change(this.src)">
                        </div>
                      @endforeach
                     </div>

                    
                </div>

                <div class="col-lg-6">
                    <div class="add-content">
                        <h3 class="h3-newly">{{ $product[0]->product_name }}</h3>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        @if (auth()->check())
                        <input type="hidden" id="product_id{{ $product[0]->product_id }}"
                 name="" value="{{ $product[0]->product_id }}">
                          @if ($product[0]->discount_price)
                          <h4 class="h4-text" id="price{{ $product[0]->price }}">{{ $product[0]->discount_price }} <span class="pl-3">{{ $product[0]->price }}</span></h4> 
                          @else
                          <h4 class="h4-text" id="price{{ $product[0]->product_id }}">{{ $product[0]->price }} </h4> 
                          @endif

                        @endif
                        <p>{{ $product[0]->description }}.</p>

                        @if (auth()->check())
                        <button class="cart-plus-minus add-button-newly">
                          <span class="minus" onclick="decrementQuantity(this)">-</span>
                          <input type="text"
                              value="{{ $product[0]->order_quantity != null ? $product[0]->order_quantity : $product[0]->min_order_quantity }}"
                              name="no_of_products"
                              id="no_of_products{{ $product[0]->product_id }}"
                              class="cart-plus-minus-box"
                              min="{{ $product[0]->min_order_quantity }}"
                              oninput="validateMinimumValue(this, {{$product[0]->order_quantity != null ? $product[0]->order_quantity : $product[0]->min_order_quantity }})">
                          <span class="plus" onclick="incrementQuantity(this)">+</span>
                        </button>
                      
                      <script>
                          function validateMinimumValue(input, minValue) {
                              if (parseInt(input.value) < minValue) {
                                  input.value = minValue; // Set the input value to the minimum value
                              }
                          }
                      
                          function decrementQuantity(element) {
                              var inputField = element.nextElementSibling; // Get the input field
                              var currentValue = parseInt(inputField.value);
                              var minValue = parseInt(inputField.getAttribute('min')); // Get the minimum value from the input field
                              if (!isNaN(currentValue) && currentValue > minValue) {
                                  inputField.value = currentValue - 1;
                              }
                          }
                      
                          function incrementQuantity(element) {
                              var inputField = element.previousElementSibling; // Get the input field
                              var currentValue = parseInt(inputField.value);
                              inputField.value = isNaN(currentValue) ? 1 : currentValue + 1;
                          }
                      </script>
                      
                      
                                                                  
                                                                @endif
                        {{-- <button class="add-button-newly"><span class="pr-3">-</span>  <span class="pr-3">1</span> <span> +</span></button> --}}
                        @if (auth()->check())
                        <button class="add-button" id="cart2{{ $product[0]->product_id }}">Add To Cart</button>
                        @endif
                        <ul class="ul-newly">
                            {{-- <li><i class="fa-regular fa-heart"></i> Add To Wishlist</li>
                            <li>
                                <h6>Availability</h6>
                                <p>7 In Stocks</p>
                            </li> --}}


                        </ul>

                        <div class="catagory">
                            <ul>
                                <li>Categories:</li>
                                <li><button>{{ $product[0]->categories }}</button></li>
                                
                            </ul>
                        </div>

                        {{-- <div class="catagory">
                            <ul>
                                <li>Tags:</li>
                                <li><button>Corona</button></li>
                                <li><button>Mask</button></li>
                                <li><button>Virus</button></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="review-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                            </li>
                            {{-- <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Reviews (2)</a>
                            </li> --}}
                            
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="description">
                                    <p>{{ $product[0]->description }}.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- product -->

     <section class="product padding-product">
      <div class="container">

            <div class="product-list">
               <div class="container">

                <h3 class="text-h3">Recommended Products</h3>

                <div class="row">
@foreach ($recomendation_product as $item)
<div class="col-lg-3">
  <div class="product-box">
    <div class="img">
      <a href="{{url('product/' . $item->product_id)}}"><img src="{{ url('image/' . $item->image) }}" alt=""></a>
    </div>

    <div class="content">
      <h3>{{$item->product_name}}</h3>
      @if (auth()->check())
      @if ($item->discount_price)
      <p class="text-new">
        ₹ {{ $item->discount_price }}
        <span>₹ {{ $item->price }}</span></p>
      @else
      <p class="text-new">
        ₹ {{ $item->price  }}
        </p>
      @endif
      @else
      {{-- <p class="text-new">
        ₹ {{ $item->price  }}
        </p> --}}
    @endif
    @if (auth()->check())
      <ul class="d-flex justify-content-between aling-items-center mt-5">
       
        
      </ul>
      @endif
    </div>
  </div>
</div>
@endforeach
                  

                </div>
               </div>
            </div>
          
      </div>
     </section>
    
@include('usernew.footer')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script>
  
           $('#cart2{{ $product[0]->product_id }}').on('click',function() {
               var product_id = $('#product_id{{ $product[0]->product_id }}').val();
               var price = $('#price{{ $product[0]->product_id }}').text();
               var moq = $('#no_of_products{{ $product[0]->product_id }}').val();
                //alert(moq);return;
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
   
  
   </script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>