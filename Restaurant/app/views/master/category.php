<?php Flasher::FlashMaster(); ?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2><?=$data['judul']?></h2>
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
            <?php 
            if($data['action'] == 'addCategory'){
              echo "<form action='".BASEURL."/master/".$data['action']."' method='POST'>";
            }else if($data['action'] == 'processEditCategory'){
              echo "<form action='".BASEURL."/master/".$data['action']."/".$data['data']['jenis_id']."' method='POST'>";
            }
            ?>
              <div class="input-style-1">
                <label for="category">Category</label>
                <div class="input-style-3">
                  <input
                  type="text" 
                  id="category"
                  placeholder="Insert Category"
                  name="kategori"
                  required
                  autocomplete="off"
                  value="<?php if(isset($data['data'])) echo $data['data']['jenis_nama'];?>"
                  />
                  <span class="icon"><i class="lni lni-list"></i></span>
                </div>
              </div>
              <input type="submit" class="main-btn secondary-btn rounded-md btn-sm btn-hover" name="submit">
            </form>
          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->

      <div class="col-lg-6 <?=$data['display'];?>">
        <div class="card-style mb-30">
          <h6 class="mb-10">List Category</h6>
          <div class="table-wrapper table-responsive">
            <table class="table striped-table" id="example">
              <thead>
                <tr>
                  <th><h6>No</h6></th>
                  <th><h6>Category</h6></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  foreach ($data['category'] as $category) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".ucwords($category['jenis_nama'])."</td>";
                    echo "<td><a href='".BASEURL."/master/editCategory/".$category['jenis_id']."' class='text-warning'><span class='icon'><i class='lni lni-pencil-alt'></i></span></a> 
                              <a href='".BASEURL."/master/deleteCategory/".$category['jenis_id']."' class='text-danger' id='btn-delete-category'><span class='icon'><i class='lni lni-trash-can'></i></span></a></td>";
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
    <!-- end row -->
  </div>
  <!-- end container -->
</section>