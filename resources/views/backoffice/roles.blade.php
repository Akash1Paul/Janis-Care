@include('backoffice.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('backoffice.navbar')                        

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Roles</h4>
                                </div>
                            </div>
                        </div>      
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">All Roles</h4>
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
                                                    <select class="form-control mb-3" id="roles">
                                                        <option value="allroles"selected>All Roles</option>
                                                        <option value="warehouse">Warehouse</option>
                                                        <option value="territory">Territory Manager</option>
                                                        <option value="relationship">Relationship Manager</option>
                                                        <option value="runner">Runner</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div> 
                                                <div class="mx-3">
                                                    <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                </div>
                                                <div>
                                                    <a href="{{url('backoffice/addroles')}}"><button type="button" class="btn btn-primary waves-effect waves-light">Add</button></a>
                                                </div>

                                            </div>  
                                        </div>
                                    <form action="{{url('backoffice/rolesimport') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex justify-content-end">
                                      @csrf
                                      <input type="file" name="file"
                                             class="form-control" style="width: 30%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('backoffice/rolesexport') }}">
                                                Export
                                        </a>
                                    </form>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Joining Date</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Number</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    @foreach ($users as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            @if($item->roles=='warehouse')
                                                                Warehouse
                                                            @elseif($item->roles=='admin')
                                                                Admin
                                                            @elseif($item->roles=='runner')
                                                               Runner
                                                            @elseif($item->roles=='relationship')
                                                               Relationship Manager
                                                            @elseif($item->roles=='customer')
                                                               Customer
                                                            @elseif($item->roles=='territory')
                                                                Territory Manager
                                                            @elseif($item->roles=='inventory')
                                                                Inventory
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->showpassword }}</td>
                                                        <td> @if ($item->status == 'Approved')
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>
                                                        @elseif($item->status =='NotApproved')
                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>
                                                        @elseif($item->status =='Correction')
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light">Need Correction</button>
                                                        @endif</td>
                                                    </tr>
                                                    @endforeach
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

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

@include('backoffice.footer')

<script>
    function filterroles() {
      let roles = document.getElementById('roles').value;
      //console.log(roles);
      let url = "{{ url('backoffice/filter-roles') }}" + "/" + "roles=" + roles;

      let li;

      document.getElementById('datatable').innerHTML = '';

      fetch(url).then(response => response.json()).then(json => {

        let li = `<thead>
            <tr>
                <th>#</th>
                <th>Joining Date</th>
                <th>Name</th>
                <th>Role</th>
                <th>Number</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
            </tr>
        </thead>`;

        json.forEach(roles => {
            let getDate = new Date(roles.created_at);
            let date = getDate.getDate() + "-" + (getDate.getMonth() + 1) + "-" +  getDate.getFullYear();
            let  oldroles = roles.roles;
            let newroles = '';
            if(oldroles == 'warehouse') { newroles = "Warehouse"; }
            else if(oldroles == 'runner') { newroles = "Runner"; }
            else if(oldroles == 'relationship') { newroles = "Relationship Manager"; }
            else if(oldroles == 'admin') { newroles = "Admin"; }
            else if(oldroles == 'customer') { newroles = "Customer"; }
            else if(oldroles == 'territory') { newroles = "Territory Manager"; }
            else if(oldroles == 'inventory') { newroles = "Inventory"; }

            let status = roles.status;
            let newstatus = '';
            if (status == 'Approved')
                newstatus = `<button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>`;
            else if(status == 'NotApproved')
                newstatus =`<button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>`;
            else if('Correction')
                newstatus = `<button type="button" class="btn btn-outline-info waves-effect waves-light">Need Correction</button>`;
                                                    

          li += `
        <tbody>
        <tr>
            <td>${roles.id}</td>
            <td>${date}</td>
            <td>${roles.name}</td>
            <td>${newroles}</td>   
            <td>${roles.phone}</td> 
            <td>${roles.email}</td>  
            <td>${roles.showpassword}</td>  
            <td>${newstatus}</td>  
        </tr>
        </tbody>`;

          console.log(li);
        });
        document.getElementById('datatable').innerHTML = li;

      });

    }

    jQuery(document).ready(function() {

$('#roles').change(function() {
    var roles = $('#roles').val();
    if(roles == 'allroles')
    {
        window.location.reload();
    }else{

  
    jQuery.ajax({
        url: '{{ url('backoffice/filter-roles') }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          roles: roles,
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