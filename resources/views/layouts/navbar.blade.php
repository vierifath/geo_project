<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Topbar Search -->
        <h5 class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 align-center"> Tugas Akhir Geofisika </h5>
    
        <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600">Login</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <form action="/login" method="post">
                @csrf
                    <div class="form-group">
                        <input name="nip" type="text" class="form-control form-control-user" placeholder="Username" style="margin-bottom: 5px">
                        <input name="password" type="password" class="form-control form-control-user" placeholder="Password" style="margin-bottom: 5px">
                        <button class="btn btn-primary btn-user btn-block">Login</button>
                    </div>
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->