<?php
    class Admin extends Controller {
        public function index() {
            $data['judul'] = 'Admin Dashboard';
            $this->view('templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('templates/footer');
        }

        public function borrowed_list() {
            $data['judul'] = "Admin Dashboard - Borrowed List";
            $data['peminjaman'] = $this->model('Borrowed_model')->getAllBorrowed();
            $data['dueDate'] = $this->model('Borrowed_model')->getAllDue();
            $data['books'] = $this->model('Book_model')->getAllBook();
            $data['user'] = $this->model('User_model')->getAllUser();
            $this->view('templates/header', $data);
            $this->view('admin/borrowed_list', $data);
            $this->view('templates/footer');
        }

        public function returnedBook() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                header('Content-Type: application/json'); // Set header JSON
        
                $id = $_POST['id'] ?? null;
                if (!$id) {
                    echo json_encode(['success' => false, 'message' => 'ID tidak diterima']);
                    return;
                }
        
                $model = $this->model('Borrowed_model');
                $borrowed = $model->getBorrowedById($id);
        
                if (!$borrowed) {
                    echo json_encode(['success' => false, 'message' => 'Data peminjaman tidak ditemukan']);
                    return;
                }
        
                // Pindahkan ke tabel pengembalian
                if ($this->model('Returned_model')->returnedBook($borrowed) > 0) {
                    // Update stok buku
                    $this->model('Book_model')->updateBookStock($borrowed['kode_buku']);
        
                    // Hapus dari tabel peminjaman
                    $model->deleteBorrowed($id);
        
                    echo json_encode(['success' => true, 'message' => 'Buku berhasil dikembalikan']);
                    return;
                }
            }
        
            echo json_encode(['success' => false, 'message' => 'Gagal mengembalikan buku']);
        }
        

        public function returned_list() {
            $data['judul'] = "Admin Dashboard - Returned List";
            $data['pengembalian'] = $this->model('Returned_model')->getAllReturned();
            $this->view('templates/header', $data);
            $this->view('admin/returned_list', $data);
            $this->view('templates/footer');
        }

        public function add_new() {
            if($this->model('Borrowed_model')->addCatalog($_POST) > 0) {
                Flasher::setFlash(' berhasil', ' ditambahkan', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/borrowed_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' ditambahkan', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/borrowed_list');
                exit;
            }
        }

        public function delete_borrowed($id) {
            if($this->model('Borrowed_model')->deleteDataBorrow($id) > 0) {
                Flasher::setFlash(' berhasil', ' dihapus', 'bg-green-400');
                header('Location: ' . BASE_URL . '/admin/borrowed_list');
                exit;
            } else {
                Flasher::setFlash(' gagal', ' dihapus', 'bg-red-400');
                header('Location: ' . BASE_URL . '/admin/borrowed_list');
                exit;
            }
        }

        public function getBorrow() {
            echo json_encode($this->model('Borrowed_model')->getBorrowedByID($_POST['id']));
        }

        public function searchBorrowed() {
            $data['judul'] = 'Admin Dashboard - Catalog List';
            $data['peminjaman'] = $this->model('Borrowed_model')->searchBorrowed();
            $this->view('templates/header', $data);
            $this->view('admin/borrowed_list', $data);
            $this->view('templates/footer');
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