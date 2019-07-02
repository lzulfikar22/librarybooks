<?php
class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// cek keberadaan session 'username'	

		if (!isset($_SESSION['username'])) {
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
		$data['fullname'] = $_SESSION['fullname']; // Untuk Nama
		$data['role'] = $_SESSION['role']; // Untuk Role (Admin atau Operator)

		//Memuat header
		$this->load->view('dashboard/template/header', $data);

		// Menentukan apakah dia Admin atau operator
		if ($data['role'] == "admin") {
			$this->load->view('dashboard/template/sidebar');
		} elseif ($data['role'] == "operator") {
			$this->load->view('dashboard/template/sidebar2');
		}
	}
	// ------------------------------------------INDEX------------------------------------------------------------//

	// halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori
	public function index()
	{

		// panggil method countByCat() di model book_model untuk menghitung jumlah data buku per kategori untuk ditampilkan di view
		$data['countBukuTeks'] = $this->book_model->countByCat('1');
		$data['countMajalah'] = $this->book_model->countByCat('2');
		$data['countSkripsi'] = $this->book_model->countByCat('3');
		$data['countThesis'] = $this->book_model->countByCat('4');
		$data['countDisertasi'] = $this->book_model->countByCat('5');
		$data['countNovel'] = $this->book_model->countByCat('6');
		$data['countKomik'] = $this->book_model->countByCat('7');
		$data['tampil'] = true;

		// tampilkan view 'dashboard/index'
		$this->load->view('dashboard/index');
		$this->load->view('dashboard/template/footer', $data);
	}

	// ------------------------------------------BUKU------------------------------------------------------------//
	// method untuk menambah data buku
	public function add()
	{
		// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
		$data['kategori'] = $this->book_model->getKategori();

		// tampilkan view 'dashboard/add'
		$this->load->view('dashboard/adder/add', $data);
		$this->load->view('dashboard/template/footer');
	}

	// method untuk menampilkan seluruh data buku
	public function books()
	{
		// panggil method showBook() dari book_model untuk membaca seluruh data buku
		$id = false;
		$data['jumlah'] = $this->book_model->countAll();

		// Mengatur Pagination
		$config['base_url'] = base_url() . 'index.php/dashboard/books/';
		$config['total_rows'] = $data['jumlah'];
		$config['per_page'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"> <span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['attributes'] = array('class' => 'page-link');
		$from = $this->uri->segment(3);

		// Nampilin data sebanyak 5 dari total
		$data['book'] = $this->book_model->showBook($id, $config['per_page'], $from);
		$this->pagination->initialize($config);

		// tampilkan view 'dashboard/books'
		$this->load->view('dashboard/books', $data);
		$this->load->view('dashboard/template/footer');
	}
	public function view($idbuku)
	{

		// panggil method showBook() dari book_model untuk membaca seluruh data buku
		$data['book'] = $this->book_model->showBook($idbuku);

		// tampilkan view 'dashboard/books'
		$this->load->view('dashboard/view', $data);
		$this->load->view('dashboard/template/footer');
	}
	public function edit($idbuku = FALSE)
	{
		// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
		$data['book'] = $this->book_model->showBook($idbuku);

		$data['kategori'] = $this->book_model->getKategori();

		// tampilkan view 'dashboard/add'
		$this->load->view('dashboard/edit/edit', $data);
		$this->load->view('dashboard/template/footer');
	}

	// ------------------------------------------KATEGORI--------------------------------------------------------//
	public function category()
	{

		// panggil method showCat() dari untuk membaca seluruh kategori
		$data['cat'] = $this->cat_model->showCat();

		// tampilkan view 'dashboard/category'
		$this->load->view('dashboard/category', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function editcat($idcat = FALSE)
	{
		// Manggil Category
		$data['cat'] = $this->cat_model->showCat($idcat);

		// tampilkan view untuk edit kategori
		$this->load->view('dashboard/edit/editcat', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function addcat()
	{
		// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
		$data['kategori'] = $this->book_model->getKategori();

		// tampilkan view add kategori
		$this->load->view('dashboard/adder/addcat', $data);
		$this->load->view('dashboard/template/footer');
	}

	// ---------------------------------------------USER--------------------------------------------------------//
	public function user()
	{

		// panggil method showUser() untuk membaca seluruh user
		$data['user'] = $this->user_model->showUser();

		// tampilkan view user
		$this->load->view('dashboard/user', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function edituser($username = FALSE)
	{
		// Manggil data seluruh user
		$data['user'] = $this->user_model->showUser($username);

		// tampilkan view edit user
		$this->load->view('dashboard/edit/edituser', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function adduser()
	{
		// tampilkan view 'dashboard/user
		$this->load->view('dashboard/adder/adduser');
		$this->load->view('dashboard/template/footer');
	}

	// ------------------------------------------LOGOUT--------------------------------------------------------//

	// method untuk proses logout
	public function logout()
	{
		// hapus seluruh data session
		session_destroy();
		// redirect ke kontroller 'login'
		redirect('login');
	}
}
