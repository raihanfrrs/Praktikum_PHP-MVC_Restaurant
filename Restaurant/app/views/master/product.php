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
            <form action="<?=BASEURL?>/master/<?=$data['action']?><?php if(isset($data['produk']['produk_id'])) echo "/".$data['produk']['produk_id']; ?>" method="POST">
              <div class="input-style-1">
                <label for="product">Product</label>
                <div class="input-style-3">
                  <input
                  type="text" 
                  id="product"
                  placeholder="Name Product"
                  name="produk_nama"
                  required
                  autocomplete="off"
                  value="<?php if(isset($data['produk']['produk_nama'])) echo $data['produk']['produk_nama']; ?>"
                  />
                  <span class="icon"><i class="lni lni-juice"></i></span>
                </div>
              </div>
              <div class="input-style-1">
                <label for="harga">Price</label>
                <div class="input-style-3">
                  <input
                  type="text" 
                  id="harga"
                  placeholder="Price"
                  name="harga"
                  required
                  autocomplete="off"
                  value="<?php if(isset($data['produk']['harga'])) echo Format::rupiah($data['produk']['harga']); ?>"
                    />
                  <span class="icon"><i class="lni lni-credit-cards"></i></span>
                </div>
              </div>
              <div class="input-style-1">
                <label>Description</label>
                <div class="input-style-3">
                  <textarea placeholder="Description" rows="5" name="deskripsi"><?php if(isset($data['produk']['deskripsi'])) echo $data['produk']['deskripsi']; ?></textarea>
                  <span class="icon"><i class="lni lni-write"></i></span>
                </div>
              </div>

              <div class="select-style-1">
                <label>Category</label>
                <div class="select-position">
                  <select name="kategori" required>
                    <?php
                    if($data['type'] == 'editProduct'){
                      echo "<option value='".$data['produk']['jenis_id']."' selected='selected'>".$data['produk']['jenis_nama']."</option>";
                      foreach ($data['kategori'] as $category) {
                        echo "<option value='".$category['jenis_id']."'>".$category['jenis_nama']."</option>";
                      }
                    }else if($data['action'] == 'addProduct'){
                      foreach ($data['category'] as $category) {
                        echo "<option value='".$category['jenis_id']."' selected='selected'>".$category['jenis_nama']."</option>";
                      }
                    }
                    ?>
                  </select>
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
          <h6 class="mb-10">List Product</h6>
          <div class="table-wrapper table-responsive">
            <table class="table striped-table" id="example">
              <thead>
                <tr>
                  <th><h6>No</h6></th>
                  <th><h6>Product</h6></th>
                  <th><h6>Price</h6></th>
                  <th><h6>Category</h6></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data['product'] as $product) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".ucwords($product['produk_nama'])."</td>";
                    echo "<td>".Format::rupiah($product['harga'])."</td>";
                    echo "<td>".ucwords($product['jenis_nama'])."</td>";
                    echo "<td><a href='".BASEURL."/master/editProduct/".$product['produk_id']."' class='text-warning'><span class='icon'><i class='lni lni-pencil-alt'></i></span></a> 
                              <a href='".BASEURL."/master/deleteProduct/".$product['produk_id']."' class='text-danger' id='btn-delete-product'><span class='icon'><i class='lni lni-trash-can'></i></span></a></td>";
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