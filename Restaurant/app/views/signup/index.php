<?php 
  Flasher::flashSignup();
?>
<section class="signin-section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title mb-30">
            <h2>Sign up</h2>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="row g-0 auth-row">
      <div class="col-lg-6">
        <div class="auth-cover-wrapper bg-primary-100">
          <div class="auth-cover">
            <div class="title text-center">
              <h1 class="text-primary mb-10">RESTAURANT</h1>
              <p class="text-medium">
                Start creating account to serve
                <br class="d-sm-block" />
                your customers.
              </p>
            </div>
            <div class="cover-image">
              <img src="<?=BASEURL;?>/images/auth/signin-image.svg" alt="" />
            </div>
            <div class="shape-image">
              <img src="<?=BASEURL?>/images/auth/shape.svg" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end col -->
      <div class="col-lg-6">
        <div class="signup-wrapper">
          <div class="form-wrapper">
            <h6 class="mb-15">Sign Up Form</h6>
            <p class="text-sm mb-25">
              Start a new experience in managing a restaurant.
            </p>
            <form action="<?=BASEURL?>/Signup/SignupProcess" method="POST">
              <div class="row">
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username" required />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" required />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Phone</label>
                    <input type="text" name="ponsel" placeholder="Phone" required />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                  <div
                    class="
                      button-group
                      d-flex
                      justify-content-center
                      flex-wrap
                    "
                  >
                    <button
                      class="
                        main-btn
                        primary-btn
                        btn-hover
                        w-100
                        text-center
                      "
                    >
                      Sign Up
                    </button>
                  </div>
                </div>
              </div>
              <!-- end row -->
            </form>
          </div>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
</section>