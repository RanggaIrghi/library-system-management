<?php
    class Borrowed_model {
        private $table = "peminjaman";
        private $db;

        public function __construct() {
            $this->db = new Database;
            if(!session_id()) session_start();
        }

        public function getAllBorrowed() {
            $query = "SELECT 
                        peminjaman.id_pinjam,
                        `user`.fullname,
                        books.kode_buku,
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
        
        public function getAllDue() {
            $query = "SELECT 
                        peminjaman.id_pinjam,
                        `user`.fullname,
                        books.kode_buku,
                        books.judul,
                        librarian.nama,
                        peminjaman.tnggl_pinjam,
                        peminjaman.bts_pinjam
                        FROM peminjaman
                        JOIN `user` ON peminjaman.id_user = `user`.id_user
                        JOIN books ON peminjaman.kode_buku = books.kode_buku
                        JOIN librarian ON peminjaman.id_petugas = librarian.id_petugas
                        WHERE bts_pinjam = NOW()";

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

            $query = "INSERT INTO " . $this->table . "(tnggl_pinjam, bts_pinjam, kode_buku, id_user, id_petugas)
                        VALUES
                        (:borrDate, :dueDate, :bookId, :userId, :id_petugas)";
            $this->db->query($query);
            $this->db->bind(':borrDate', $borrDate);
            $this->db->bind(':dueDate', $dueDate);
            $this->db->bind(':bookId', $data['bookId']);
            $this->db->bind(':userId', $data['userId']);
            $this->db->bind(':id_petugas', intval($_SESSION['id_petugas']));

            $this->db->execute();

            if($this->db->rowCount() > 0) {
                $updateBookQuery = "UPDATE books SET qty = qty - 1 WHERE kode_buku = :bookId AND qty > 0";
                $this->db->query($updateBookQuery);
                $this->db->bind(':bookId', $data['bookId']);
                $this->db->execute();
            }

            return $this->db->rowCount();
        }

        public function deleteDataBorrow($id) {
            $bookQuery = "SELECT kode_buku FROM peminjaman WHERE id_pinjam = :id";

            $this->db->query($bookQuery);
            $this->db->bind(':id', $id);
            $book = $this->db->single();

            $query = "DELETE FROM " . $this->table .  " WHERE id_pinjam = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);

            $this->db->execute();

            if($this->db->rowCount() > 0) {
                $updateBookQuery = "UPDATE books SET qty = qty + 1 WHERE kode_buku = :bookId";
                $this->db->query($updateBookQuery);
                $this->db->bind(':bookId', $book['kode_buku']);
                $this->db->execute();
            }
            
            return $this->db->rowCount();
        }

        public function searchBorrowed() {
            $search = $_POST['search'];
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
                        WHERE LOWER(user.nik) LIKE LOWER(:searchID) OR peminjaman.id_pinjam = :searchID";
            $this->db->query($query);
            $this->db->bind('search', "%" . strtolower($search) . "%");
            $this->db->bind('searchID', $search);
            return $this->db->resultSet();
        }
    }