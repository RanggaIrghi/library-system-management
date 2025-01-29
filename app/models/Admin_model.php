<?php
    class Admin_model {
        private $table = 'librarian';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getAllLibrarian() {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->resultSet();
        }

        public function getLibrarianByID($id) {
            $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_petugas = :id');
            $this->db->bind('id', $id);
            return $this->db->single();
        }

        public function addDataLibrarian($data) {
            $query = "INSERT INTO librarian (username, password, nama, jabatan, tgl_lahir, telp, alamat)
                        VALUES 
                        (:email, :pass, :nama, :roles, :dateBorn, :phoneNumber, :addrss  )";
            $this->db->query($query);
            $this->db->bind('email', $data['email']);
            $this->db->bind('pass', $data['pass']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('roles', $data['roles']);
            $this->db->bind('dateBorn', $data['dateBorn']);
            $this->db->bind('phoneNumber', $data['phoneNumber']);
            $this->db->bind('addrss', $data['addrss']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function deleteDataLibrarian($id) {
            $query = "DELETE FROM librarian WHERE id_petugas = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);

            $this->db->execute();
            
            return $this->db->rowCount();
        }

        public function changeLibrarian($data) {
            $query = "UPDATE librarian SET
                        username = :email,
                        pass = :pass,
                        nama = :nama,
                        jabatan = :roles,
                        tgl_lahir = :dateBorn,
                        telp = :phoneNumber,
                        alamat = :addrss
                     WHERE id_petugas = :id_petugas";
                     
            $this->db->query($query);
            $this->db->bind('email', $data['email']);
            $this->db->bind('pass', $data['pass']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('roles', $data['roles']);
            $this->db->bind('dateBorn', $data['dateBorn']);
            $this->db->bind('phoneNumber', $data['phoneNumber']);
            $this->db->bind('addrss', $data['addrss']);
            $this->db->bind('id_petugas', $data['id_petugas']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function searchLibrarian() {
            $search = $_POST['search'];
            $query = "SELECT * FROM librarian WHERE LOWER(nama) LIKE LOWER(:search) OR id_petugas = :searchID";
            $this->db->query($query);
            $this->db->bind('search', "%" . strtolower($search) . "%");
            $this->db->bind('searchID', $search);
            return $this->db->resultSet();
        }
    }