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
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['jabatan'];
                header('Location: ' . BASE_URL . '/admin');
                exit;
            }
        }

        public function logout() {
            if(!session_id()) session_start();
            
            $_SESSION = [];

            if(ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );    
            }
            session_destroy();

            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }