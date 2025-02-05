<?php
    class User_model {
        private $table = 'user';
        private $db;

        public function __construct() {
            $this->db = new Database;
            if(!session_id()) session_start();
        }

        public function getAllUser() {
            $this->db->query('SELECT * FROM ' . $this->table);
            $results = $this->db->resultSet();

            foreach ($results as &$row) {
                $row['tgl_lahir'] = date('d-m-Y', strtotime($row['tgl_lahir']));
            } 

            return $results;
        }

        public function getUsersByID($id) {
            $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user = :id');
            $this->db->bind('id', $id);
            $result = $this->db->single();

            $result['tgl_lahir'] = date('d-m-Y', strtotime($result['tgl_lahir']));

            return $result;
        }

        public function addDataUser($data) {
            $query = "INSERT INTO " . $this->table . " (nik, fullname, tgl_lahir, no_hp, alamat)
                        VALUES 
                        (:nik, :nama, :dateBorn, :phoneNumber, :addrss  )";
            $this->db->query($query);
            $this->db->bind('nik', $data['nik']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('dateBorn', $data['dateBorn']);
            $this->db->bind('phoneNumber', $data['phoneNumber']);
            $this->db->bind('addrss', $data['addrss']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function deleteDataUser($id) {
            $query = "DELETE FROM user WHERE id_user = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);

            $this->db->execute();
            
            return $this->db->rowCount();
        } 

        public function changeUserModel($data) {
            $dateBirt = date("Y-m-d", strtotime($data['dateBorn']));

            $query = "UPDATE user SET
                        nik = :nik,
                        fullname = :nama,
                        tgl_lahir = :dateBorn,
                        no_hp = :phoneNumber,
                        alamat = :addrss
                     WHERE id_user = :id_user";
                     
            $this->db->query($query);
            $this->db->bind('nik', $data['nik']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('dateBorn', $dateBirt);
            $this->db->bind('phoneNumber', $data['phoneNumber']);
            $this->db->bind('addrss', $data['addrss']);
            $this->db->bind('id_user', $data['id_user']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function searchUser() {
            $search = $_POST['search'];
            $query = "SELECT * FROM user WHERE LOWER(fullname) LIKE LOWER(:search) OR id_user = :searchID";
            $this->db->query($query);
            $this->db->bind('search', "%" . strtolower($search) . "%");
            $this->db->bind('searchID', $search);
            return $this->db->resultSet();
        }
    }