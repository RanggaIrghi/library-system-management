<?php
    class Admin extends Controller {
        public function index() {
            $data['judul'] = 'Admin Dashboard';
            $this->view('templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('templates/footer');
        }

        public function catalogs_list() {
            $data['judul'] = "Admin Dashboard - Catalogs List";
            $data['peminjaman'] = $this->model('Catalogs_model')->getAllCatalog();
            $data['books'] = $this->model('Book_model')->getAllBook();
            $data['user'] = $this->model('User_model')->getAllUser();
            $this->view('templates/header', $data);
            $this->view('admin/catalogs_list', $data);
            $this->view('templates/footer');
        }

        public function add_new_catalog() {
            if($this->model('Catalogs_model')->addCatalog($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' ditambahkan', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/catalogs_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' ditambahkan', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/catalogs_list');
                exit;
            }
        }

        public function getBorrow() {
            echo json_encode($this->model('Catalogs_model')->getBorrowedByID($_POST['id']));
        }

        public function book_list() {
            $data['judul'] = 'Admin Dashboard - Book List';
            $data['books'] = $this->model('Book_model')->getAllBook();
            $this->view('templates/header', $data);
            $this->view('admin/book_list', $data);
            $this->view('templates/footer');
        }

        public function add_book() {
            if($this->model('Book_model')->addDataBook($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' ditambahkan', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' ditambahkan', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            }
        }

        public function delete_book($id) {
            if($this->model('Book_model')->deleteDataBook($id) > 0) {
                Flasher::setFlash(' berhasil', ' dihapus', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' dihapus', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            }
        }

        public function getBook() {
            echo json_encode($this->model('Book_model')->getBookByID($_POST['id']));
        }

        public function changeBook() {
            if($this->model('Book_model')->changeBookModel($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' diubah', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' diubah', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/book_list');
                exit;
            }
        }

        public function searchBook() {
            $data['judul'] = 'Admin Dashboard - Book List';
            $data['books'] = $this->model('Book_model')->searchBookModel();
            $this->view('templates/header', $data);
            $this->view('admin/book_list', $data);
            $this->view('templates/footer');
        }

        public function users_list() {
            $data['judul'] = 'Admin Dashboard - Users List';
            $data['user'] = $this->model('User_model')->getAllUser();
            $this->view('templates/header', $data);
            $this->view('admin/users_list', $data);
            $this->view('templates/footer');
        }

        public function add_user() {
            if($this->model('User_model')->addDataUser($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' ditambahkan', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' ditambahkan', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            }
        }

        public function delete_user($id) {
            if($this->model('User_model')->deleteDataUser($id) > 0) {
                Flasher::setFlash(' berhasil', ' dihapus', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' dihapus', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            }
        }

        public function getUser() {
            echo json_encode($this->model('User_model')->getUsersByID($_POST['id']));
        }

        public function changeUser() {
            if($this->model('User_model')->changeUserModel($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' diubah', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' diubah', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/users_list');
                exit;
            }
        }

        public function searchUser() {
            $data['judul'] = 'Admin Dashboard - Users List';
            $data['user'] = $this->model('User_model')->searchUser();
            $this->view('templates/header', $data);
            $this->view('admin/users_list', $data);
            $this->view('templates/footer');
        }

        public function admin_list() {
            $data['judul'] = 'Admin Dashboard - Admin List';
            $data['librarian'] = $this->model('Admin_model')->getAllLibrarian();
            $this->view('templates/header', $data);
            $this->view('admin/admin_list', $data);
            $this->view('templates/footer');
        }

        public function detail($id) {
            $data['judul'] = 'Admin Dashboard - Detail Librarian';
            $data['librarian'] = $this->model('Admin_model')->getLibrarianByID($id);
            $this->view('templates/header', $data);
            $this->view('admin/detail', $data);
            $this->view('templates/footer');
        }

        public function add_data() {
            if($this->model('Admin_model')->addDataLibrarian($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' ditambahkan', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' ditambahkan', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            }
        }

        public function delete($id) {
            if($this->model('Admin_model')->deleteDataLibrarian($id) > 0) {
                Flasher::setFlash(' berhasil', ' dihapus!', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' dihapus!', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            }
        }

        public function getData() {
            echo json_encode($this->model('Admin_model')->getLibrarianByID($_POST['id']));
        }

        public function change() {
            if($this->model('Admin_model')->changeLibrarian($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' diubah', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' diubah', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/admin_list');
                exit;
            }
        }

        public function search() {
            $data['judul'] = 'Admin Dashboard - Admin List';
            $data['librarian'] = $this->model('Admin_model')->searchLibrarian();
            $this->view('templates/header', $data);
            $this->view('admin/admin_list', $data);
            $this->view('templates/footer');
        }
    }