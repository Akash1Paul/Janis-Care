<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/customers')}}">
                            <i class="fa fa-user"></i>Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/roles')}}">
                            <i class="fa fa-user"></i>Roles
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ url('backoffice/category') }}" class="nav-link dropdown-toggle arrow-none"
                            id="topnav-forms">
                            <i class="fa fa-folder"></i>Categories </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/products')}}">
                            <i class="fa fa-box"></i>Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/purchaseorders')}}">
                            <i class="fa fa-truck"></i>Purchase Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/orders')}}">
                            <i class="fas fa-lightbulb"></i>Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/vehicle')}}">
                            <i class="fas fa-bicycle"></i>Vehicles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('backoffice/correction')}}">
                            <i class="fas fa-bell"></i>Correction
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>  