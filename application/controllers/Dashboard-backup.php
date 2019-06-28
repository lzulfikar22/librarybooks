<?php
class Dashboard extends CI_Controller {

		public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
            
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}
			
            
		}

		// halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori

        public function index(){

        	// panggil method countByCat() di model book_model untuk menghitung jumlah data buku per kategori untuk ditampilkan di view
        	$data['countBukuTeks'] = $this->book_model->countByCat('1');
        	$data['countMajalah'] = $this->book_model->countByCat('2');
        	$data['countSkripsi'] = $this->book_model->countByCat('3');
        	$data['countThesis'] = $this->book_model->countByCat('4');
        	$data['countDisertasi'] = $this->book_model->countByCat('5');
        	$data['countNovel'] = $this->book_model->countByCat('6');
        	$data['countKomik'] = $this->book_model->countByCat('7');

        	// baca data session 'fullname' untuk ditampilkan di view

			// tampilkan view 'dashboard/index'
			$data['fullname'] = $_SESSION['fullname'];
			$data['role'] = $_SESSION['role'];
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/index');
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menambah data buku
		public function add(){
			// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
			$data['kategori'] = $this->book_model->getKategori();

			// menghitung jumlah data buku per kategori untuk ditampilkan di view
			// $data['countBukuTeks'] = 0;
        	// $data['countMajalah'] = 0;
        	// $data['countSkripsi'] = 0;
        	// $data['countThesis'] = 0;
        	// $data['countDisertasi'] = 0;
        	// $data['countNovel'] = 0;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/add'
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/add', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menampilkan seluruh data buku
        public function books(){

        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['book'] = $this->book_model->showBook();

      		// $data['countBukuTeks'] = 0;
        	// $data['countMajalah'] = 0;
        	// $data['countSkripsi'] = 0;
        	// $data['countThesis'] = 0;
        	// $data['countDisertasi'] = 0;
        	// $data['countNovel'] = 0;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/books', $data);
            $this->load->view('dashboard/footer', $data);
        } 
        public function category(){

        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['cat'] = $this->cat_model->showCat();

      		// $data['countBukuTeks'] = 0;
        	// $data['countMajalah'] = 0;
        	// $data['countSkripsi'] = 0;
        	// $data['countThesis'] = 0;
        	// $data['countDisertasi'] = 0;
        	// $data['countNovel'] = 0;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/category', $data);
            $this->load->view('dashboard/footer', $data);
        }        
        public function user(){

        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['user'] = $this->user_model->showUser();

      		// $data['countBukuTeks'] = 0;
        	// $data['countMajalah'] = 0;
        	// $data['countSkripsi'] = 0;
        	// $data['countThesis'] = 0;
        	// $data['countDisertasi'] = 0;
        	// $data['countNovel'] = 0;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/user', $data);
            $this->load->view('dashboard/footer', $data);
        }        

        // method untuk proses logout
        public function logout(){
        	// hapus seluruh data session
        	session_destroy();
        	// redirect ke kontroller 'login'
        	redirect('login');
        }
}