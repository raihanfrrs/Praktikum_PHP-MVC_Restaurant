<?php Flasher::FlashTransaction();
foreach ($data['data'] as $invoice)
?>
<section>
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Invoice</h2>
            <a href="<?=BASEURL?>/transaction" class="main-btn primary-btn btn-hover btn-sm">
              <i class="lni lni-plus mr-5"></i> New Invoice</a
            >
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#0">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Invoice
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

    <!-- Invoice Wrapper Start -->
    <div class="invoice-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="invoice-card card-style mb-30">
            <div class="invoice-header">
              <div class="invoice-for">
                <h2 class="mb-10">Invoice</h2>
              </div>
              <div class="invoice-logo">
                <img src="assets/images/invoice/uideck-logo.svg" alt="" />
              </div>
              <div class="invoice-date">
                <p><span>Date Order:</span> <?=date('Y/m/d', strtotime($invoice['tgl_transaksi']))?></p>
                <p><span>Time Order:</span> <?=date('H:i:s', strtotime($invoice['tgl_transaksi']))?></p>
                <p><span>Order ID:</span> #<?=$invoice['transaksi_id']?></p>
                <p><span>Cashier:</span> <?=Format::currentText($invoice['pegawai_nama'], 0);?></p>
              </div>
            </div>
            <div class="invoice-address">
              <div class="address-item">
                <h5 class="text-bold">To</h5>
                <h1><?=$invoice['customer_nama']?></h1>
                <p class="text-sm">
                  <?=$invoice['customer_alamat']?>
                </p>
                <p class="text-sm">
                  <span class="text-medium">Email:</span>
                  <?=$invoice['customer_email']?>
                </p>
              </div>
            </div>
            <div class="table-responsive">
              <table class="invoice-table table">
                <thead>
                  <tr>
                    <th class="service">
                      <h6 class="text-sm text-medium">Product</h6>
                    </th>
                    <th class="desc">
                      <h6 class="text-sm text-medium">Amount</h6>
                    </th>
                    <th class="qty">
                      <h6 class="text-sm text-medium">Price</h6>
                    </th>
                    <th class="amount">
                      <h6 class="text-sm text-medium">Subtotal</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $total = null;
                      $discount = null;
                      foreach ($data['data'] as $product) {
                        echo "<tr>";
                        echo "<td><p class='text-sm'>".$product['produk_nama']."</p></td>";
                        echo "<td><p class='text-sm'>".$product['total_qty']."</p></td>";
                        echo "<td><p class='text-sm'>".Format::rupiah($product['harga'])."</p></td>";
                        echo "<td><p class='text-sm'>".Format::rupiah($product['subtotal'])."</p></td>";
                        echo "</tr>";
                        $total += $product['subtotal'];
                        $discount += $product['potongan'];
                      }
                    ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <h6 class="text-sm text-medium">Total</h6>
                    </td>
                    <td>
                      <h6 class="text-sm text-bold"><?=Format::rupiah($total)?></h6>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <h6 class="text-sm text-medium">Discount</h6>
                    </td>
                    <td>
                      <h6 class="text-sm text-bold"><?=Format::rupiah($discount)?></h6>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <h4>Grand Total</h4>
                    </td>
                    <td>
                      <h4><?=Format::rupiah($product['grand_total'])?></h4>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--
            <div class="note-wrapper warning-alert py-4 px-sm-3 px-lg-5">
              <div class="alert">
                <h5 class="text-bold mb-15">Notes:</h5>
                <p class="text-sm text-gray">
                  All accounts are to be paid within 7 days from receipt
                  of invoice. To be paid by cheque or credit card or
                  direct payment online. If account is not paid within 7
                  days the credits details supplied as confirmation of
                  work undertaken will be charged the agreed quoted fee
                  noted above.
                </p>
              </div>
            </div>       
            <div class="invoice-action">
              <ul
                class="
                  d-flex
                  flex-wrap
                  align-items-center
                  justify-content-center
                "
              >
                <li class="m-2">
                  <a
                    href=""
                    class="main-btn primary-btn-outline btn-hover"
                  >
                    Download Invoice
                  </a>
                </li>
                <li class="m-2">
                  <a href="#0" class="main-btn primary-btn btn-hover">
                    Send Invoice
                  </a>
                </li>
              </ul>
            </div>
            -->
          </div>
          <!-- End Card -->
        </div>
        <!-- ENd Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- Invoice Wrapper End -->
  </div>
  <!-- end container -->
</section>