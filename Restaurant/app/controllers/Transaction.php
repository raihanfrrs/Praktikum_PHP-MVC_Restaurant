<?php 

class Transaction extends Controller{
	protected $getRow;
	protected $header;
	protected $body;

	public function __construct(){
		new Validation;
	}

	public function index(){
		$this->header = [
			'title' => 'Transaction'
		];

		$this->getRow = $this->model('Product_model')->getAllProduct();

		$this->view('templates/header', $this->header);
		if(isset($_SESSION['shopping_cart'])){
			$subtotal 		= null;
			$discount 		= null;
            foreach ($_SESSION['shopping_cart'] as $product) {
              $subtotal += $product['harga']*$product['qty'];
              $discount += $product['potongan'];
            }

            $data = [
            	'subtotal' => $subtotal,
            	'discount' => $discount,
            	'grand_total' => $subtotal-$discount,
    					'produk' => $this->getRow
            ];

            $this->view('transaction/index', $data);
		}else{
			$this->view('transaction/index', $this->getRow);
		}
		$this->view('templates/footer');
	}

	public function addTransaction(){
		$required = array('customer_nama', 'alamat', 'ponsel', 'email', 'produk_nama', 'qty','catatan', 'action');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    $msg = false;
	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Transaction Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if($_POST['action'] == 'proses'){
	    		$this->getRow = $this->model('Product_model')->getDataProduct($_POST['produk_nama'], 'produk_nama');
	    		$pegawai = $this->model('Employee_model')->getDataEmployee($_SESSION['user']['user_login_id'], 'user_login_id');

	    		if(empty($this->getRow['produk_nama'])){
	    			Flasher::setFlash('Product Not Found!', 'Transaction Failed!', 'error', '');
	      			header('Location: '.SRCURL);
	      			exit;
	    		}

	    		$product_id = $this->getRow['produk_id'];

	    		$cartArray = array(
	    			$product_id => array(
	    				'pegawai_id' => $pegawai['pegawai_id'],
	    				'customer_nama' => $_POST['customer_nama'],
	    				'alamat' => $_POST['alamat'],
	    				'ponsel' => $_POST['ponsel'],
	    				'email' => $_POST['email'],
	    				'produk_id' => $this->getRow['produk_id'],
	    				'produk_nama' => $_POST['produk_nama'],
	    				'harga' => $this->getRow['harga'],
	    				'qty' => $_POST['qty'],
	    				'tanggal' => date("Y-m-d"),
	    				'catatan' => $_POST['catatan'],
	    				'potongan' => 0
	    			)
	    		);

	    		$data = [
    				'pegawai_id' => $pegawai['pegawai_id'],
    				'customer_nama' => $_POST['customer_nama'],
    				'alamat' => $_POST['alamat'],
    				'ponsel' => $_POST['ponsel'],
    				'email' => $_POST['email'],
    				'produk_id' => $this->getRow['produk_id'],
    				'produk_nama' => $_POST['produk_nama'],
    				'harga' => $this->getRow['harga'],
    				'qty' => $_POST['qty'],
    				'tanggal' => date("Y-m-d"),
    				'catatan' => $_POST['catatan'],
    				'potongan' => 0
    			];

	    		if(empty($_SESSION['shopping_cart'])){
	    			$_SESSION['shopping_cart'] = $cartArray;
	    			$_SESSION['product_code'] = $_POST['produk_id'];

	    			$this->model('Transaction_model')->insertTempCart($data);
	    			header('Location: '.SRCURL);
	    		}else{
	    			$array_keys = array_keys($_SESSION['shopping_cart']);
	    			if(in_array($product_id, $array_keys)){
	    				$_SESSION['product_code'] = $product_id;
	    			}else{
	    				$_SESSION['shopping_cart'] = array_merge(
	    					$_SESSION['shopping_cart'], $cartArray
	    				);
	    				$this->model('Transaction_model')->insertTempCart($data);
	    				header('Location: '.SRCURL);
	    			}
	    		}
	    	}
	    }
	}

	public function ChangeQty(){
		if(isset($_POST) && !empty($_POST)){
			foreach ($_SESSION['shopping_cart'] as $value) {
				if($value['produk_id'] == $_POST['produk_id'] && $value['pegawai_id'] == $_POST['pegawai_id']){
					
					$data = [
						'data' => $_POST['qty'],
						'produk_id' => $value['produk_id'],
						'pegawai_id' => $value['pegawai_id']
					];
					
					$this->model('Transaction_model')->updateDataTempCart($data, 'qty');
					header('Location: '.SRCURL);
				}
			}
		}
	}

	public function AddDiscount(){
		$required = array('customer_nama', 'alamat', 'ponsel', 'email', 'produk_id', 'produk_nama','harga', 'qty', 'tanggal', 'catatan');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    $msg = false;
	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Add Discount Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	foreach ($_SESSION['shopping_cart'] as $key => $value) {
    			if($value['produk_id'] == $_POST['produk_id']){
    				unset($_SESSION['shopping_cart'][$key]);
    			}
	    	}

	    	$data = [
				'data' => preg_replace('/[^0-9]/', "", $_POST['potongan']),
				'produk_id' => $_POST['produk_id'],
				'pegawai_id' => $_POST['pegawai_id']
			];

	    	if($this->model('Transaction_model')->updateDataTempCart($data, 'potongan') > 0){
	    		$product_id = $_POST['produk_id'];

	    		$cartArray = array(
	    			$product_id = array(
	    				'pegawai_id' => $_POST['pegawai_id'],
	    				'customer_nama' => $_POST['customer_nama'],
	    				'alamat' => $_POST['alamat'],
	    				'ponsel' => $_POST['ponsel'],
	    				'email' => $_POST['email'],
	    				'produk_id' => $_POST['produk_id'],
	    				'produk_nama' => $_POST['produk_nama'],
	    				'harga' => $_POST['harga'],
	    				'qty' => $_POST['qty'],
	    				'tanggal' => date("Y-m-d"),
	    				'catatan' => $_POST['catatan'],
	    				'potongan' => $data['data']
	    			)
	    		);

	    		if(empty($_SESSION['shopping_cart'])){
	    			$_SESSION['shopping_cart'] = $cartArray;
	    		}else{
	    			$array_keys = array_keys($_SESSION['shopping_cart']);
	    			if(in_array($product_id, $array_keys)){
	    				$_SESSION['product_code'] = $product_id;
	    			}else{
	    				$_SESSION['shopping_cart'] = array_merge(
	    					$_SESSION['shopping_cart'], $cartArray
	    				);
	    			}
	    		}
	    	}
	    	header('Location: '.SRCURL);
	    }
	}

	public function DeleteProduct(){
		$required = array('produk_id', 'pegawai_id');

    $error = false;
    foreach ($required as $field) {
      if(empty($_POST[$field])){
        $error = true;
      }
    }

    $msg = false;
    if($error){
    	Flasher::setFlash('System Failed', 'Delete Product Failed!', 'error', '');
      	header('Location: '.SRCURL);
      	exit;
    }else{
    	if (!empty($_SESSION['shopping_cart'])) {
    		foreach ($_SESSION['shopping_cart'] as $key => $value) {
    			if($_POST['produk_id'] == $value['produk_id']){
    				unset($_SESSION['shopping_cart'][$key]);

    				$data = [
    					'produk_id' => $_POST['produk_id'],
    					'pegawai_id' => $_POST['pegawai_id']
    				];

    				$field = [
    					'produk_id' => 'produk_id',
    					'pegawai_id' => 'pegawai_id'
    				];

    				$this->model('Transaction_model')->deleteTempCart($data, $field, 'delete');
    			}
    		}
    	}
    	if (empty($_SESSION['shopping_cart'])) {
    		unset($_SESSION['shopping_cart']);
    	}
    	header('Location: '.SRCURL);
    }
	}

	public function Checkout(){
		$required = array('customer_nama', 'alamat', 'ponsel', 'email', 'pegawai_id', 'catatan', 'grand_total');

    $error = false;
    foreach ($required as $field) {
      if(empty($_POST[$field])){
        $error = true;
      }
    }

    $msg = false;
    if($error){
    	Flasher::setFlash('System Failed', 'Checkout Failed!', 'error', '');
      	header('Location: '.SRCURL);
      	exit;
    }else{
    	$last_id = null;
    	if ($this->model('Customer_model')->checkAnyCustomer($_POST['customer_nama'], 'customer_nama') == 0) {

    		$customer = [
  				'customer_nama' => $_POST['customer_nama'],
  				'alamat' => $_POST['alamat'],
  				'ponsel' => $_POST['ponsel'],
  				'email' => $_POST['email']
    		];

    		$last_id = $this->model('Transaction_model')->insertDataCustomer($customer);
    	}else{
    		$this->getRow = $this->model('Customer_model')->getDataCustomer($_POST['customer_nama'], 'customer_nama', 'single');
    		$last_id = $this->getRow['customer_id'];
    	}

			$transaksi = [
					'customer_id' => $last_id,
					'pegawai_id' => $_POST['pegawai_id'],
					'catatan' => $_POST['catatan'],
					'tgl_transaksi' => date("Y-m-d H:i:s"),
					'grand_total' => $_POST['grand_total'],
					'produk_id' => $_POST['produk_id'],
					'total_qty' => $_POST['qty'],
					'subtotal' => $_POST['subtotal'],
					'potongan' => $_POST['potongan']
			];    	

			$this->getRow = $this->model('Transaction_model')->InsertDataTransaksi($transaksi);

    	if ($this->getRow['rowCount'] > 0) {
    		unset($_SESSION['shopping_cart']);
    		Flasher::setFlash('Checkout Success', 'Checkout Product Success!', 'success', '');
    		$_SESSION['transaction_id'] = $this->getRow['foreignKey'];
      	header('Location: '.BASEURL.'/Invoice/'.$_SESSION['transaction_id']);
      	exit;
    	}else{
    		Flasher::setFlash('Checkout Failed', 'Checkout Product Failed!', 'error', '');
      	header('Location: '.SRCURL);
      	exit;
    	}
    }
	}

	public function Reset(){
		if (!empty($_SESSION['shopping_cart'])) {
					$data = [
  					'produk_id' => $_POST['produk_id'],
  					'pegawai_id' => $_POST['pegawai_id']
  				];

  				$field = [
  					'produk_id' => 'produk_id',
  					'pegawai_id' => 'pegawai_id'
  				];

  				$this->model('Transaction_model')->deleteTempCart($data, $field, 'reset');
  				unset($_SESSION['shopping_cart']);
  				header('Location: '.SRCURL);
		}
	}
}