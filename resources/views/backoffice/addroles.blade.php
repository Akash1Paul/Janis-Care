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
                                    <h4 class="mb-0 font-size-13"> <a href="{{url('backoffice/roles')}}">Roles</a> > Add Role</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Role</h4>
                                        <form action="{{url('backoffice/addroles') }}" method="POST" enctype="multipart/form-data">
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
                                                            {{-- <option value="backoffice">Back Office</option> --}}
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

                                                {{-- <div class="col-md-4" id="chooseWh" style="display: none">

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
                                                        <label for="name">Upload Address Proof Document <span
                                                                style="color: red">*</span></label>
                                                        <input type="file" name="addressproof"
                                                            class="form-control" id="addressproofinput" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="ageProof">
                                                    <div class="form-group">
                                                        <label for="name">Upload Age Proof Document <span
                                                                style="color: red">*</span></label>
                                                        <input type="file" name="document" class="form-control" id="documentinput">
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
                                                            <option value="Aurangabad">Aurangabad</option>
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
                                                   <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                               </div>
                                               <div class="btns d-inline-block">
                                                   <a href="{{url('backoffice/roles')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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

                        
                    </div>  <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
@include('backoffice.footer')
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
        jQuery('.multiSelect_list').append(`<li class="multiSelect_option" data-value="`+jQuery(this).val()+`">
                                                <a class="multiSelect_text">`+jQuery(this).text()+`</a>
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
            field.find('option:contains(' + self.children().text() + ')').prop('selected', true);
            dropdown.append(function(e) {
            return jQuery('<span class="multiSelect_choice">'+ self.children().text() +'<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>').click(function(e) {
            var self = jQuery(this);
            e.stopPropagation();
            self.remove();
            list.find('.multiSelect_option:contains(' + self.text() + ')').removeClass('-selected');
            list.css('top', dropdown.height() + 5).find('.multiSelect_noselections').remove();
            field.find('option:contains(' + self.text() + ')').prop('selected', false);
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
        jQuery('.multi2').append(`<li class="multiSelect_option" data-value="`+jQuery(this).val()+`">
                                                <a class="multiSelect_text">`+jQuery(this).text()+`</a>
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
            field2.find('option:contains(' + self2.children().text() + ')').prop('selected', true);
            dropdown2.append(function(e) {
            return jQuery('<span class="multiSelect_choice">'+ self2.children().text() +'<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>').click(function(e) {
            var self2 = jQuery(this);
            e.stopPropagation();
            self2.remove();
            list2.find('.multiSelect_option:contains(' + self2.text() + ')').removeClass('-selected');
            list2.css('top', dropdown2.height() + 5).find('.multiSelect_noselections').remove();
            field2.find('option:contains(' + self2.text() + ')').prop('selected', false);
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
    function loaded(){
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
    
    function change(event){
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
                
                }
                else{}

    };
</script>