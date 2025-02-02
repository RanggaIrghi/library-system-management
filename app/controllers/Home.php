<?php

    class Home extends Controller {
        public function index() {
            $data['judul'] = 'Login';
            $this->view('home/login', $data);
        }

        public function authentication() {
            session_start();
            $user = $this->model('Auth_model')->findUserByEmail($_POST['email']);

            echo "ok";

            if($user && password_verify($_POST['password'], $user['pass'])) {
                $_SESSION['id_petugas'] = $user['id_petugas'];
                header('Location: ' . BASE_URL . '/admin/');
                exit;
            } else {
                Flasher::setFlash(' Salah', ' !', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/catalogs_list');
                exit;
            }
        }
    }