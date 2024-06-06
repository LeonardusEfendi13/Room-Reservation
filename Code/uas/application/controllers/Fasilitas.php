<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Fasilitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('fasilitas_helper');
        cek_login();
        cek_user();
    }

    public function kategori()
    {
        $data['judul'] = 'Kategori Fasilitas';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori']=$this->ModelFasilitas->getKategori()->result_array();
        $this->form_validation->set_rules('nama_kategori','Kategori','required',['required'=>'Nama Kategori harus diisi']);
        if ($this->form_validation->run()==false)
        {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('fasilitas/kategori', $data);
            $this->load->view('admin/footer');
        }
        else
        {
            $data=['nama_kategori'=>$this->input->post('nama_kategori')];
            $this->ModelFasilitas->simpanKategori($data);
            redirect('fasilitas/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id_kategori' => $this->uri->segment(3)];
        $this->ModelFasilitas->hapusKategori($where);
        redirect('fasilitas/kategori');
    }

    public function updateKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelFasilitas->kategoriWhere(['id_kategori' => $this->uri->segment(3)])->result_array();
 
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);
 
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('fasilitas/ubah_kategori', $data);
            $this->load->view('admin/footer');
        } else {
 
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori', true)
            ];
 
            $this->ModelFasilitas->updateKategori(['id_kategori' => $this->input->post('id_kategori')], $data);
            redirect('fasilitas/kategori');
        }
    }


    public function hapusFasilitas() { 
        $where = ['id' => $this->uri->segment(3)]; 
        $this->ModelFasilitas->hapusFasilitas($where); 
        redirect('fasilitas'); 
    }

    public function ubahFasilitas()
    {
        $data['judul'] = 'Ubah Data Fasilitas';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['fasilitas'] = $this->ModelFasilitas->fasilitasWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelFasilitas->joinKategoriFasilitas(['fasilitas.id_kategori' => $this->uri->segment(3)])->result_array();
        $data['kategori'] = $this->ModelFasilitas->getKategori()->result_array();
 
        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|min_length[3]', [
            'required' => 'Nama Fasilitas harus diisi',
            'min_length' => 'Nama Fasilitas terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama harus diisi',
        ]);
        $this->form_validation->set_rules('penanggung_jawab', 'Nama Penanggung Jawab', 'required|min_length[3]', [
            'required' => 'Nama penanggung jawab harus diisi',
            'min_length' => 'Nama terlalu pendek'
        ]);
        $this->form_validation->set_rules('lokasi', 'Nama Lokasi', 'required|min_length[3]', [
            'required' => 'Lokasi harus diisi',
            'min_length' => 'Nama lokasi terlalu pendek'
        ]);
        $this->form_validation->set_rules('luas_area', 'Luas Area', 'required|min_length[3]', [
            'required' => 'Luas area harus diisi',
            'min_length' => 'Nama luas area terlalu pendek'
        ]);
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric', [
            'required' => 'Stock harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('kuota', 'Kuota', 'required|min_length[3]', [
            'required' => 'Kuota harus diisi',
            'min_length' => 'Nama kuota terlalu pendek'
        ]);
 
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = 'img' . time();
 
        //memuat atau memanggil library upload
        $this->load->library('upload', $config);
 
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data); 
            $this->load->view('admin/sidebar', $data); 
            $this->load->view('admin/topbar', $data); 
            $this->load->view('fasilitas/ubah_fasilitas', $data); 
            $this->load->view('admin/footer'); 
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }
 
            $data = [
                'nama_fasilitas' => $this->input->post('nama_fasilitas', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'penanggung_jawab' => $this->input->post('penanggung_jawab', true),
                'lokasi' => $this->input->post('lokasi', true),
                'luas_area' => $this->input->post('luas_area', true),
                'stock' => $this->input->post('stock', true),
                'kuota' => $this->input->post('kuota', true),
                'image' => $gambar
            ];
 
            $this->ModelFasilitas->updateFasilitas($data, ['id' => $this->input->post('id')]);
            redirect('fasilitas');
        }
    }


    public function index()
    {
        $data['judul'] = 'Data Fasilitas'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['fasilitas'] = $this->ModelFasilitas->getFasilitas()->result_array(); 
        $data['kategori'] = $this->ModelFasilitas->getKategori()->result_array();
        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|min_length[3]', [ 'required' => 'Nama Fasilitas harus diisi', 'min_length' => 'Nama Fasilitas terlalu pendek' ]); 
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [ 'required' => 'Nama penanggung jawab harus diisi', ]); 
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|min_length[3]', [ 'required' => 'Nama penanggung jawab harus diisi', 'min_length' => 'Nama penanggung jawab terlalu pendek' ]); 
        $this->form_validation->set_rules('lokasi', 'Tempat Lokasi', 'required|min_length[3]', [ 'required' => 'Nama lokasi harus diisi', 'min_length' => 'Nama lokasi terlalu pendek' ]); 
        $this->form_validation->set_rules('luas_area', 'Luas Area', 'required|min_length[3]', [ 'required' => 'Luas Area harus diisi', 'min_length' => 'Luas Area terlalu pendek' ]); 
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric', [ 'required' => 'Stock harus diisi', 'numeric' => 'Yang anda masukan bukan angka' ]);
        $this->form_validation->set_rules('kuota', 'Kuota', 'required|min_length[3]', [ 'required' => 'Kuota harus diisi', 'min_length' => 'Kuota terlalu pendek' ]); 
         
        //konfigurasi sebelum gambar diupload 
        $config['upload_path'] = './assets/img/upload/'; 
        $config['allowed_types'] = 'jpg|png|jpeg'; 
        $config['max_size'] = '3000'; 
        $config['max_width'] = '3000'; 
        $config['max_height'] = '3000'; 
        $config['file_name'] = 'img' . time(); 
        $this->load->library('upload', $config); 
        if ($this->form_validation->run() == false) { 
            $this->load->view('admin/header', $data); 
            $this->load->view('admin/sidebar', $data); 
            $this->load->view('admin/topbar', $data); 
            $this->load->view('fasilitas/index', $data); 
            $this->load->view('admin/footer'); 
        } 
        else { 
            if ($this->upload->do_upload('image')) { 
                $image = $this->upload->data(); 
                $gambar = $image['file_name']; 
            } 
            else { 
                $gambar = ''; 
            } 
            $data = [ 
                'nama_fasilitas' => $this->input->post('nama_fasilitas', true), 
                'id_kategori' => $this->input->post('id_kategori', true), 
                'penanggung_jawab' => $this->input->post('penanggung_jawab', true), 
                'lokasi' => $this->input->post('lokasi', true), 
                'luas_area' => $this->input->post('luas_area', true), 
                'stock' => $this->input->post('stock', true), 
                'kuota' => $this->input->post('kuota', true), 
                'dipakai' => 0, 
                'dibooking' => 0, 
                'image' => $gambar 
            ]; 
            $this->ModelFasilitas->simpanFasilitas($data); 
            redirect('fasilitas'); 
        } 
    } 
}

?>