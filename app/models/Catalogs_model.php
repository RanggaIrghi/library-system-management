<?php
    class Catalogs_model {
        private $table = "peminjaman";
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getAllCatalog() {
            $query = "SELECT 
                        peminjaman.id_pinjam,
                        `user`.fullname,
                        books.judul,
                        librarian.nama,
                        peminjaman.tnggl_pinjam,
                        peminjaman.bts_pinjam
                        FROM peminjaman
                        JOIN `user` ON peminjaman.id_user = `user`.id_user
                        JOIN books ON peminjaman.kode_buku = books.kode_buku
                        JOIN librarian ON peminjaman.id_petugas = librarian.id_petugas";

            $this->db->query($query);
            $results = $this->db->resultSet();

            foreach ($results as &$row) {
                $row['tnggl_pinjam'] = date('d-m-Y', strtotime($row['tnggl_pinjam']));
                $row['bts_pinjam'] = date('d-m-Y', strtotime($row['bts_pinjam']));
            } 

            return $results;
        }

        public function getBorrowedByID($id) {
            $query = "SELECT 
                        peminjaman.id_pinjam,
                        `user`.fullname,
                        books.judul,
                        books.kategori,
                        books.penulis,
                        librarian.nama,
                        peminjaman.tnggl_pinjam,
                        peminjaman.bts_pinjam
                        FROM peminjaman
                        JOIN `user` ON peminjaman.id_user = `user`.id_user
                        JOIN books ON peminjaman.kode_buku = books.kode_buku
                        JOIN librarian ON peminjaman.id_petugas = librarian.id_petugas
                        WHERE peminjaman.id_pinjam = :id";
                        
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->single();

            $result['tnggl_pinjam'] = date('d-m-Y', strtotime($result['tnggl_pinjam']));
            $result['bts_pinjam'] = date('d-m-Y', strtotime($result['bts_pinjam']));

            return $result;
        }

        public function addCatalog($data) {
            $borrDate = date("Y/m/d", strtotime($data['borrDate']));
            $dueDate = date("Y/m/d", strtotime($data['dueDate']));

            $query = "INSERT INTO " . $this->table . "(tnggl_pinjam, bts_pinjam, kode_buku, id_user)
                        VALUES
                        (:borrDate, :dueDate, :bookId, :userId)";
            $this->db->query($query);
            $this->db->bind('borrDate', $borrDate);
            $this->db->bind('dueDate', $dueDate);
            $this->db->bind('bookId', $data['bookId']);
            $this->db->bind('userId', $data['userId']);

            $this->db->execute();

            return $this->db->rowCount();
        }
    }