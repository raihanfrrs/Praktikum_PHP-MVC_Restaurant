<?php Flasher::FlashMaster(); ?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2><?=$data['judul'];?></h2>
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
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?=$data['breadcrumb'];?>
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
      <div class="col-lg-6">
        <div class="card-style settings-card-1 mb-30">
          <div class="profile-info">
            <form action="<?=BASEURL?>/master/<?=$data['action']?><?php if(isset($data['customer']['customer_id'])) echo "/".$data['customer']['customer_id']; ?>" method="POST">
              <div class="input-style-1">
                <label for="fullname">Full Name</label>
                <div class="input-style-3">
                  <input 
                    type="text" 
                    placeholder="Full Name" 
                    id="fullname"
                    name="customer_nama"
                    required
                    value="<?php if(isset($data['customer']['customer_nama'])) echo $data['customer']['customer_nama'] ?>"
                    autocomplete="off" />
                  <span class="icon"><i class="lni lni-user"></i></span>
                </div>
              </div>
              <div class="input-style-1">
                <label for="address">Address</label>
                <div class="input-style-3">
                  <input 
                    type="text" 
                    placeholder="Address" 
                    id="address"
                    name="alamat"
                    required
                    value="<?php if(isset($data['customer']['alamat'])) echo $data['customer']['alamat'] ?>"
                    autocomplete="off" />
                  <span class="icon"><i class="lni lni-map-marker"></i></span>
                </div>
              </div>
              <div class="input-style-1">
                <label for="phone">Phone</label>
                <div class="input-style-3">
                  <input 
                    type="text" 
                    placeholder="Phone" 
                    id="phone"
                    name="ponsel"
                    required
                    value="<?php if(isset($data['customer']['ponsel'])) echo $data['customer']['ponsel'] ?>"
                    autocomplete="off" />
                  <span class="icon"><i class="lni lni-phone"></i></span>
                </div>
              </div>
              <div class="input-style-1">
                <label for="email">E-mail</label>
                <div class="input-style-3">
                  <input 
                    type="email" 
                    placeholder="E-mail" 
                    id="email"
                    name="email"
                    required
                    value="<?php if(isset($data['customer']['email'])) echo $data['customer']['email'] ?>"
                    autocomplete="off" />
                  <span class="icon"><i class="lni lni-postcard"></i></span>
                </div>
              </div>
                <input type="submit" class="main-btn secondary-btn rounded-md btn-sm btn-hover" name="submit">
            </form>
          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->

      <div class="col-lg-6 <?=$data['display']?>">
        <div class="card-style mb-30">
          <h6 class="mb-10">List Customer</h6>
          <div class="table-wrapper table-responsive">
            <table class="table striped-table" id="example">
              <thead>
                <tr>
                  <th><h6>No</h6></th>
                  <th><h6>Customer</h6></th>
                  <th><h6>Address</h6></th>
                  <th><h6>Phone</h6></th>
                  <th><h6>Email</h6></th>
                  <th><h6>Action</h6></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data['customer'] as $customer) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$customer['customer_nama']."</td>";
                    echo "<td>".$customer['alamat']."</td>";
                    echo "<td>".$customer['ponsel']."</td>";
                    echo "<td>".$customer['email']."</td>";
                    echo "<td><a href='".BASEURL."/master/editCustomer/".$customer['customer_id']."' class='text-warning'><span class='icon'><i class='lni lni-pencil-alt'></i></span></a> 
                              <a href='".BASEURL."/master/deleteCustomer/".$customer['customer_id']."' class='text-danger' id='btn-delete-customer'><span class='icon'><i class='lni lni-trash-can'></i></span></a></td>";
                    echo "</tr>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
            <!-- end table -->
          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>