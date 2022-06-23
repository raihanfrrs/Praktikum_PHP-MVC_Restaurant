<?php 

class Master extends Controller{
	protected $header;
	protected $body;
	protected $getRow;

	public function __construct(){
		new Validation;
	}

	public function category(){
		$this->getRow = $this->model('Categories_model')->getAllCategory();

		$this->header = [
			'title' => 'Category'
		];

		$this->body = [
			'category' => $this->getRow,
			'display' => 'visible',
			'judul' => 'Category',
			'action' => 'addCategory',
			'breadcrumb' => 'Category'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/category', $this->body);
		$this->view('templates/footer');
	}

	public function product(){
		$category = $this->model('Categories_model')->getAllCategory();
		$product = $this->model('Product_model')->getAllProductAndCategory();

		$this->header = [
			'title' => 'Product'
		];

		$this->body = [
			'category' => $category,
			'product' => $product,
			'display' => 'visible',
			'judul' => 'Product',
			'action' => 'addProduct',
			'breadcrumb' => 'Product',
			'type' => 'addProduct'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/product', $this->body);
		$this->view('templates/footer');
	}

	public function customer(){
		$this->getRow = $this->model('Customer_model')->getAllCustomer();

		$this->header = [
			'title' => 'Customer'
		];

		$this->body = [
			'display' => 'visible',
			'judul' => 'Customer',
			'action' => 'addCustomer',
			'customer' => $this->getRow,
			'breadcrumb' => 'Customer'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/customer', $this->body);
		$this->view('templates/footer');
	}

	public function editCategory($id){
		$this->getRow = $this->model('Categories_model')->getDataCategory($id, 'jenis_id');

		$this->header = [
			'title' => 'Edit Category'
		];

		$this->body = [
			'display' => 'invisible',
			'judul' => 'Edit Category',
			'action' => 'processEditCategory',
			'data' => $this->getRow,
			'breadcrumb' => 'Edit Category'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/category', $this->body);
		$this->view('templates/footer');
	}

	public function editProduct($id){
		$product = $this->model('Product_model')->getAllProductAndCategoryByCond($id, 'produk_id');
		$category = $this->model('Categories_model')->getDataCategoryWhereNot($product['jenis_id'], 'jenis_id', 'all');

		$this->header = [
			'title' => 'Edit Product'
		];

		$this->body = [
			'display' => 'invisible',
			'judul' => 'Edit Product',
			'action' => 'processEditProduct',
			'produk' => $product,
			'kategori' => $category,
			'breadcrumb' => 'Edit Product',
			'type' => 'editProduct'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/product', $this->body);
		$this->view('templates/footer');
	}

	public function editCustomer($id){
		$this->getRow = $this->model('Customer_model')->getDataCustomer($id, 'customer_id', 'single');

		$this->header = [
			'title' => 'Edit Customer'
		];

		$this->body = [
			'display' => 'invisible',
			'judul' => 'Edit Customer',
			'action' => 'processEditCustomer',
			'customer' => $this->getRow,
			'breadcrumb' => 'Edit Customer'
		];

		$this->view('templates/header', $this->header);
		$this->view('master/customer', $this->body);
		$this->view('templates/footer');
	}

	public function addProduct(){
		$required = array('produk_nama', 'harga', 'deskripsi', 'kategori');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    $data = [
        	'produk_nama' => $_POST['produk_nama'],
        	'harga' => preg_replace('/[^0-9]/', "", $_POST['harga']),
        	'deskripsi' => $_POST['deskripsi'],
        	'kategori' => $_POST['kategori']
        ];


	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Add Product Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if(isset($_POST) && !empty($_POST)){

				if($this->model('Product_model')->checkAnyProduct($_POST['produk_nama'], 'produk_nama') > 0){
					Flasher::setFlash('Product is already registered in the system!', 'Add Product Failed!', 'error', '');
					
					header('Location: '.SRCURL);
					exit;
				}else{
					if($this->model('Product_model')->insertProductData($data) > 0){
						Flasher::setFlash('Product has not been registered in the system!', 'Add Product Success', 'success', '');
					
						header('Location: '.SRCURL);
						exit;
					}else{
						Flasher::setFlash('Product cannot be added!', 'Add Product Failed!'. 'error', '');

						header('Location: '.SRCURL);
						exit;
					}
				}
			}else{
				Flasher::setFlash('Form cannot be empty!', 'Add Product Failed!', 'error', '');

				header('Location: '.SRCURL);
				exit;
			}
	    }
	}

	public function addCategory(){
		if(isset($_POST) && !empty($_POST)){
			if(empty($_POST['kategori'])){
				Flasher::setFlash('Form cannot be empty!', 'Add Category Failed!', 'error', '');
				
				header('Location: '.SRCURL);
				exit;
			}

			if($this->model('Categories_model')->checkAnyCategory($_POST['kategori'], 'jenis_nama') > 0){
				Flasher::setFlash('Category is already registered in the system!', 'Add Category Failed!', 'error', '');
				
				header('Location: '.SRCURL);
				exit;
			}else{
				if($this->model('Categories_model')->insertCategoryData($_POST) > 0){
					Flasher::setFlash('Category has not been registered in the system!', 'Add Category Success', 'success', '');
				
					header('Location: '.SRCURL);
					exit;
				}else{
					Flasher::setFlash('Categories cannot be added!', 'Add Category Failed!'. 'error', '');

					header('Location: '.SRCURL);
					exit;
				}
			}
		}else{
			Flasher::setFlash('Form cannot be empty!', 'Add Category Failed!', 'error', '');

			header('Location: '.SRCURL);
			exit;
		}
	}

	public function addCustomer(){
		$required = array('customer_nama', 'alamat', 'ponsel', 'email');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Add Customer Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if(isset($_POST) && !empty($_POST)){

				if($this->model('Customer_model')->checkAnyCustomer($_POST['customer_nama'], 'customer_nama') > 0){
					Flasher::setFlash('Customer is already registered in the system!', 'Add Customer Failed!', 'error', '');
					
					header('Location: '.SRCURL);
					exit;
				}else if($this->model('Customer_model')->checkAnyCustomer($_POST['ponsel'], 'ponsel') > 0){
					Flasher::setFlash('Phone has been used in the system!', 'Add Customer Failed!', 'error', '');
					
					header('Location: '.SRCURL);
					exit;
				}else if($this->model('Customer_model')->checkAnyCustomer($_POST['email'], 'email') > 0){
					Flasher::setFlash('Email has been used in the system!', 'Add Customer Failed!', 'error', '');
					
					header('Location: '.SRCURL);
					exit;
				}else{
					if($this->model('Customer_model')->insertCustomerData($_POST) > 0){
						Flasher::setFlash('Customer has not been registered in the system!', 'Add Customer Success', 'success', '');
					
						header('Location: '.SRCURL);
						exit;
					}else{
						Flasher::setFlash('Customer cannot be added!', 'Add Customer Failed!'. 'error', '');

						header('Location: '.SRCURL);
						exit;
					}
				}
			}else{
				Flasher::setFlash('Form cannot be empty!', 'Add Customer Failed!', 'error', '');

				header('Location: '.SRCURL);
				exit;
			}
	    }
	}

	public function deleteProduct($id){
		if(empty($id)){
			Flasher::setFlash('System error!', 'Delete Product Failed!', 'error', '');

			header('Location: '.SRCURL);
			exit;
		}else{
			if($this->model('Product_model')->checkAnyProduct($id, 'produk_id') > 0){
				if($this->model('Product_model')->deleteProduct($id) > 0){
					Flasher::setFlash('Product has been deleted!', 'Delete Product Success!', 'success', '');

					header('Location: '.SRCURL);
					exit;
				}else{
					Flasher::setFlash('System error!', 'Product Category Failed!', 'error', '');

					header('Location: '.SRCURL);
					exit;
				}
			}else{
				Flasher::setFlash('Empty category!', 'Product Category Failed!', 'error', '');

				header('Location: '.SRCURL);
				exit;
			}
		}
	}

	public function deleteCategory($id){
		if(empty($id)){
			Flasher::setFlash('System error!', 'Delete Category Failed!', 'error', '');

			header('Location: '.SRCURL);
			exit;
		}else{
			if($this->model('Categories_model')->checkAnyCategory($id, 'jenis_id') > 0){
				if($this->model('Categories_model')->deleteCategory($id) > 0){
					Flasher::setFlash('Category has been deleted!', 'Delete Category Success!', 'success', '');

					header('Location: '.SRCURL);
					exit;
				}else{
					Flasher::setFlash('System error!', 'Delete Category Failed!', 'error', '');

					header('Location: '.SRCURL);
					exit;
				}
			}else{
				Flasher::setFlash('Empty category!', 'Delete Category Failed!', 'error', '');

				header('Location: '.SRCURL);
				exit;
			}
		}
	}

	public function deleteCustomer($id){
		if(empty($id)){
			Flasher::setFlash('System error!', 'Delete Customer Failed!', 'error', '');

			header('Location: '.SRCURL);
			exit;
		}else{
			if($this->model('Customer_model')->checkAnyCustomer($id, 'customer_id') > 0){
				if($this->model('Customer_model')->deleteCustomer($id) > 0){
					Flasher::setFlash('Customer has been deleted!', 'Delete Customer Success!', 'success', '');

					header('Location: '.SRCURL);
					exit;
				}else{
					Flasher::setFlash('System error!', 'Delete Customer Failed!', 'error', '');

					header('Location: '.SRCURL);
					exit;
				}
			}else{
				Flasher::setFlash('Empty customer!', 'Delete Customer Failed!', 'error', '');

				header('Location: '.SRCURL);
				exit;
			}
		}
	}

	public function processEditProduct($id){
		$required = array('produk_nama', 'harga', 'deskripsi', 'kategori');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    $data = [
        	'produk_nama' => $_POST['produk_nama'],
        	'harga' => preg_replace('/[^0-9]/', "", $_POST['harga']),
        	'deskripsi' => $_POST['deskripsi'],
        	'kategori' => $_POST['kategori']
        ];

        if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Edit Product Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if(empty($id)){
				Flasher::setFlash('System error!', 'Edit Produk Failed!', 'error', '');

				header('Location: '.BASEURL.'/master/product');
				exit;
			}else{
				if($this->model('Product_model')->editProduct($data, $id, 'produk_id') > 0){
					Flasher::setFlash('Product has been changed!', 'Edit Product Success!', 'success', '');

					header('Location: '.BASEURL.'/master/product');
					exit;
				}else{
					Flasher::setFlash('System error!', 'Edit Category Failed!', 'error', '');

					header('Location: '.BASEURL.'/master/product');
					exit;
				}
			}
	    }
	}

	public function processEditCategory($id){
		if(empty($id)){
			Flasher::setFlash('System error!', 'Edit Category Failed!', 'error', '');

			header('Location: '.BASEURL.'/master/category');
			exit;
		}else{
			if($this->model('Categories_model')->checkAnyCategory($_POST['kategori'], 'jenis_nama') > 0){
				Flasher::setFlash('Category is already registered in the system!', 'Edit Category Failed!', 'error', '');
				
				header('Location: '.BASEURL.'/master/category');
				exit;
			}else{
				if($this->model('Categories_model')->editCategory($_POST['kategori'], 'jenis_nama', $id, 'jenis_id') > 0){
					Flasher::setFlash('Category has been changed!', 'Edit Category Success!', 'success', '');

					header('Location: '.BASEURL.'/master/category');
					exit;
				}else{
					Flasher::setFlash('System error!', 'Edit Category Failed!', 'error', '');

					header('Location: '.BASEURL.'/master/category');
					exit;
				}
			}
		}
	}

	public function processEditCustomer($id){
		$required = array('customer_nama', 'alamat', 'ponsel', 'email');

	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Add Customer Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if(empty($id)){
				Flasher::setFlash('System error!', 'Edit Customer Failed!', 'error', '');

				header('Location: '.BASEURL.'/master/customer');
				exit;
			}else{
				if($this->model('Customer_model')->editCustomer($_POST, $id, 'customer_id') > 0){
					Flasher::setFlash('Customer has been changed!', 'Edit Customer Success!', 'success', '');

					header('Location: '.BASEURL.'/master/customer');
					exit;
				}else{
					Flasher::setFlash('System error!', 'Edit Customer Failed!', 'error', '');

					header('Location: '.BASEURL.'/master/customer');
					exit;
				}
			}
	    }
	}
}