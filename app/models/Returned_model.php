<?php
    class Returned_model {
        private $table = "pengembalian";
        private $db;

        public function __construct() {
            $this->db = new Database;
            if(!session_id()) session_start();
        }

        public function getAllReturned() {
            $query = "SELECT 
                        pengembalian.id_pinjam,
                        `user`.fullname,
                        books.judul,
                        librarian.nama,
                        pengembalian.tnggl_pinjam,
                        pengembalian.bts_pinjam,
                        pengembalian.tnggl_kembali
                        FROM pengembalian
                        JOIN `user` ON pengembalian.id_user = `user`.id_user
                        JOIN books ON pengembalian.kode_buku = books.kode_buku
                        JOIN librarian ON pengembalian.id_petugas = librarian.id_petugas";

            $this->db->query($query);
            $results = $this->db->resultSet();

            foreach ($results as &$row) {
                $row['tnggl_pinjam'] = date('d-m-Y', strtotime($row['tnggl_pinjam']));
                $row['bts_pinjam'] = date('d-m-Y', strtotime($row['bts_pinjam']));
            } 

            return $results;
        }

        public function returnedBook($id) {
            $queryBorr = "SELECT * FROM peminjaman WHERE id_pinjam = :id_pinjam";
            $this->db->query($queryBorr);
            $this->db->bind(':id_pinjam', $id);
            $borrowedBook = $this->db->single();
        
            if (!$borrowedBook) {
                return 0;
            }
        
            $deleteQuery = "DELETE FROM peminjaman WHERE id_pinjam = :id_pinjam";
            $this->db->query($deleteQuery);
            $this->db->bind(':id_pinjam', $id);
            $this->db->execute();
        
            $updateBook = "UPDATE books SET qty = qty + 1 WHERE kode_buku = :bookId";
            $this->db->query($updateBook);
            $this->db->bind(':bookId', $borrowedBook['kode_buku']);
            $this->db->execute();
        
            $returnDate = date("Y-m-d");
            $dueDate = $borrowedBook['bts_pinjam'];
            $finePerDay = 50000;
            $lateDays = max(0, (strtotime($returnDate) - strtotime($dueDate)) / (60 * 60 * 24));
            $totalFine = $lateDays * $finePerDay;
        
            $query = "INSERT INTO pengembalian (tnggl_kembali, denda, id_pinjam, kode_buku, id_user, id_petugas, tnggl_pinjam, bts_pinjam) 
                      VALUES (:returnDate, :fine, :id_pinjam, :bookId, :userId, :id_petugas, :borrDate, :dueDate)";
            $this->db->query($query);
            $this->db->bind(':returnDate', $returnDate);
            $this->db->bind(':fine', $totalFine);
            $this->db->bind(':id_pinjam', $borrowedBook['id_pinjam']);
            $this->db->bind(':bookId', $borrowedBook['kode_buku']);
            $this->db->bind(':userId', $borrowedBook['id_user']);
            $this->db->bind(':id_petugas', $borrowedBook['id_petugas']);
            $this->db->bind(':borrDate', $borrowedBook['tnggl_pinjam']);
            $this->db->bind(':dueDate', $dueDate);
            $this->db->execute();
        
            return $this->db->rowCount();
        }             
    }