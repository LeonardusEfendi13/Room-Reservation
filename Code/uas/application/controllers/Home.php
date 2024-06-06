<?php 
class Home extends CI_Controller { 
    function __construct() { 
        parent::__construct();
        $this->load->model('loadcaptcha');
    } 
    
    public function detailFasilitas() { 
        $id = $this->uri->segment(3); 
        $fasilitas = $this->ModelUser->joinKategoriFasilitas(['fasilitas.id' => $id])->result(); 
        $data['user'] = "Pengunjung"; $data['title'] = "Detail Fasilitas"; 
        foreach ($fasilitas as $fields) { 
            $data['nama'] = $fields->nama_fasilitas;
            $data['penanggung'] = $fields->penanggung_jawab; 
            $data['lokasi'] = $fields->lokasi; 
            $data['kategori'] = $fields->nama_kategori; 
            $data['luas'] = $fields->luas_area; 
            $data['stock'] = $fields->stock; 
            $data['gambar'] = $fields->image; 
            $data['dipakai'] = $fields->dipakai; 
            $data['dibooking'] = $fields->dibooking; 
            $data['kuota'] = $fields->kuota; 
            $data['id'] = $id; 
        }
        $this->load->view('template/header', $data); 
        $this->load->view('fasilitas/detailfasilitas', $data);
        $this->load->view('template/modal', $data);
        $this->load->view('template/footer'); 
    }


    public function index() { 
        $data = [ 
            'judul' => "Katalog Kategori", 
            'fasilitas' => $this->ModelFasilitas->getFasilitas()->result(), 
        ]; 
        
        //jika sudah login dan jika belum login 
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
            $data['user'] = $user['nama']; 
            $this->load->view('template/header', $data); 
            $this->load->view('fasilitas/daftarfasilitas', $data); 
            $this->load->view('template/modal', $data);
            $this->load->view('template/footer', $data); 
        } 
        else { 
            $data['captcha'] = $this->loadcaptcha->generate();
            $data['user'] = 'Pengunjung'; $this->load->view('template/header', $data); 
            $this->load->view('fasilitas/daftarfasilitas', $data); 
            $this->load->view('template/modal', $data);
            $this->load->view('template/footer', $data); 
        } 
    }
}
?>