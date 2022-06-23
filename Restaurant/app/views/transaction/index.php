<?php Flasher::FlashTransaction(); ?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2>Transaction</h2>
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
                  Transaction
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
      <div class="col-lg-12">
        <div class="card-style settings-card-1 mb-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="profile-info">
                <form action="<?=BASEURL?>/transaction/addTransaction" method="POST">
                  <input type="hidden" name="action" value="proses">
                  <h6 class="mb-25">Customer</h6>
                  <div class="input-style-1">
                    <label for="fullname">Full Name</label>
                    <div class="input-style-3">
                      <input 
                        type="text" 
                        placeholder="Full Name" 
                        id="fullname"
                        name="customer_nama"
                        value="<?php $customer_nama = null; if(isset($_SESSION['shopping_cart'])){ foreach($_SESSION['shopping_cart'] as $customer) {$customer_nama = $customer['customer_nama'];} } echo $customer_nama;?>"
                        <?php if(isset($_SESSION['shopping_cart'])) echo "readonly"; ?>
                        required />
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
                        value="<?php $alamat = null; if(isset($_SESSION['shopping_cart'])){ foreach($_SESSION['shopping_cart'] as $customer) {$alamat = $customer['alamat'];} } echo $alamat;?>"
                        <?php if(isset($_SESSION['shopping_cart'])) echo "readonly"; ?>
                        required />
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
                        value="<?php $ponsel = null; if(isset($_SESSION['shopping_cart'])){ foreach($_SESSION['shopping_cart'] as $customer) {$ponsel = $customer['ponsel'];} } echo $ponsel;?>"
                        <?php if(isset($_SESSION['shopping_cart'])) echo "readonly"; ?>
                        required />
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
                        value="<?php $email = null; if(isset($_SESSION['shopping_cart'])){ foreach($_SESSION['shopping_cart'] as $customer) {$email = $customer['email'];} } echo $email;?>"
                        <?php if(isset($_SESSION['shopping_cart'])) echo "readonly"; ?>
                        required />
                      <span class="icon"><i class="lni lni-postcard"></i></span>
                    </div>
                  </div>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                  <div class="profile-info">
                      <h6 class="mb-25">Transaction</h6>
                      <div class="input-style-1">
                        <label for="product">Product</label>
                        <div class="select-style-2">
                        <div class="select-position">
                          <select name="produk_nama">
                            <?php
                            if (isset($_SESSION['shopping_cart'])) {
                              foreach ($data['produk'] as $product) {
                                echo "<option value='".$product['produk_nama']."'>".$product['produk_nama']."</option>";
                              }
                            }else{
                              foreach ($data as $product) {
                                echo "<option value='".$product['produk_nama']."'>".$product['produk_nama']."</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>
                  </div>
                      </div>
                      <div class="input-style-1">
                        <label for="quantity">Quantity</label>
                        <div class="input-style-3">
                          <input
                          type="number" 
                          id="quantity"
                          placeholder="Quantity"
                          name="qty"
                          min="1"
                          required
                          />
                          <span class="icon"><i class="lni lni-shopping-basket"></i></span>
                        </div>
                      </div>
                      <div class="input-style-1">
                        <label for="note">Note</label>
                        <div class="input-style-3">
                          <textarea placeholder="Note" id="note" rows="5" name="catatan"><?php $catatan = null; if(isset($_SESSION['shopping_cart'])){ foreach($_SESSION['shopping_cart'] as $customer) {$catatan = $customer['catatan'];} } echo $catatan;?></textarea>
                          <span class="icon"><i class="lni lni-write"></i></span>
                        </div>
                      </div>
                    <button class="main-btn secondary-btn rounded-md btn-sm btn-hover float-end" name="submit"><i class="lni lni-cart"></i> Cart</button>
                </form>
              </div>
            </div>
            <!-- end col -->
          <!-- end row -->
          <span class="divider"><hr /></span>
          <div class="row">
            <div class="col-lg-12">
              <h6 class="mb-10"><i class="lni lni-cart-full"></i> Cart</h6>
                  <p class="text-sm mb-20">
                    Add your entire shopping list to cart.
                  </p>
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th><h6>#</h6></th>
                          <th><h6>Product</h6></th>
                          <th><h6>Price</h6></th>
                          <th><h6>Qty</h6></th>
                          <th><h6>Item Total</h6></th>
                          <th><h6>Discount</h6></th>
                          <th><h6></h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                      <?php 
                        if(isset($_SESSION['shopping_cart'])){
                          $no = 1;
                          foreach ($_SESSION['shopping_cart'] as $product) {
                            $temp = $this->model('Transaction_model')->getDataTempCart($product['produk_id'], 'produk_id');
                            echo "<tr>";
                            echo "<td class='min-width'>
                                    <p>".$no++."</p>
                                  </td>";
                            echo "<td class='min-width'>
                                    <p>".$product['produk_nama']."</p>
                                  </td>";
                            echo "<td class='min-width'>
                                    <p>".Format::rupiah($product['harga'])."</p>
                                  </td>";
                            echo "<td class='min-width'>
                                    <form action='".BASEURL."/Transaction/ChangeQty' method='POST'>
                                    <input type='hidden' name='produk_id' value='".$product['produk_id']."'>
                                    <input type='hidden' name='pegawai_id' value='".$product['pegawai_id']."'>
                                    <p>
                                      <input type='number' name='qty' min='1' value='".$temp['qty']."' onchange='this.form.submit()'' style='width: 3rem;border: 0px;'>
                                    </p>
                                    </form>
                                  </td>";
                            echo "<td class='min-width'>
                                    <p>".Format::rupiah($product['harga']*$temp['qty'])."</p>
                                  </td>";
                            echo "<td class='min-width'>
                                    <div class='action'>
                                    ";
                                      if($product['potongan'] == '0') {
                            echo      "<button type='button' class='text-info' data-bs-toggle='modal' data-bs-target='#b".$product['produk_id']."'>
                                        <i class='lni lni-circle-plus'></i>
                                      </button>";
                                      }else{
                            echo         "<p class='text-danger'>- ".Format::rupiah($product['potongan'])."</p>";
                                      }
                            echo    "</div>
                                  </td>";
                            echo "<div id='b".$product['produk_id']."' class='modal fade' role='dialog'>
                                    <div class='modal-dialog modal-dialog-centered modal-sm'>
                                      <div class='modal-content'>

                                      <form action='".BASEURL."/Transaction/AddDiscount' method='POST'>
                                        <div class='modal-body'>
                                          <div class='input-style-3 mb-0'>
                                            <input type='text' placeholder='Discount' name='potongan' id='harga' autocomplete='off'/>
                                            <input type='hidden' name='pegawai_id' value='".$product['pegawai_id']."'>
                                            <input type='hidden' name='customer_nama' value='".$product['customer_nama']."'>
                                            <input type='hidden' name='alamat' value='".$product['alamat']."'>
                                            <input type='hidden' name='ponsel' value='".$product['ponsel']."'>
                                            <input type='hidden' name='email' value='".$product['email']."'>
                                            <input type='hidden' name='produk_id' value='".$product['produk_id']."'>
                                            <input type='hidden' name='produk_nama' value='".$product['produk_nama']."'>
                                            <input type='hidden' name='harga' value='".$product['harga']."'>
                                            <input type='hidden' name='qty' value='".$product['qty']."'>
                                            <input type='hidden' name='tanggal' value='".$product['tanggal']."'>
                                            <input type='hidden' name='catatan' value='".$product['catatan']."'>
                                            <span class='icon'><i class='lni lni-cut'></i></span>
                                          </div>
                                        </div>

                                        <div class='modal-footer'>
                                          <button type='submit' class='btn btn-success' name='submit'>Submit</button>
                                          <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                                        </div>
                                      </form>
                                      </div>
                                    </div>
                                  </div>";
                            echo "<td>
                                    <form action='".BASEURL."/Transaction/DeleteProduct' method='POST'>
                                    <input type='hidden' name='produk_id' value='".$product['produk_id']."'>
                                    <input type='hidden' name='pegawai_id' value='".$product['pegawai_id']."'>
                                    <div class='action'>
                                      <button type='submit' class='text-danger'>
                                        <i class='lni lni-trash-can'></i>
                                      </button>
                                    </div>
                                    </form>
                                  </td>";
                            echo "</tr>";
                          }

                            echo "<tr>";
                            echo "<td colspan='3'></td>";
                            echo "<td><b>Subtotal</b></td>";
                            echo "<td><b>".Format::rupiah($data['subtotal'])."</b></td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td colspan='3'></td>";
                            echo "<td><b>Discount</b></td>";
                            echo "<td class='text-danger'><b>- ".Format::rupiah($data['discount'])."</b></td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td colspan='3'></td>";
                            echo "<td><b>Grand Total</b></td>";
                            echo "<td class='text-success'><b>".Format::rupiah($data['grand_total'])."</b></td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td colspan='5'></td>";
                            echo "<td>
                                  <form action='".BASEURL."/Transaction/Checkout' method='POST'>
                                  ";
                                  foreach ($_SESSION['shopping_cart'] as $cart) 
                            echo  "<input type='hidden' name='customer_nama' value='".$cart['customer_nama']."'>";
                            echo  "<input type='hidden' name='alamat' value='".$cart['alamat']."'>";
                            echo  "<input type='hidden' name='ponsel' value='".$cart['ponsel']."'>";
                            echo  "<input type='hidden' name='email' value='".$cart['email']."'>";
                            echo  "<input type='hidden' name='pegawai_id' value='".$cart['pegawai_id']."'>";
                            echo  "<input type='hidden' name='catatan' value='".$cart['catatan']."'>";
                            echo  "<input type='hidden' name='grand_total' value='".$data['grand_total']."'>";
                                  foreach ($_SESSION['shopping_cart'] as $cart) {
                            echo  "<input type='hidden' name='produk_id[]' value='".$cart['produk_id']."'>";
                            echo  "<input type='hidden' name='qty[]' value='".$cart['qty']."'>";
                            echo  "<input type='hidden' name='subtotal[]' value='".$cart['harga']*$cart['qty']."'>";
                            echo  "<input type='hidden' name='potongan[]' value='".$cart['potongan']."'>";
                                  }
                            echo  "<button type='submit' class='main-btn secondary-btn rounded-md btn-sm btn-hover'><i class='lni lni-credit-cards'></i> Checkout</button>";
                            echo  "</form>
                                  </td>";
                            echo  "<td>
                                  <form action='".BASEURL."/Transaction/Reset' method='POST'>
                                  ";
                                  foreach ($_SESSION['shopping_cart'] as $cart) {
                            echo  "<input type='hidden' name='produk_id[]' value='".$cart['produk_id']."'>";
                            echo  "<input type='hidden' name='pegawai_id' value='".$cart['pegawai_id']."'>";
                                  }
                            echo  "<button type='submit' class='main-btn danger-btn rounded-md btn-sm btn-hover'><i class='lni lni-ban'></i> Reset</button>";
                            echo  "</form>
                                  </td>";
                            echo  "</tr>";
                        }
                      ?>
                      <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                  </div>
            </div>
          </div>
            <!-- end col -->
          <!-- end row -->
          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->
    <!-- end row -->
  </div>
  <!-- end container -->
</section>