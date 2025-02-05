<?php
    class Book_model {
        private $table = 'books';
        private $db;

        public function __construct() {
            $this->db = new Database;
            if(!session_id()) session_start();
        }

        public function getAllBook() {
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->resultSet();
        }

        public function getBookByID($id) {
            $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kode_buku = :id');
            $this->db->bind('id', $id);
            return $this->db->single();
        }

        public function updateBookStock($kode_buku) {
            $query = "UPDATE books SET qty = qty + 1 WHERE kode_buku = :kode_buku";
            $this->db->query($query);
            $this->db->bind(':kode_buku', $kode_buku);
            return $this->db->execute();
        }

        public function addDataBook($data) {
            $query = "INSERT INTO " . $this->table . " (judul, kategori, qty, penulis, penerbit)
                        VALUES 
                        (:title, :category, :qty, :penulis, :penerbit)";
            $this->db->query($query);
            $this->db->bind('title', $data['title']);
            $this->db->bind('category', $data['category']);
            $this->db->bind('qty', $data['qty']);
            $this->db->bind('penulis', $data['penulis']);
            $this->db->bind('penerbit', $data['penerbit']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function deleteDataBook($id) {
            $query = "DELETE FROM " . $this->table .  " WHERE kode_buku = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);

            $this->db->execute();
            
            return $this->db->rowCount();
        }
        
        public function changeBookModel($data) {
            $query = "UPDATE " . $this->table . " SET
                        judul = :title,
                        kategori = :category,
                        qty = :qty
                     WHERE kode_buku = :id";
                     
            $this->db->query($query);
            $this->db->bind('title', $data['title']);
            $this->db->bind('category', $data['category']);
            $this->db->bind('qty', $data['qty']);
            $this->db->bind('id', $data['id']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function searchBookModel() {
            $search = $_POST['search'];
            $query = "SELECT * FROM " . $this->table . " WHERE LOWER(judul) LIKE LOWER(:search) OR kode_buku = :searchID";
            $this->db->query($query);
            $this->db->bind('search', "%" . strtolower($search) . "%");
            $this->db->bind('searchID', $search);
            return $this->db->resultSet();
        }
    }