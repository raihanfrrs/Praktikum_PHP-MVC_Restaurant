<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="alert-list-wrapper">
          <?php Flasher::FlashDashboard(); ?>
        </div>
        <div class="col-md-6">
          <div class="title mb-30">
            <h2>Dashboard</h2>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?=BASEURL?>/Dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Restaurant
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon purple">
            <i class="lni lni-cart-full"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">New Orders</h6>
            <h3 class="text-bold mb-10"><?=$data['totalOrder']?></h3>
          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon success">
            <i class="lni lni-dollar"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total Income</h6>
            <h3 class="text-bold mb-10"><?=Format::rupiah($data['totalIncome'])?></h3>
          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon primary">
            <i class="lni lni-package"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total Product</h6>
            <h3 class="text-bold mb-10"><?=$data['totalProduct']?></h3>
          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon orange">
            <i class="lni lni-user"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total User</h6>
            <h3 class="text-bold mb-10"><?=$data['totalCashier']?></h3>
          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <!-- end container -->
</section>