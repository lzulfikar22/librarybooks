<?php

class Cat_model extends CI_Model
{

    // method untuk menampilkan data kategori
    public function showCat($id = false)
    {
        // membaca semua data buku dari tabel 'books'
        if ($id == false) {
            $query = $this->db->get('category');
            return $query->result_array();
        } else {
            // membaca data buku berdasarkan id
            $query = $this->db->get_where('category', array("idkategori" => $id));
            return $query->row_array();
        }
    }

    // method untuk hapus data buku berdasarkan id
    public function delCat($id)
    {
        $this->db->delete('category', array("idkategori" => $id));
    }

    // method untuk mencari data buku berdasarkan key
    public function findBook($key)
    {

        $query = $this->db->query("SELECT * FROM books WHERE judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'");
        return $query->result_array();
    }

    // method untuk insert data buku ke tabel 'books'
    public function insertCat($category)
    {
        $data = array(
            "kategori" => $category
        );
        $query = $this->db->insert('category', $data);
    }

    // method untuk membaca data kategori buku dari tabel 'kategori'
    public function getKategori()
    {
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function editCat($kategori, $idkategori)
    {
        $data = array(
            "kategori" => $kategori
        );
        $this->db->update('category', $data, "idkategori = " . $idkategori);
    }

    // method untuk menghitung jumlah buku berdasarkan idkategori
    public function countByCat($idkategori)
    {
        $query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
        return $query->row()->jum;
    }
}
