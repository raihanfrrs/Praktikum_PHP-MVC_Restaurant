<?php 
  $temp = explode('/', $_GET['url']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="<?=BASEURL;?>/images/favicon.svg"
      type="image/x-icon"
    />
    <title><?=$data['title'];?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?=BASEURL;?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/css/lineicons.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/css/main.css" />
    <link rel="stylesheet" href="<?=BASEURL;?>/plugins/sweetalert2/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?=BASEURL;?>/plugins/datatables/css/dataTables.bootstrap5.min.css">
    <script src="<?=BASEURL;?>/plugins/sweetalert2/js/sweetalert2.min.js"></script>
  </head>
  <body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper 
      <?php if(isset($data['display'])){ echo $data['display'];} ?>
      ">
      <div class="navbar-logo">
        <a href="<?=BASEURL?>/Dashboard">
          <b>RESTAURANT</b>
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="<?php $tmp = Parses::getUrlForNav('Dashboard', $temp[0], '', ''); echo $tmp['a-class']; ?>"
              data-bs-toggle="<?php $tmp = Parses::getUrlForNav('Dashboard', $temp[0], '', ''); echo $tmp['a-toggle']; ?>"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                  <path
                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                  />
                </svg>
              </span>
              <span class="text">Dashboard</span>
            </a>
            <ul id="ddmenu_1" class="collapse <?php $tmp = Parses::getUrlForNav('Dashboard', $temp[0], '', ''); echo $tmp['a-nav']; ?> dropdown-nav">
              <li>
                <a href="<?=BASEURL?>/Dashboard" class="<?php $tmp = Parses::getUrlForNav('Dashboard', $temp[0], '', ''); echo $tmp['a-active']; ?>"> Restaurant </a>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="<?php $tmp = Parses::getUrlForNav('master', $temp[0], '', ''); echo $tmp['a-class']; ?>"
              data-bs-toggle="<?php $tmp = Parses::getUrlForNav('master', $temp[0], '', ''); echo $tmp['a-toggle']; ?>"
              data-bs-target="#ddmenu_2"
              aria-controls="ddmenu_2"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M13.75 4.58325H16.5L15.125 6.41659L13.75 4.58325ZM4.58333 1.83325H17.4167C18.4342 1.83325 19.25 2.65825 19.25 3.66659V18.3333C19.25 19.3508 18.4342 20.1666 17.4167 20.1666H4.58333C3.575 20.1666 2.75 19.3508 2.75 18.3333V3.66659C2.75 2.65825 3.575 1.83325 4.58333 1.83325ZM4.58333 3.66659V7.33325H17.4167V3.66659H4.58333ZM4.58333 18.3333H17.4167V9.16659H4.58333V18.3333ZM6.41667 10.9999H15.5833V12.8333H6.41667V10.9999ZM6.41667 14.6666H15.5833V16.4999H6.41667V14.6666Z"
                  />
                </svg>
              </span>
              <span class="text">Master</span>
            </a>
            <ul id="ddmenu_2" class="collapse <?php $tmp = Parses::getUrlForNav('master', $temp[0], '', ''); echo $tmp['a-nav']; ?> dropdown-nav">
              <li>
                <a href="<?=BASEURL?>/master/product" class="<?php if(isset($temp[0]) && isset($temp[1])){ $tmp = Parses::getUrlForNav('master', $temp[0], 'product', $temp[1]); echo $tmp['a-active'];} ?>"> Product </a>
              </li>
              <li>
                <a href="<?=BASEURL?>/master/category" class="<?php if(isset($temp[0]) && isset($temp[1])) $tmp = Parses::getUrlForNav('master', $temp[0], 'category', $temp[1]); echo $tmp['a-active']; ?>"> Category </a>
              </li>
              <li>
                <a href="<?=BASEURL?>/master/customer" class="<?php if(isset($temp[0]) && isset($temp[1])) $tmp = Parses::getUrlForNav('master', $temp[0], 'customer', $temp[1]); echo $tmp['a-active']; ?>"> Customer </a>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_3"
              aria-controls="ddmenu_3"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12.8334 1.83325H5.50008C5.01385 1.83325 4.54754 2.02641 4.20372 2.37022C3.8599 2.71404 3.66675 3.18036 3.66675 3.66659V18.3333C3.66675 18.8195 3.8599 19.2858 4.20372 19.6296C4.54754 19.9734 5.01385 20.1666 5.50008 20.1666H16.5001C16.9863 20.1666 17.4526 19.9734 17.7964 19.6296C18.1403 19.2858 18.3334 18.8195 18.3334 18.3333V7.33325L12.8334 1.83325ZM16.5001 18.3333H5.50008V3.66659H11.9167V8.24992H16.5001V18.3333Z"
                  />
                </svg>
              </span>
              <span class="text">Report</span>
            </a>
            <ul id="ddmenu_3" class="collapse dropdown-nav">
              <li>
                <a href="<?=BASEURL?>/Reporting/Sales"> Sales </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php $tmp = Parses::getUrlForNav('transaction', $temp[0], '', ''); echo $tmp['a-active']; ?>">
            <a href="<?=BASEURL?>/transaction">
              <span class="icon"><i class="lni lni-cart-full"></i></span>
              <span class="text">Transaction</span>
            </a>
          </li>
          <span class="divider"><hr /></span>
        </ul>
      </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header <?php if(isset($data['display'])){ echo $data['display'];} ?>
      ">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-20">
                  <button
                    id="menu-toggle"
                    class="main-btn primary-btn btn-hover"
                  >
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button
                    class="dropdown-toggle bg-transparent border-0"
                    type="button"
                    id="profile"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <div class="profile-info">
                      <div class="info">
                        <h6><?=ucwords($_SESSION['user']['username']);?></h6>
                        <div class="image">
                          <img
                            src="<?=BASEURL;?>/images/profile/profile-2.png"
                            alt=""
                          />
                          <span class="status"></span>
                        </div>
                      </div>
                    </div>
                    <i class="lni lni-chevron-down"></i>
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="profile"
                  >
                    <li>
                      <a href="<?=BASEURL?>/Settings"> <i class="lni lni-cog"></i> Settings </a>
                    </li>
                    <li>
                      <a href="<?=BASEURL?>/Signout"> <i class="lni lni-exit"></i> Sign Out </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>