<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user berdasar username
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}    
	// method untuk menampilkan user
    public function showUser($username = false)
    {
        // membaca semua data buku dari tabel 'books'
        if ($username == false) {
            $query = $this->db->get('users');
            return $query->result_array();
        } else {
            // membaca data buku berdasarkan id
            $query = $this->db->get_where('users', array("username" => $username));
            return $query->row_array();
        }
    }

    // method untuk insert data user ke tabel 'user'
    public function insertUser($username, $fullname, $password, $role)
    {
        $data = array(
            "username" => $username,
            "fullname" => $fullname,
            "password" => $password,
            "role" => $role
        );
        $query = $this->db->insert('users', $data);
    }
    public function delUser($username)
    {
        $this->db->delete('users', array("username" => $username));
    }

    public function editUser($username, $fullname, $password, $role, $old_username)
    {
        $data = array(
            "username" => $username,
            "fullname" => $fullname,
            "password" => $password,
            "role" => $role
        );
        $this->db->update('users', $data, "username = '" . $old_username ."'");
    }
}

?>