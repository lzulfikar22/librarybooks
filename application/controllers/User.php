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


	// method hapus user berdasarkan id
	public function delete($username){
		if ($username == $_SESSION['username']) {
			redirect('dashboard/user');
		}
		$this->user_model->delUser($username);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method untuk tambah user
	public function insert(){

		// baca data dari form insert user
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		// panggil method insertUser() di model 'user_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $fullname, $password, $role);

		// arahkan ke method 'user' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method untuk edit user berdasarkan id
	public function edit(){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$old_username = $_POST['old_username'];

		// panggil method insertUser() di model 'user_model' untuk menjalankan query insert
		$this->user_model->editUser($username, $fullname, $password, $role, $old_username);
		redirect('dashboard/user');
	}
}
?>