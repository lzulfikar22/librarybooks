<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($username){
		if ($username == $_SESSION['username']) {
			redirect('dashboard/user');
		}
		$this->user_model->delUser($username);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method untuk tambah data buku
	public function insert(){

		// baca data dari form insert buku
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $fullname, $password, $role);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method untuk edit data buku berdasarkan id
	public function edit(){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$old_username = $_POST['old_username'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->editUser($username, $fullname, $password, $role, $old_username);
		redirect('dashboard/user');
	}

	// method untuk update data buku berdasarkan id
	public function update($id){

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