@include('superadmin.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

          @yield('header')
          
          @yield('topnav')

          <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-13">Correction</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">Correction</h4>
                                    <div class="fields d-flex"> 
                                        <div>
                                            <div class="input-group">    
                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                               
                                            </div>
                                        </div> 
                                        <div class="mx-3">
                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                        </div>                                     
                                        <div class="ml-3">                                       
                                            <select class="form-control mb-3" id="status">
                                                <option selected value="all">All</option>
                                                <option value="Correction">Correction</option>
                                                <option value="Approved">Approved</option>
                                                <option value="NotApproved">Not Approved</option>
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>All Details</th>
                                                <th>Status</th> 
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @isset($customers)
                                            @foreach ($customers as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                                <td>{{ $item->company_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <a href="{{url('superadmin/correctiondetails/'.$item->email)}}">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($item->status == 'Approved')
                                                        <button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>
                                                    @elseif($item->status == 'NotApproved')
                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>
                                                    @elseif($item->status == 'Correction')
                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light">Need Correction</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- end card-body-->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row-->
                </div>
                <!--end row-->

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Runner & Vehicle</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="fields">   
                                            <h6 class="mt-2 mb-2">Select Runner</h6>                                         
                                            <select class="form-control mb-3">
                                                <option disabled selected>Select One</option>
                                                <option>Runner</option>
                                            </select>
                                        </div>
                                        <div class="fields">                                             
                                            <h6 class="mt-4 mb-2">Select Vehicle</h6>                                         
                                            <select class="form-control mb-3">
                                                <option disabled selected>Select One</option>
                                                <option>Bike</option>
                                            </select>
                                        </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#"><button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Submit</button></a>
                                    <a href="#"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div><!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
@include('superadmin.footer')
<script>
    // function filterroles() {
    //   let status = document.getElementById('status').value;
    //   //console.log(roles);
    //   let url = "{{ url('superadmin/filter-correction') }}" + "/" + "status=" + status;

    //   let li;

    //   document.getElementById('datatable').innerHTML = '';

    //   fetch(url).then(response => response.json()).then(json => {

    //     let li = `<thead>
    //         <tr>
    //             <th>Id</th>
    //             <th>Date</th>
    //             <th>Customer</th>
    //             <th>City</th>
    //             <th>All Details</th>
    //             <th>Status</th> 
    //         </tr>
    //     </thead>`;

    //     json.forEach(roles => {
    //         let getDate = new Date(roles.created_at);
    //         let date = getDate.getDate() + "-" + (getDate.getMonth() + 1) + "-" +  getDate.getFullYear();
           
    //         let status = roles.status;
    //         let newstatus = '';
    //         if (status == 'Approved')
    //             newstatus =  `<button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>`;
    //         else if(status == 'NotApproved')
    //             newstatus = `<button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>`;
    //         else if('Correction')
    //             newstatus = `<button type="button" class="btn btn-outline-info waves-effect waves-light">Need Correction</button>`;
                                                    

    //       li += `
    //     <tbody>
    //     <tr>
    //         <td>${roles.id}</td>
    //         <td>${date}</td>
    //         <td>${roles.spoc_name}</td>
    //         <td>${roles.city}</td> 
    //         <td>
    //             <a href="{{url('superadmin/correctiondetails/')}}/${roles.email}">
    //             <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
    //             </a>
    //         </td> 
    //         <td>${newstatus}</td>  
    //     </tr>
    //     </tbody>`;

    //       console.log(li);
    //     });
    //     document.getElementById('datatable').innerHTML = li;

    //   });

    // }
    

jQuery(document).ready(function() {

      $('#status').change(function() {
          var status = $('#status').val();
          if(status == 'all')
          {
              window.location.reload();
          }else{

        
          jQuery.ajax({
              url: '{{ url('superadmin/filter-correction') }}',
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                status: status,
              },
              success: function(response) {
              
                  $('#myTable').html(response.data);
              },
              error: function(xhr, status, error) {
                  var errorMessage = xhr.status + ': ' + xhr.statusText;
                  alert('Error - ' + errorMessage);
              }
          });
      }
      });
  });

    function resetFilter() {
        window.location.reload();
      }
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
   $("#search-button").click(function(){
              $.each($("#datatable tbody tr"), function() {

                  if($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                      $(this).hide();
                  else
                      $(this).show();                
              });
          }); 
</script>

    </body>

</html>