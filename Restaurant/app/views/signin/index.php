<?php 
  Flasher::flashSignin();
?>
<!-- ========== signin-section start ========== -->
<section class="signin-section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title mb-30">
            <h2>Sign in</h2>
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
                Sign in to your Existing account to continue
              </p>
            </div>
            <div class="cover-image">
              <img src="<?=BASEURL?>/images/auth/signin-image.svg" alt="" />
            </div>
            <div class="shape-image">
              <img src="<?=BASEURL?>/images/auth/shape.svg" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end col -->
      <div class="col-lg-6">
        <div class="signin-wrapper">
          <div class="form-wrapper">
            <h6 class="mb-15">Sign In Form</h6>
            <p class="text-sm mb-25">
              Start a new experience in managing a restaurant.
            </p>
            <form action="<?=BASEURL;?>/Signin/SigninProcess" method="POST">
              <div class="row">
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Username / Email / Phone</label>
                    <input type="text" name="username" placeholder="Username / Email / Phone" />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" />
                  </div>
                </div>
                <!-- end col -->
                <div class="col-xxl-6 col-lg-12 col-md-6">
                  <div class="form-check checkbox-style mb-30">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="checkbox-remember"
                      name="remember"
                    />
                    <label
                      class="form-check-label"
                      for="checkbox-remember"
                    >
                      Remember me next time</label
                    >
                  </div>
                </div>
                <!-- end col -->
                <div class="col-xxl-6 col-lg-12 col-md-6">
                  <div
                    class="
                      text-start text-md-end text-lg-start text-xxl-end
                      mb-30
                    "
                  >
                    <a href="<?=BASEURL;?>/Signup" class="hover-underline"
                      >Create Account?</a
                    >
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
                      Sign In
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
<!-- ========== signin-section end ========== -->