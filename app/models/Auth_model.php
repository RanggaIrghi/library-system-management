<?php
    class Auth_model {
        private $table = 'librarian';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function findUserByEmail($email) {
            $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :email");
            $this->db->bind(':email', $email);

            return $this->db->single();
        }
    }