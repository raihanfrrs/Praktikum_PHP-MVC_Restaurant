<?php 

class Flasher{

	public static function setFlash($pesan, $aksi, $tipe, $data){
		$_SESSION['flash'] = [
			'pesan' => $pesan,
			'aksi' => $aksi,
			'tipe' => $tipe,
			'data' => $data
		];
	}

	public static function flashSignin(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'error'){
				echo '
					<script type="text/javascript">
						Swal.fire({
						  icon: "'.$_SESSION['flash']['tipe'].'",
						  title: "'.$_SESSION['flash']['aksi'].'",
						  text: "'.$_SESSION['flash']['pesan'].'",
						  showConfirmButton: false,
  						  timer: 2000
						})
					</script>
				';

				unset($_SESSION['flash']);
			}else if(isset($_SESSION['flash'])){
				if($_SESSION['flash']['tipe'] == 'success'){
					echo '
						<script type="text/javascript">
							Swal.fire({
							  icon: "'.$_SESSION['flash']['tipe'].'",
							  title: "'.$_SESSION['flash']['aksi'].'",
							  text: "'.$_SESSION['flash']['pesan'].'",
							  showConfirmButton: false,
	  						  timer: 2000
							})
						</script>
					';

					unset($_SESSION['flash']);
				}
			}
		}
	}

	public function FlashSignup(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'error'){
				echo '
					<script type="text/javascript">
						Swal.fire({
						  icon: "'.$_SESSION['flash']['tipe'].'",
						  title: "'.$_SESSION['flash']['aksi'].'",
						  text: "'.$_SESSION['flash']['pesan'].'",
						  showConfirmButton: false,
  						  timer: 2000
						})
					</script>
				';

				unset($_SESSION['flash']);
			}
		}
	}

	public function FlashDashboard(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'success'){
				echo '
					<div class="alert alert-box primary-alert alert-dismissible fade show p-0">
			            <div class="alert">
			              <h4 class="alert-heading">'.$_SESSION['flash']['aksi'].' '.ucwords($_SESSION['flash']['data']).'</h4>
			              <p class="text-medium">
			                '.$_SESSION['flash']['pesan'].'
			              </p>
			              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </div>
		          	</div>
				';

				unset($_SESSION['flash']);
			}
		}
	}

	public function FlashMaster(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'success'){
					echo '
						<script type="text/javascript">
							Swal.fire({
							  icon: "'.$_SESSION['flash']['tipe'].'",
							  title: "'.$_SESSION['flash']['aksi'].'",
							  text: "'.$_SESSION['flash']['pesan'].'",
							  showConfirmButton: false,
	  						  timer: 2000
							})
						</script>
					';

					unset($_SESSION['flash']);
			}else if($_SESSION['flash']['tipe'] == 'error'){
				echo '
					<script type="text/javascript">
						Swal.fire({
						  icon: "'.$_SESSION['flash']['tipe'].'",
						  title: "'.$_SESSION['flash']['aksi'].'",
						  text: "'.$_SESSION['flash']['pesan'].'",
						  showConfirmButton: false,
  						  timer: 2000
						})
					</script>
				';

				unset($_SESSION['flash']);
			}
		}
	}

	public function FlashTransaction(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'success'){
					echo '
						<script type="text/javascript">
							Swal.fire({
							  icon: "'.$_SESSION['flash']['tipe'].'",
							  title: "'.$_SESSION['flash']['aksi'].'",
							  text: "'.$_SESSION['flash']['pesan'].'",
							  showConfirmButton: false,
	  						  timer: 2000
							})
						</script>
					';

					unset($_SESSION['flash']);
			}else if($_SESSION['flash']['tipe'] == 'error'){
				echo '
					<script type="text/javascript">
						Swal.fire({
						  icon: "'.$_SESSION['flash']['tipe'].'",
						  title: "'.$_SESSION['flash']['aksi'].'",
						  text: "'.$_SESSION['flash']['pesan'].'",
						  showConfirmButton: false,
  						  timer: 2000
						})
					</script>
				';

				unset($_SESSION['flash']);
			}
		}
	}

	public function FlashSettings(){
		if(isset($_SESSION['flash'])){
			if($_SESSION['flash']['tipe'] == 'success'){
					echo '
						<script type="text/javascript">
							Swal.fire({
							  icon: "'.$_SESSION['flash']['tipe'].'",
							  title: "'.$_SESSION['flash']['aksi'].'",
							  text: "'.$_SESSION['flash']['pesan'].'",
							  showConfirmButton: false,
	  						  timer: 2000
							})
						</script>
					';

					unset($_SESSION['flash']);
			}else if($_SESSION['flash']['tipe'] == 'error'){
				echo '
					<script type="text/javascript">
						Swal.fire({
						  icon: "'.$_SESSION['flash']['tipe'].'",
						  title: "'.$_SESSION['flash']['aksi'].'",
						  text: "'.$_SESSION['flash']['pesan'].'",
						  showConfirmButton: false,
  						  timer: 2000
						})
					</script>
				';

				unset($_SESSION['flash']);
			}
		}
	}

}