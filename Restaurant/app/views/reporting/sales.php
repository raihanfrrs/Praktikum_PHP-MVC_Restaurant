<!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Sales Reporting</h2>
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
                      <li class="breadcrumb-item">
                        <a href="#">Report</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Sales
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
              <div class="card-style mb-30">
                <div
                  class="
                    title
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                  "
                >
                  <div class="left">
                    <h6 class="text-medium mb-30">Sales History</h6>
                  </div>
                </div>
                <!-- End Title -->
                <div class="table-responsive">
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th>
                          <h6 class="text-sm text-medium">Code</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Customer</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Date</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Cashier</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Amount</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Total Transaction</h6>
                        </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach ($data as $sales) {
                          echo "<tr>";
                          echo "<td><p class='text-sm'>#".$sales['transaksi_id']."</p></td>";
                          echo "<td><p class='text-sm'>".$sales['customer_nama']."</p></td>";
                          echo "<td><p class='text-sm'>".date("Y/m/d", strtotime($sales['tgl_transaksi']))."</p></td>";
                          echo "<td><p class='text-sm'>".$sales['pegawai_nama']."</p></td>";
                          echo "<td><p class='text-sm'>".$sales['amount']."</p></td>";
                          echo "<td><p class='text-sm'>".Format::rupiah($sales['grand_total'])."</p></td>";
                          echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                  <!-- End Table -->
                </div>
              </div>
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->