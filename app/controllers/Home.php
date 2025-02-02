<?php

    class Home extends Controller {
        public function index() {
            $data['judul'] = 'Login';
            $this->view('home/login', $data);
        }

        public function authentication() {
            if(!session_id()) session_start();
            $user = $this->model('Auth_model')->findUserByEmail($_POST['email']);
            $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
            if(password_verify($_POST['pass'], $user['pass'])) {
                $_SESSION['id_petugas'] = $user['id_petugas'];
                header('Location: ' . BASE_URL . '/admin/');
                exit;
            } else {
                Flasher::setFlash(' Salah', ' !', 'bg-red-400');
                header('Location: ' . BASE_URL . '/home/');
                exit;
            }
        }

        public function logout() {
            session_unset();
            session_destroy();
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }