<?php
    class About extends Controller {
        public function index($nama = 'RanggaIrghi', $pekerjaan = 'Mahasiswa', $umur = 20) {
            $data['judul'] = "About";
            $data['nama'] = $nama;
            $data['pekerjaan'] = $pekerjaan;
            $data['umur'] = $umur;
            $this->view('templates/header', $data);
            $this->view('about/index', $data);
            $this->view('templates/footer');
        }

        public function page() {
            $data['judul'] = "Page";
            $this->view('templates/header', $data);
            $this->view('about/page');
            $this->view('templates/footer');
        }
    }