<?php Flasher::FlashSettings(); ?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2>Settings</h2>
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
                  Settings
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
          <div
            class="
              title
              mb-30
              d-flex
              justify-content-between
              align-items-center
            "
          >
            <h6>My Profile</h6>
          </div>
          <div class="profile-info">
            <form action="<?=BASEURL?>/Settings/EditProfile" method="POST">
            <div class="input-style-1">
              <label>Username</label>
              <input 
              type="text" 
              placeholder="Username"
              name="username" 
              value="<?=$data['username']?>"
              required 
              />
            </div>
            <div class="input-style-1">
              <label>Full Name</label>
              <input
                type="text"
                placeholder="Full Name"
                name="pegawai_nama"
                value="<?=$data['pegawai_nama']?>"
                required
              />
            </div>
            <div class="input-style-1">
              <label>Email</label>
              <input
                type="email"
                placeholder="Email"
                name="email"
                value="<?=$data['email']?>"
                required
              />
            </div>
            <div class="input-style-1">
              <label>Phone</label>
              <input
                type="text"
                placeholder="Phone"
                name="ponsel"
                value="<?=$data['ponsel']?>"
                required
              />
            </div>
            <div class="input-style-1">
              <label>Address</label>
              <textarea placeholder="Address" rows="4" name='alamat'><?=$data['alamat']?></textarea>
            </div>
            <div class="col-12">
              <button class="main-btn primary-btn btn-hover">
                Update Profile
              </button>
            </div>
          </form>
          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->

      <div class="col-lg-6">
        <div class="card-style settings-card-2 mb-30">
          <div class="title mb-30">
            <h6>My Password</h6>
          </div>
          <form action="<?=BASEURL?>/Settings/EditPassword" method="POST">
            <div class="row">
              <div class="col-12">
                <div class="input-style-1">
                  <label>New Password</label>
                  <input type="password" name="password" placeholder="New Password" required />
                </div>
              </div>
              <div class="col-12">
                <button class="main-btn primary-btn btn-hover">
                  Update Password
                </button>
              </div>
            </div>
          </form>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>