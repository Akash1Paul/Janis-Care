    <!-- Utilize Cart Menu Start -->
    <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">Cart</span>
                <button class="ltn__utilize-close">×</button>
            </div>
         
             <div class="mini-cart-product-area ltn__scrollbar">
@if (auth()->check())
    
                @foreach ($carts as $item)
    
                <div class="mini-cart-item clearfix{{ $item->id }}">
                    <div class="mini-cart-img">
                        <a href="#"><img src="{{ url('image/'.$item->image) }}" alt="Image"></a>
                        <span class="mini-cart-item-delete" id="delete{{$item->id}}" >
                            <i class="icon-cancel"></i>
                        </span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">{{ $item->product_name }}</a></h6>
                        <span class="mini-cart-quantity">{{ $item->quantity}} x {{$item->cart_price }} INR</span>
                    </div>
                </div>
                @endforeach
   

            </div>
    
        
        @php
            $subtotal = 0;
            foreach ($carts as $item) {
                $subtotal += $item->quantity *$item->cart_price;
            }
        @endphp
        
        <div class="mini-cart-footer">
            <div class="mini-cart-sub-total">
                <h5>Subtotal: <span>{{ $subtotal }} INR</span></h5>
            </div>
        </div> 
        @endif
        
        <div class="btn-wrapper">
        @if (auth()->check()&& auth()->user()->roles!==null)
        <a href="{{ url('checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
            
        @endif   

        </div>
                {{-- <p>Free Shipping on All Orders Over 100 INRINR !</p> --}}
            </div>
          
        </div>
    </div>
    <!-- Utilize Cart Menu End -->
       <!-- MODAL AREA START (Add To Cart Modal) -->
       <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href=""><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></a>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="modal-product-img">
                                            
                                        </div>
                                         <div class="modal-product-info">
                                            <h5><a href=""></a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i>  Iteam Remove From Your Cart</p>
                                           
                                         </div>
                                       
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->
@if (auth()->check())
    
@php
    // dd($carts);
@endphp
    @foreach ($carts as $item)

    <input type="hidden" name="" id="product_id{{ $item->id }}" value="{{ $item->product_id }}">
    <script>
        $(document).ready(function() {
            $('#delete{{ $item->id }}').click(function() {
                $('.clearfix{{ $item->id }}').remove();

            
                const product_id= $('#product_id{{ $item->id }}').val();
        
                jQuery.ajax({
                    url: '{{ url("cart/delete") }}',
            
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{
                      product_id:product_id
                     },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
        
    </script>
    <div class="mini-cart-item clearfix{{ $item->id }}"style="display:none">
        <div class="mini-cart-img">
            <a href="#"><img src="{{ url('image/'.$item->image) }}" alt="Image"></a>
            <span class="mini-cart-item-delete" id="delete{{ $item->id }}">
                <i class="icon-cancel"></i>
            </span>
    </div>
        <div class="mini-cart-info">
            <h6><a href="#">{{ $item->product_name }}</a></h6>
            <span class="mini-cart-quantity">{{ $item->quantity}} x {{$item->cart_price }} INR</span>
        </div>
    </div>


@endforeach
@endif