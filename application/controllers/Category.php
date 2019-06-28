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


	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->cat_model->delCat($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/category');
	}

	// method untuk tambah data cat
	public function insert(){

		// baca data dari form insert cat
		$category = $_POST['category'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->cat_model->insertCat($category);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/category');
	}

	// method untuk edit data buku berdasarkan id
	public function edit(){
		$kategori = $_POST['category'];
		$idkategori = $_POST['idkategori'];

		$this->cat_model->editCat($kategori, $idkategori);

		redirect('dashboard/category');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

}
?>