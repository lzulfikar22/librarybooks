<?php
class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus kategori berdasarkan id
	public function delete($id){
		$this->cat_model->delCat($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/category');
	}

	// method untuk tambah data kategori
	public function insert(){

		// baca data dari form insert kategori
		$category = $_POST['category'];

		// panggil method insertBook() di model 'cat_model' untuk menjalankan query insert
		$this->cat_model->insertCat($category);

		// arahkan ke method 'category' di kontroller 'dashboard'
		redirect('dashboard/category');
	}

	// method untuk edit kategori berdasarkan id
	public function edit(){
		$kategori = $_POST['category'];
		$idkategori = $_POST['idkategori'];

		$this->cat_model->editCat($kategori, $idkategori);

		redirect('dashboard/category');
	}
}
?>