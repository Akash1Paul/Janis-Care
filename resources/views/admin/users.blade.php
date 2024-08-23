@include('admin.header')

    
<style>
    .preview-image {
        max-width:150px;
        height: 150px;
        margin-top: 5px;
    }
</style>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            @yield('header')

            @yield('topnav')

            @if ($layout == 0)
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
                                                        <input type="text" id="search" class="form-control"
                                                            placeholder="Search ..." aria-label="Recipient's username">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="search-button"><i
                                                                    class="mdi mdi-magnify"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mx-3">
                                                    <select class="form-control mb-3"id="roles">
                                                        <option value="allroles" selected>All Roles</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="hr">HR</option>
                                                        <option value="backoffice">Back Office</option>
                                                        <option value="territory">Territory Manager</option>
                                                        <option value="relationship">Relationship Manager</option>
                                                        <option value="warehouse">Warehouse</option>
                                                        <option value="inventory">Inventory</option>
                                                        <option value="runner">Runner</option>
                                                    </select>
                                                </div>
                                                <div class="mx-3">
                                                    <a><button class="btn btn-primary waves-effect waves-light"
                                                            onclick="resetFilter()">Reset</button></a>
                                                </div>
                                                <a href="{{ url('admin/add-users') }}"><button type="button"
                                                        class="btn btn-primary waves-effect waves-light">Add</button></a>

                                            </div>
                                        </div>
                                        <form action="{{ url('admin/rolesimport') }}" method="POST"
                                            enctype="multipart/form-data" class="d-flex justify-content-end">
                                            @csrf
                                            <input type="file" name="file" class="form-control" style="width: 30%"
                                                required accept=".xls, .xlsx">
                                            <br>
                                            <button class="btn btn-success ml-3">
                                                Import
                                            </button>
                                            <a class="btn btn-warning ml-3" href="{{ url('admin/rolesexport') }}">
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    @foreach ($users as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>
                                                                @if ($item->roles == 'warehouse')
                                                                    Warehouse
                                                                @elseif($item->roles == 'admin')
                                                                    Admin
                                                                @elseif($item->roles == 'runner')
                                                                    Runner
                                                                @elseif($item->roles == 'relationship')
                                                                    Relationship Manager
                                                                @elseif($item->roles == 'customer')
                                                                    Customer
                                                                @elseif($item->roles == 'territory')
                                                                    Territory Manager
                                                                @elseif($item->roles == 'inventory')
                                                                    Inventory
                                                                @elseif($item->roles == 'hr')
                                                                    HR
                                                                    @elseif($item->roles == 'backoffice')
                                                                    Back Office
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->phone }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->showpassword }}</td>
                                                            <td>
                                                                <a
                                                                    href="{{ url('admin/edit-users/' . $item->email) }}">
                                                                    <button type="button"
                                                                        class="btn btn-primary waves-effect waves-light">Edit</button>
                                                                </a>
                                                                <a
                                                                    href="{{ url('admin/delete-users/' . $item->email) }}">
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light">Delete</button>
                                                                </a>
                                                            </td>
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

                </div>
            @elseif($layout == 1)
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{ url('admin/users') }}">Roles</a> >
                                        Add Role</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Role</h4>
                                        <form action="{{ url('admin/add-users') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Role<span
                                                                style="color: red"> *</span></label>
                                                        <select onchange="change(event)" name="roles"
                                                            class="form-control mb-3">
                                                            <option disabled selected>Select Role</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="hr">HR</option>
                                                            <option value="backoffice">Back Office</option>
                                                            <option value="territory">Territory Manager</option>
                                                            <option value="relationship">Relationship Manager</option>
                                                            <option value="warehouse">Warehouse</option>
                                                           
                                                            <option value="runner">Runner</option>
                                                        </select>
                                                        @error('roles')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-4" id="chooseWh" >

                                                    <div class="form-group">
                                                        <label for="warehouse">Warehouse <span
                                                                style="color: red">*</span></label>
                                                        <select name="warehouse_inventory" id=""
                                                            class="form-control">
                                                            <option value="">Select Warehouse</option>
                                                            @foreach ($warehouse as $item)
                                                                <option value="{{ $item->email }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div> --}}


                                                <div class="col-md-4" id="chooseTm">
                                                    <div class="form-group">
                                                        <label for="name">Choose Territory Manager <span
                                                                style="color: red">*</span></label>
                                                        <select class="form-control mb-3" name="territory_manager" id="chooseTminput">
                                                            <option disabled selected>Select One</option>
                                                            @foreach ($territory as $item)
                                                                <option value="{{ $item->email }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('territory_manager')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="chooseRm">
                                                    <div class="form-group">
                                                        <label for="name">Choose Relationship Manager <span
                                                                style="color: red">*</span></label>
                                                        <select class="form-control mb-3" name="relationship_manager" id="chooseRminput">
                                                            <option disabled selected>Select One</option>
                                                            @foreach ($relationship as $item)
                                                                <option value="{{ $item->email }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('relationship_manager')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="name">
                                                    <div class="form-group">
                                                        <label for="name">Name <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="name" id="nameinput" class="form-control"
                                                            placeholder="Enter Name">
                                                        @error('name')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="emplId">
                                                    <div class="form-group">
                                                        <label for="name">Employee Id <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="empid" id="empidinput" class="form-control"
                                                            placeholder="Enter Id">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="chooseWh">
                                                    <div class="form-group">
                                                        <label for="name">Choose Warehouse <span
                                                                style="color: red">*</span></label>
                                                        <select class="form-control mb-3" name="warehouse" id="wareChooseinput">
                                                            <option disabled selected>Select One</option>
                                                            @foreach ($warehouse as $item)
                                                                <option value="{{ $item->email }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('warehouse')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="phone">
                                                    <div class="form-group">
                                                        <label for="name">Phone Number<span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Number" id="phoneinput" name="phone">
                                                        @error('phone')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="workAdd">
                                                    <div class="form-group">
                                                        <label for="name">Work Address <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Work Address" id="workaddressinput" name="workaddress">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="homeAdd">
                                                    <div class="form-group">
                                                        <label for="name">Home Address <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Home Address" id="homeaddressinput" name="homeaddress">
                                                    </div>
                                                </div>
                                            
                                            
                                            <div class="col-md-4" id="addProof">
                                                <div class="form-group">
                                                    <label for="name">Upload Address Proof Document <span style="color: red">*</span></label>
                                                    <input type="file" name="addressproof" class="form-control" id="addressproofinput" onchange="previewImage('addressproofinput', 'addressProofPreview')">
                                                    <div id="addressProofPreview"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4" id="ageProof">
                                                <div class="form-group">
                                                    <label for="name">Upload Age Proof Document <span style="color: red">*</span></label>
                                                    <input type="file" name="document" class="form-control" id="documentinput" onchange="previewImage('documentinput', 'ageProofPreview')">
                                                    <div id="ageProofPreview"></div>
                                                </div>
                                            </div>


                                                {{-- <div class="col-md-4" id="wareName">
                                                    <div class="form-group">
                                                        <label for="name">Warehouse Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter Warehouse Name" name="warename">
                                                        @error('warename')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-4" id="city">
                                                    <div class="form-group"><label for="city">City<span
                                                        style="color: red"> *</span></label><select
                                                            name="city" class="form-control" id="cityinput">
                                                            <option disabled selected>Select</option>
                                                            <option value="Pune">Pune</option>
                                                            <option value="Mumbai">Mumbai</option>
                                                            <option value="Delhi">Delhi</option>
                                                            <option value="Haridwar">Haridwar</option>
                                                            <option value="Navasari">Navasari</option>
                                                            <option value="Goregaon">Goregaon</option>
                                                            <option value="Ghatkopar">Ghatkopar</option>
                                                            <option value="Lokhandwala">Lokhandwala</option>
                                                            <option value="RamMandir">Ram Mandir</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="wareLocation">
                                                    <div class="form-group">
                                                        <label for="name">Location <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Location" name="location">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="wareSpocName">
                                                    <div class="form-group">
                                                        <label for="name">SPOC Name <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter SPOC Name" name="spoc_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="wareSpocNumber">
                                                    <div class="form-group">
                                                        <label for="name">SPOC Number <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter SPOC Number" name="spoc_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="vehicleChoose">
                                                    <div class="form-group">
                                                        <label for="name">Choose Vehicle <span
                                                                style="color: red">*</span></label>
                                                        <div class="multiSelect">
                                                            <select multiple class="multiSelect_field"
                                                                data-placeholder="Add Vehicle" name="vehicle">
                                                                @foreach ($vehicle as $item)
                                                                    <option value="{{ $item->number }}">
                                                                        {{ $item->name . ' ' . $item->number }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="wareRunner">
                                                    <div class="form-group">
                                                        <label for="name">Choose Runner <span
                                                                style="color: red">*</span></label>
                                                        <div class="multiSelect2">
                                                            <select multiple class="multiSelect_field2"
                                                                data-placeholder="Add Runner" name="runner">
                                                                @foreach ($runner as $item)
                                                                    <option value="{{ $item->email }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="email">
                                                    <div class="form-group">
                                                        <label for="name">Email <span
                                                                style="color: red">*</span></label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Email" name="email" id="emailinput">
                                                        @error('email')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="password">
                                                    <div class="form-group">
                                                        <label for="name">Password <span
                                                                style="color: red">*</span></label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Enter Password" name="password" id="passwordinput">
                                                        @error('password')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="photo">
                                                    <div class="form-group">
                                                        <label for="name">Photo</label>
                                                        <input name="photo" type="file" class="form-control" id="photoinput">
                                                    </div>
                                                    <span style="color:red"> @error('photo')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                
                                                <div class="col-md-12" id="note">
                                                    <div class="form-group">
                                                        <label for="name">Note</label>
                                                        <textarea class="form-control" name="note" id="Note" placeholder="Enter Note" cols="30"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                    <div class="btns d-inline-block">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Submit</button>
                                                    </div>
                                                    <div class="btns d-inline-block">
                                                        <a href="{{ url('admin/users') }}"><button
                                                                type="button"
                                                                class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                    <!--end row-->
                </div>
                <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @elseif($layout == 2)
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-13"><a href="{{ url('admin/users') }}">Roles</a> > Edit
                                Roles</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Roles</h4>
                                <form action="{{ url('admin/edit-users/' . $user->email) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Role<span style="color: red">*</span></label>
                                                <select onchange="change(event)" name="roles"
                                                    class="form-control mb-3" id="yourSelect">
                                                    <option disabled selected>Select Role</option>
                                                    <option value="warehouse"
                                                        {{ $user['roles'] == 'warehouse' ? 'selected' : '' }}>Warehouse
                                                    </option>
                                                    <option value="territory"
                                                        {{ $user['roles'] == 'territory' ? 'selected' : '' }}>Territory
                                                        Manager</option>
                                                    <option value="relationship"
                                                        {{ $user['roles'] == 'relationship' ? 'selected' : '' }}>
                                                        Relationship Manager</option>
                                                    <option value="backoffice"
                                                        {{ $user['roles'] == 'backoffice' ? 'selected' : '' }}>Back
                                                        Office</option>
                                                    <option value="admin"
                                                        {{ $user['roles'] == 'admin' ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="runner"
                                                        {{ $user['roles'] == 'runner' ? 'selected' : '' }}>Runner
                                                    </option>
                                                </select>

                                                @error('roles')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="chooseTm">
                                            <div class="form-group">
                                                <label for="name">Choose Territory Manager <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control mb-3" name="territory_manager" id="chooseTminput">
                                                    <option disabled selected>Select One</option>

                                                    @foreach ($territory as $item)
                                                        @if ($item->email == $user['territory_manager'])
                                                            <option value="{{ $item->email }}" selected>
                                                                {{ $item->name }}</option>
                                                        @endif
                                                        <option value="{{ $item->email }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('territory_manager')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="chooseRm">
                                            <div class="form-group">
                                                <label for="name">Choose Relationship Manager <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control mb-3" name="relationship_manager" id="chooseRminput">
                                                    <option disabled selected>Select One</option>
                                                    @foreach ($relationship as $item)
                                                        @if ($item->email == $user['relationship_manager'])
                                                            <option value="{{ $item->email }}" selected>
                                                                {{ $item->name }}</option>
                                                        @endif
                                                        <option value="{{ $item->email }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('relationship_manager')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="name">
                                            <div class="form-group">
                                                <label for="name">Name <span style="color: red">*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter Name" value="{{ $user->name }}" id="nameinput">
                                                @error('name')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="emplId">
                                            <div class="form-group">
                                                <label for="name">Employee Id <span
                                                        style="color: red">*</span></label>
                                                <input type="text" name="empid" id="empidinput" class="form-control"
                                                    placeholder="Enter Id" value="{{ $user->empid }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="chooseWh">
                                            <div class="form-group">
                                                <label for="name">Choose Warehouse <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control mb-3" name="warehouse" id="wareChooseinput">
                                                    <option disabled selected>Select One</option>
                                                    @foreach ($warehouse as $item)
                                                        @if ($item->email == $user['warehouse'])
                                                            <option value="{{ $item->email }}" selected>
                                                                {{ $item->name }}</option>
                                                        @endif
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('warehouse')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="phone">
                                            <div class="form-group">
                                                <label for="name">Phone Number<span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Number"
                                                    name="phone" value="{{ $user->phone }}" id="phoneinput">
                                                @error('phone')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4" id="workAdd">
                                            <div class="form-group">
                                                <label for="name">Work Address <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Work Address" name="workaddress"
                                                    value="{{ $user->workaddress }}" id="workaddressinput">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="homeAdd">
                                            <div class="form-group">
                                                <label for="name">Home Address <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Home Address" name="homeaddress"
                                                    value="{{ $user->homeaddress }}" id="homeaddressinput">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="addProof">
                                            <div class="form-group">
                                                <label for="name">Upload Address Proof Document <span
                                                        style="color: red">*</span></label>
                                                <input type="file"   name="addressproof" class="form-control">
                                                <input type="hidden" name="addressproof" value="{{ $user->addressproof }}">
                                                <div id="addressProofPreview"></div>
                                                <img src="{{ url('image/'.$user->addressproof) }}" style="width: 50px;height:50px" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="ageProof">
                                            <div class="form-group">
                                                <label for="name">Upload Age Proof Document <span
                                                        style="color: red">*</span></label>
                                               
                                                   
                                                <input type="file" name="document" class="form-control" >
                                                <div id="ageProofPreview"></div>
                                                <input type="hidden" name="document" value="{{ $user->document }}">

                                                <img src="{{ url('image/'.$user->document) }}" style="width: 50px;height:50px" alt="">

                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4" id="wareCity">
                                            <div class="form-group">
                                                <label for="name">City <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter City"
                                                    name="city" value="{{ $user->city }}">
                                            </div>
                                        </div> --}}
{{-- 
                                        <div class="col-md-4" id="wareSpocName">
                                            <div class="form-group">
                                                <label for="name">SPOC Name <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter SPOC Name" name="spoc_name"
                                                    value="{{ $user->spoc_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="wareSpocNumber">
                                            <div class="form-group">
                                                <label for="name">SPOC Number <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter SPOC Number" name="spoc_number"
                                                    value="{{ $user->spoc_number }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-4" id="vehicleChoose">
                                            <div class="form-group">
                                                <label for="name">Choose Vehicle <span
                                                        style="color: red">*</span></label>
                                                <div class="multiSelect">
                                                    <select multiple class="multiSelect_field"
                                                        data-placeholder="Add Vehicle" name="vehicle">
                                                        @foreach ($vehicle as $item)
                                                            @if ($item->number == $user['vehicle'])
                                                                <option value="{{ $item->number }}" selected>
                                                                    {{ $item->name . ' ' . $item->number }}</option>
                                                            @endif
                                                            <option value="{{ $item->number }}">
                                                                {{ $item->name . ' ' . $item->number }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-4" id="wareRunner">
                                            <div class="form-group">
                                                <label for="name">Choose Runner <span
                                                        style="color: red">*</span></label>
                                                <div class="multiSelect2">
                                                    <select multiple class="multiSelect_field2"
                                                        data-placeholder="Add Runner" name="runner">
                                                        @foreach ($runner as $item)
                                                            @if ($item->email == $user['runner'])
                                                                <option value="{{ $item->email }}" selected>
                                                                    {{ $item->name }}</option>
                                                            @endif
                                                            <option value="{{ $item->email }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4" id="email">
                                            <div class="form-group">
                                                <label for="name">Email <span style="color: red">*</span></label>
                                                <input type="email" class="form-control" placeholder="Enter Email"
                                                    name="email" value="{{ $user->email }}" id="emailinput" readonly>
                                                @error('email')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Password <span
                                                    style="color: red">*</span></label>
                                                <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{$user->showpassword}}">
                                                @error('password')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4" id="photo">
                                            <div class="form-group">
                                                <label for="name">Photo</label>
                                                <input name="photo" type="file" class="form-control">
                                            </div>
                                            <span style="color:red"> @error('photo')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-4" id="city">
                                            <div class="form-group">
                                                <label for="name">City <span
                                                        style="color: red">*</span></label>
                                               
                                                    <select name="city" class="form-control"  id="cityinput">
                                                        <option disabled selected>Select</option>
                                                        <option value="Pune" {{ $user->city == 'Pune' ? 'selected' : '' }}>Pune</option>
                                                        <option value="Mumbai"  {{ $user->city == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                        <option value="Delhi" {{ $user->city == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                                        <option value="Haridwar"  {{ $user->city == 'Haridwar' ? 'selected' : '' }}>Haridwar</option>
                                                        <option value="Navasari"  {{ $user->city == 'Navasari' ? 'selected' : '' }}>Navasari</option>
                                                        <option value="Goregaon" {{ $user->city == 'Goregaon' ? 'selected' : '' }}>Goregaon</option>
                                                        <option value="Ghatkopar" {{ $user->city == 'Ghatkopar' ? 'selected' : '' }}>Ghatkopar</option>
                                                        <option value="Lokhandwala" {{ $user->city == 'Lokhandwala' ? 'selected' : '' }}>Lokhandwala</option>
                                                        <option value="RamMandir" {{ $user->city == 'RamMandir' ? 'selected' : '' }}>Ram Mandir</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="note">
                                            <div class="form-group">
                                                <label for="name">Note</label>
                                                <textarea class="form-control" name="note" id="Note" placeholder="Enter Note" cols="30"
                                                    rows="5">{{ $user->note }}</textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-12">
                                            <div class="btns d-inline-block">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">Submit</button>
                                            </div>
                                            <div class="btns d-inline-block">
                                                <a href="{{ url('admin/users') }}"><button type="button"
                                                        class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- end card-body-->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @endif

    </div>
    <!-- End Page-content -->
    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    @include('admin.footer')
    @if ($layout == 0)
        <script>
            jQuery(document).ready(function() {

                $('#roles').change(function() {
                    var roles = $('#roles').val();
                    if (roles == 'allroles') {
                        window.location.reload();
                    } else {


                        jQuery.ajax({
                            url: '{{ url('admin/filter-roles') }}',
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
        </script>
        <script>
            function resetFilter() {
                window.location.reload();
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $("#search-button").click(function() {
                $.each($("#datatable tbody tr"), function() {

                    if ($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        </script>
    @endif
    @if ($layout == 1)
        <script>
            jQuery(function() {
                jQuery('.multiSelect').each(function(e) {
                    var self = jQuery(this);
                    var field = self.find('.multiSelect_field');
                    var fieldOption = field.find('option');
                    var placeholder = field.attr('data-placeholder');

                    field.hide().after(`<div class="multiSelect_dropdown"></div>
                                <span class="multiSelect_placeholder">` + placeholder + `</span>
                                <ul class="multiSelect_list"></ul>
                                <span class="multiSelect_arrow"></span>`);

                    fieldOption.each(function(e) {
                        jQuery('.multiSelect_list').append(
                            `<li class="multiSelect_option" data-value="` + jQuery(this).val() + `">
                                                    <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                                </li>`);
                    });

                    var dropdown = self.find('.multiSelect_dropdown');
                    var list = self.find('.multiSelect_list');
                    var option = self.find('.multiSelect_option');
                    var optionText = self.find('.multiSelect_text');

                    dropdown.attr('data-multiple', 'true');
                    list.css('top', dropdown.height() + 5);

                    option.click(function(e) {
                        var self = jQuery(this);
                        e.stopPropagation();
                        self.addClass('-selected');
                        field.find('option:contains(' + self.children().text() + ')').prop('selected',
                            true);
                        dropdown.append(function(e) {
                            return jQuery('<span class="multiSelect_choice">' + self.children()
                                .text() +
                                '<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>'
                                ).click(function(e) {
                                var self = jQuery(this);
                                e.stopPropagation();
                                self.remove();
                                list.find('.multiSelect_option:contains(' + self
                                .text() + ')').removeClass('-selected');
                                list.css('top', dropdown.height() + 5).find(
                                    '.multiSelect_noselections').remove();
                                field.find('option:contains(' + self.text() + ')').prop(
                                    'selected', false);
                                if (dropdown.children(':visible').length === 0) {
                                    dropdown.removeClass('-hasValue');
                                }
                            });
                        }).addClass('-hasValue');
                        list.css('top', dropdown.height() + 5);
                        if (!option.not('.-selected').length) {
                            list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                        }
                    });

                    dropdown.click(function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        dropdown.toggleClass('-open');
                        list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
                    });

                    jQuery(document).on('click touch', function(e) {
                        if (dropdown.hasClass('-open')) {
                            dropdown.toggleClass('-open');
                            list.removeClass('-open');
                        }
                    });
                });
            });
        </script>
        <script>
            jQuery(function() {
                jQuery('.multiSelect2').each(function(e) {
                    var self2 = jQuery(this);
                    var field2 = self2.find('.multiSelect_field2');
                    var fieldOption2 = field2.find('option');
                    var placeholder2 = field2.attr('data-placeholder');

                    field2.hide().after(`<div class="multiSelect_dropdown"></div>
                                <span class="multiSelect_placeholder">` + placeholder2 + `</span>
                                <ul class="multiSelect_list multi2"></ul>
                                <span class="multiSelect_arrow"></span>`);

                    fieldOption2.each(function(e) {
                        jQuery('.multi2').append(`<li class="multiSelect_option" data-value="` + jQuery(
                            this).val() + `">
                                                    <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                                </li>`);
                    });

                    var dropdown2 = self2.find('.multiSelect_dropdown');
                    var list2 = self2.find('.multi2');
                    var option2 = self2.find('.multiSelect_option');
                    var optionText2 = self2.find('.multiSelect_text');

                    dropdown2.attr('data-multiple', 'true');
                    list2.css('top', dropdown2.height() + 5);

                    option2.click(function(e) {
                        var self2 = jQuery(this);
                        e.stopPropagation();
                        self2.addClass('-selected');
                        field2.find('option:contains(' + self2.children().text() + ')').prop('selected',
                            true);
                        dropdown2.append(function(e) {
                            return jQuery('<span class="multiSelect_choice">' + self2.children()
                                .text() +
                                '<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>'
                                ).click(function(e) {
                                var self2 = jQuery(this);
                                e.stopPropagation();
                                self2.remove();
                                list2.find('.multiSelect_option:contains(' + self2
                                .text() + ')').removeClass('-selected');
                                list2.css('top', dropdown2.height() + 5).find(
                                    '.multiSelect_noselections').remove();
                                field2.find('option:contains(' + self2.text() + ')')
                                    .prop('selected', false);
                                if (dropdown2.children(':visible').length === 0) {
                                    dropdown2.removeClass('-hasValue');
                                }
                            });
                        }).addClass('-hasValue');
                        list2.css('top', dropdown2.height() + 5);
                        if (!option2.not('.-selected').length) {
                            list2.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                        }
                    });

                    dropdown2.click(function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        dropdown2.toggleClass('-open');
                        list2.toggleClass('-open').scrollTop(0).css('top', dropdown2.height() + 5);
                    });

                    jQuery(document).on('click touch', function(e) {
                        if (dropdown2.hasClass('-open')) {
                            dropdown2.toggleClass('-open');
                            list2.removeClass('-open');
                        }
                    });
                });
            });
        </script>
        <script>
            function loaded() {
                document.getElementById("chooseTm").style.display = "none"
                document.getElementById("chooseRm").style.display = "none"
                document.getElementById("wareLocation").style.display = "none"
                document.getElementById("wareSpocName").style.display = "none"
                document.getElementById("wareSpocNumber").style.display = "none"
                document.getElementById("wareSpocNumber").style.display = "none"
                document.getElementById("vehicleChoose").style.display = "none"
                document.getElementById("wareRunner").style.display = "none"
                document.getElementById("chooseWh").style.display = "none"
            };
            loaded();

            function change(event) {
                let getVal = event.target.value;

                if (getVal == "relationship") {
                    document.getElementById("chooseTm").style.display = "block"
                    document.getElementById("chooseTminput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                
                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseRm").style.display = "none"
                }
                
                else if (getVal == "territory") {
                    document.getElementById("chooseRm").style.display = "none"
                   // document.getElementById("chooseRminput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                 

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseTm").style.display = "none"
                    document.getElementById("chooseWh").style.display = "none";
                } 
                else if (getVal == "runner") {
                    document.getElementById("chooseWh").style.display = "block"
                    document.getElementById("wareChooseinput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                  

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseTm").style.display = "none"
                    document.getElementById("chooseRm").style.display = "none"
                }
                else if (getVal == "admin" || getVal == "hr" || getVal == "backoffice" || getVal == "warehouse") {
                    console.log('reach');
                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseTm").style.display = "none";
                    document.getElementById("chooseRm").style.display = "none";
                    document.getElementById("chooseWh").style.display = "none";
                    console.log('reach2');
                }
              
            };
        </script>
    @elseif($layout == 2)
        <script>
            jQuery(function() {
                jQuery('.multiSelect').each(function(e) {
                    var self = jQuery(this);
                    var field = self.find('.multiSelect_field');
                    var fieldOption = field.find('option');
                    var placeholder = field.attr('data-placeholder');

                    field.hide().after(`<div class="multiSelect_dropdown"></div>
                                <span class="multiSelect_placeholder">` + placeholder + `</span>
                                <ul class="multiSelect_list"></ul>
                                <span class="multiSelect_arrow"></span>`);

                    fieldOption.each(function(e) {
                        jQuery('.multiSelect_list').append(
                            `<li class="multiSelect_option" data-value="` + jQuery(this).val() + `">
                                                    <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                                </li>`);
                    });

                    var dropdown = self.find('.multiSelect_dropdown');
                    var list = self.find('.multiSelect_list');
                    var option = self.find('.multiSelect_option');
                    var optionText = self.find('.multiSelect_text');

                    dropdown.attr('data-multiple', 'true');
                    list.css('top', dropdown.height() + 5);

                    option.click(function(e) {
                        var self = jQuery(this);
                        e.stopPropagation();
                        self.addClass('-selected');
                        field.find('option:contains(' + self.children().text() + ')').prop('selected',
                            true);
                        dropdown.append(function(e) {
                            return jQuery('<span class="multiSelect_choice">' + self.children()
                                .text() +
                                '<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>'
                                ).click(function(e) {
                                var self = jQuery(this);
                                e.stopPropagation();
                                self.remove();
                                list.find('.multiSelect_option:contains(' + self
                                .text() + ')').removeClass('-selected');
                                list.css('top', dropdown.height() + 5).find(
                                    '.multiSelect_noselections').remove();
                                field.find('option:contains(' + self.text() + ')').prop(
                                    'selected', false);
                                if (dropdown.children(':visible').length === 0) {
                                    dropdown.removeClass('-hasValue');
                                }
                            });
                        }).addClass('-hasValue');
                        list.css('top', dropdown.height() + 5);
                        if (!option.not('.-selected').length) {
                            list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                        }
                    });

                    dropdown.click(function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        dropdown.toggleClass('-open');
                        list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
                    });

                    jQuery(document).on('click touch', function(e) {
                        if (dropdown.hasClass('-open')) {
                            dropdown.toggleClass('-open');
                            list.removeClass('-open');
                        }
                    });
                });
            });
        </script>
        <script>
            jQuery(function() {
                jQuery('.multiSelect2').each(function(e) {
                    var self2 = jQuery(this);
                    var field2 = self2.find('.multiSelect_field2');
                    var fieldOption2 = field2.find('option');
                    var placeholder2 = field2.attr('data-placeholder');

                    field2.hide().after(`<div class="multiSelect_dropdown"></div>
                                <span class="multiSelect_placeholder">` + placeholder2 + `</span>
                                <ul class="multiSelect_list multi2"></ul>
                                <span class="multiSelect_arrow"></span>`);

                    fieldOption2.each(function(e) {
                        jQuery('.multi2').append(`<li class="multiSelect_option" data-value="` + jQuery(
                            this).val() + `">
                                                    <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                                </li>`);
                    });

                    var dropdown2 = self2.find('.multiSelect_dropdown');
                    var list2 = self2.find('.multi2');
                    var option2 = self2.find('.multiSelect_option');
                    var optionText2 = self2.find('.multiSelect_text');

                    dropdown2.attr('data-multiple', 'true');
                    list2.css('top', dropdown2.height() + 5);

                    option2.click(function(e) {
                        var self2 = jQuery(this);
                        e.stopPropagation();
                        self2.addClass('-selected');
                        field2.find('option:contains(' + self2.children().text() + ')').prop('selected',
                            true);
                        dropdown2.append(function(e) {
                            return jQuery('<span class="multiSelect_choice">' + self2.children()
                                .text() +
                                '<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>'
                                ).click(function(e) {
                                var self2 = jQuery(this);
                                e.stopPropagation();
                                self2.remove();
                                list2.find('.multiSelect_option:contains(' + self2
                                .text() + ')').removeClass('-selected');
                                list2.css('top', dropdown2.height() + 5).find(
                                    '.multiSelect_noselections').remove();
                                field2.find('option:contains(' + self2.text() + ')')
                                    .prop('selected', false);
                                if (dropdown2.children(':visible').length === 0) {
                                    dropdown2.removeClass('-hasValue');
                                }
                            });
                        }).addClass('-hasValue');
                        list2.css('top', dropdown2.height() + 5);
                        if (!option2.not('.-selected').length) {
                            list2.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                        }
                    });

                    dropdown2.click(function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        dropdown2.toggleClass('-open');
                        list2.toggleClass('-open').scrollTop(0).css('top', dropdown2.height() + 5);
                    });

                    jQuery(document).on('click touch', function(e) {
                        if (dropdown2.hasClass('-open')) {
                            dropdown2.toggleClass('-open');
                            list2.removeClass('-open');
                        }
                    });
                });
            });
        </script>
        <script>
            window.onload = function() {
                changeInitial();
            };

            function loaded() { 
                document.getElementById("chooseTm").style.display = "none";
                document.getElementById("chooseRm").style.display = "none";
               
                
              
               
               
              
                document.getElementById("chooseWh").style.display = "none";
            };
            loaded();

            function change(event) {
                let getVal = event.target.value;

                if (getVal == "relationship") {
                    document.getElementById("chooseTm").style.display = "block"
                    document.getElementById("chooseTminput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                    document.getElementById("photoinput").setAttribute("required", "true");

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseRm").style.display = "none"
                }
                
                else if (getVal == "territory") {
                    document.getElementById("chooseRm").style.display = "none"
                    //document.getElementById("chooseRminput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                    document.getElementById("photoinput").setAttribute("required", "true");

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseTm").style.display = "none"
                } 
                else if (getVal == "runner") {
                    document.getElementById("chooseWh").style.display = "block"
                    document.getElementById("wareChooseinput").setAttribute("required", "true");

                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                    document.getElementById("password").style.display = "block";
                    document.getElementById("passwordinput").setAttribute("required", "true");

                    document.getElementById("photo").style.display = "block";
                    document.getElementById("photoinput").setAttribute("required", "true");

                    document.getElementById("note").style.display = "block";
                }
                else if (getVal == "admin" || getVal == "hr" || getVal == "backoffice" || getVal == "warehouse") {
                    document.getElementById("name").style.display = "block";
                    document.getElementById("nameinput").setAttribute("required", "true");

                    document.getElementById("emplId").style.display = "block";
                    document.getElementById("empidinput").setAttribute("required", "true");

                    document.getElementById("phone").style.display = "block";
                    document.getElementById("phoneinput").setAttribute("required", "true");

                    document.getElementById("workAdd").style.display = "block";
                    document.getElementById("workaddressinput").setAttribute("required", "true");

                    document.getElementById("homeAdd").style.display = "block";
                    document.getElementById("homeaddressinput").setAttribute("required", "true");

                    document.getElementById("addProof").style.display = "block";
                    document.getElementById("addressproofinput").setAttribute("required", "true");

                    document.getElementById("ageProof").style.display = "block";
                    document.getElementById("documentinput").setAttribute("required", "true");

                    document.getElementById("city").style.display = "block";
                    document.getElementById("cityinput").setAttribute("required", "true");

                    document.getElementById("email").style.display = "block";
                    document.getElementById("emailinput").setAttribute("required", "true");

                   
                   

                    document.getElementById("note").style.display = "block";
                    document.getElementById("chooseTm").style.display = "none";
                    document.getElementById("chooseRm").style.display = "none";
                    document.getElementById("chooseWh").style.display = "none";
                
                }
                else{}
            };

            function changeInitial() {
                // Call the change function on page load
                change({
                    target: document.getElementById('yourSelect')
                });
            }
        </script>
    @endif


    
<script>
    function previewImage(inputId, previewId) {
        var input = document.getElementById(inputId);
        var preview = document.getElementById(previewId);
        
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement("img");
                    img.className = "preview-image";
                    img.src = e.target.result;
                    preview.appendChild(img);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>

</body>

</html>
