<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">







    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


      <div class="app-brand demo ">
        <a href="{{ route('home') }}" class="menu-link ml-auto">
          <span class="app-brand-text demo menu-text fw-bold">Gym</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
          <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>



      <ul class="menu-inner py-1">
        <!-- Dashboards -->




        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Administration</span>
        </li>
        <li class="menu-item">
          <a href="{{ route('home') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-home"></i>
            <div data-i18n="Home">Home</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('members') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Members">Members</div>
          </a>
        </li>
        <li class="menu-item ">
          <a href="{{ route('classes') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-book"></i>
            <div data-i18n="Classes">Classes</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('memberships') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-star"></i>
            <div data-i18n="Memberships">Memberships</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('instructors') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-weight"></i>
            <div data-i18n="Instructors">Instructors</div>
          </a>
        </li>

      </ul>



    </aside>
    <!-- / Menu -->



    <!-- Layout container -->
    <div class="layout-page">





      <!-- Navbar -->

      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">


        <div class="demo-inline-spacing d-flex justify-content-end" style="margin-left: auto;">
          <a href="{{ route('login') }}" class="menu-link ml-auto">
            <button type="button" class="btn btn-primary">Log Out</button>
          </a>
        </div>








        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
          </a>
        </div>




        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper  d-none">
          <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search...">
          <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
        </div>



      </nav>