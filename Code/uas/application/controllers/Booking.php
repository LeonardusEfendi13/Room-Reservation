<?php 
defined('BASEPATH') or exit('No Direct Script Access Allowed'); 
date_default_timezone_set('Asia/Jakarta'); 
class Booking extends CI_Controller { 
    public function __construct() { 
        parent::__construct();
        $this->load->helper('fasilitas_helper'); 
        cek_login(); 
        $this->load->model(['ModelBooking', 'ModelUser']); 
    } 
    
    public function index() { 
        $id = ['bo.id_user' => $this->uri->segment(3)]; 
        $id_user = $this->session->userdata('id_user'); 
        $data['booking'] = $this->ModelBooking->joinOrder($id)->result(); 
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        foreach ($user as $a) { 
            $data = [ 'image' => $user['image'], 'user' => $user['nama'], 'email' => $user['email'], 'tanggal_input' => $user['tanggal_input'] ]; 
        } 
        $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>'); 
            redirect(base_url()); 
        } 
        else { 
            $data['temp'] = $this->db->query("select image, nama_fasilitas, penanggung_jawab, lokasi, kuota, id_fasilitas from temp where id_user='$id_user'")->result_array(); 
        } 
        $data['judul'] = "Data Booking"; 
        $this->load->view('template/header', $data); 
        $this->load->view('booking/data-booking', $data); 
        $this->load->view('template/modal'); 
        $this->load->view('template/footer'); 
    }
    
    public function tambahBooking() { 
        $id_fasilitas = $this->uri->segment(3);
        $d = $this->db->query("select*from fasilitas where id='$id_fasilitas'")->row(); 
        
        $isi = [ 
            'id_fasilitas' => $id_fasilitas, 
            'nama_fasilitas' => $d->nama_fasilitas, 
            'id_user' => $this->session->userdata('id_user'), 
            'email_user' => $this->session->userdata('email'), 
            'tgl_booking' => date('Y-m-d H:i:s'), 
            'image' => $d->image, 
            'penanggung_jawab' => $d->penanggung_jawab, 
            'lokasi' => $d->lokasi, 
            'kuota' => $d->kuota ]; 
        
        $temp = $this->ModelBooking->getDataWhere('temp', ['id_fasilitas' => $id_fasilitas])->num_rows(); 
        $userid = $this->session->userdata('id_user'); 
        
        $tempuser = $this->db->query("select*from temp where id_user ='$userid'")->num_rows(); 
         
        $databooking = $this->db->query("select*from booking where id_user='$userid'")->num_rows(); 
        if ($databooking > 0) { 
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking fasilitas sebelumnya yang belum diambil.<br> Abmil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>'); 
            redirect(base_url()); 
        } 
         
        if ($temp > 0) { 
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Fasilitas ini Sudah anda booking </div>'); 
            redirect(base_url() . 'home');
        } 
        
        if ($tempuser == 3) { 
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Fasilitas Tidak Boleh Lebih dari 3</div>'); 
            redirect(base_url() . 'home'); 
        } 
        
        $this->ModelBooking->createTemp();
        $this->ModelBooking->insertData('temp', $isi);
        
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Fasilitas berhasil ditambahkan ke Cart </div>'); 
        redirect(base_url() . 'home');
    }

    public function hapusbooking() { 
        $id_fasilitas = $this->uri->segment(3); 
        $id_user = $this->session->userdata('id_user'); 
        $this->ModelBooking->deleteData(['id_fasilitas' => $id_fasilitas], 'temp'); 
        $kosong = $this->db->query("select*from temp where id_user='$id_user'")->num_rows(); 
        if ($kosong < 1) { 
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Fasilitas di Cart</div>'); 
            redirect(base_url()); 
        } 
        else { 
            redirect(base_url() . 'booking'); 
        } 
    }

    public function bookingSelesai($where) { 
        //mengupdate stok dan dibooking di tabel fasilitas saat proses booking diselesaikan 
        $this->db->query("UPDATE fasilitas, temp SET fasilitas.dibooking=fasilitas.dibooking+1, fasilitas.stock=fasilitas.stock-1 WHERE fasilitas.id=temp.id_fasilitas"); 
        $tglsekarang = date('Y-m-d'); 
        $isibooking = [ 'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'), 'tgl_booking' => date('Y-m-d H:m:s'), 'batas_sewa' => date('Y-m-d', strtotime('+2 days', strtotime($tglsekarang))), 'id_user' => $where ]; 
        //menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporary
        $this->ModelBooking->insertData('booking', $isibooking); 
        $this->ModelBooking->simpanDetail($where); 
        $this->ModelBooking->kosongkanData('temp'); redirect(base_url() . 'booking/info'); 
    }

    public function info() {
        $where = $this->session->userdata('id_user'); 
        $data['user'] = $this->session->userdata('nama'); 
        $data['judul'] = "Selesai Booking"; 
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result(); 
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, fasilitas bu where d.id_booking=bo.id_booking and d.id_fasilitas=bu.id and bo.id_user='$where'")->result_array(); 
        $this->load->view('template/header', $data); 
        $this->load->view('booking/info-booking', $data); 
        $this->load->view('template/modal'); 
        $this->load->view('template/footer'); 
    }


}


?>