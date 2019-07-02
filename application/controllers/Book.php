<?php
class Book extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])) {
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($id)
	{
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk tambah data buku
	public function insert()
	{
		$temp = explode(".", $_FILES["imgcover"]["name"]);
		$name = date('YmdHis') . '.' . end($temp);
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $name;
		$this->upload->initialize($config);
		$this->upload->do_upload('imgcover');

		// baca nama file upload
		// $filename = $_FILES["imgcover"]["name"];

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $name);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk edit data buku berdasarkan id
	public function edit()
	{
		$temp = explode(".", $_FILES["imgcover"]["name"]);
		$name = date('YmdHis') . '.' . end($temp);
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $name;
		$this->upload->initialize($config);
		// $this->upload->do_upload("imgcover");
		// baca nama file upload
		// $filename = $_FILES["imgcover"]["name"];

		if (!$this->upload->do_upload('imgcover')) {
			$filename = "";
		} else {
			$filename = $name;
		}

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];
		$idbuku = $_POST['idbuku'];

		$this->book_model->editBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename, $idbuku);

		redirect('dashboard/books');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks()
	{

		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/books', $data);
		$this->load->view('dashboard/footer');
	}
}
