<?php 
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 
class Pakai extends CI_Controller { 
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper('fasilitas_helper');
        cek_login(); 
        cek_user(); 
    } 
    
    public function index() { 
        $data['judul'] = "Data Penyewaan"; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['pakai'] = $this->ModelPakai->joinData(); 
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data); 
        $this->load->view('admin/topbar', $data); 
        $this->load->view('pakai/data-pakai', $data); 
        $this->load->view('admin/footer');

    } 
    
    public function daftarBooking() { 
        $data['judul'] = "Daftar Booking"; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['pakai'] = $this->db->query("select*from booking")->result_array(); 
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data); 
        $this->load->view('admin/topbar', $data); 
        $this->load->view('booking/daftar-booking', $data); 
        $this->load->view('admin/footer'); 
    }

    public function bookingDetail() { 
        $id_booking = $this->uri->segment(3); 
        $data['judul'] = "Booking Detail"; $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['agt_booking'] = $this->db->query("select*from booking b, user u where b.id_user=u.id and b.id_booking='$id_booking'")->result_array(); 
        $data['detail'] = $this->db->query("select id_fasilitas, nama_fasilitas, penanggung_jawab, lokasi, kuota from booking_detail d, fasilitas b where d.id_fasilitas=b.id and d.id_booking='$id_booking'")->result_array(); 
        $this->load->view('admin/header', $data); 
        $this->load->view('admin/sidebar', $data); 
        $this->load->view('admin/topbar', $data); 
        $this->load->view('booking/booking-detail', $data); 
        $this->load->view('admin/footer'); 
    }

    public function pakaiAct() { 
        $id_booking = $this->uri->segment(3); 
        $lama = $this->input->post('lama', TRUE); 
        $bo = $this->db->query("SELECT*FROM booking WHERE id_booking='$id_booking'")->row(); 
        $tglsekarang = date('Y-m-d'); 
        $no_pakai = $this->ModelBooking->kodeOtomatis('pakai', 'no_pakai'); 
        $databooking = [ 'no_pakai' => $no_pakai, 'id_booking' => $id_booking, 'tgl_pakai' => $tglsekarang, 'id_user' => $bo->id_user, 'tgl_kembali' => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglsekarang))), 'tgl_pengembalian' => '0000-00-00', 'status' => 'Pakai', 'total_denda' => 0 ]; 
        $this->ModelPakai->simpanPakai($databooking); 
        $this->ModelPakai->simpanDetail($id_booking, $no_pakai); 
        $denda = $this->input->post('denda', TRUE); 
        $this->db->query("update detail_pakai set denda='$denda'"); 
        
        $this->ModelPakai->deleteData('booking', ['id_booking' => $id_booking]); 
        $this->ModelPakai->deleteData('booking_detail', ['id_booking' => $id_booking]); 
    
        $this->db->query("UPDATE fasilitas, detail_pakai SET fasilitas.dipakai=fasilitas.dipakai+1, fasilitas.dibooking=fasilitas.dibooking-1 WHERE fasilitas.id=detail_pakai.id_fasilitas"); 
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Pemakaian Berhasil Disimpan</div>'); 
        
        redirect(base_url() . 'pakai'); 
        }

    public function ubahStatus() { 
        $id_fasilitas = $this->uri->segment(3); 
        $no_pakai = $this->uri->segment(4); 
        $where = ['id_fasilitas' => $this->uri->segment(3),]; 
        $tgl = date('Y-m-d'); 
        $status = 'Kembali'; 
         
        $this->db->query("UPDATE pakai, detail_pakai SET pakai.status='$status', pakai.tgl_pengembalian='$tgl' WHERE detail_pakai.id_fasilitas='$id_fasilitas' AND pakai.no_pakai='$no_pakai'"); 
        $this->db->query("UPDATE fasilitas, detail_pakai SET fasilitas.dipakai=fasilitas.dipakai-1, fasilitas.stock=fasilitas.stock+1 WHERE fasilitas.id=detail_pakai.id_fasilitas"); 
        $this->session->set_flashdata('pesan', '<div class="laert alert-message alert-success" role="alert"></div>'); 
        redirect(base_url('pakai')); 
    }

    public function hapusTransaksi()
    {
        $where = ['no_pakai' => $this->uri->segment(3)];
        $this->ModelBooking->hapusTransaksi($where);
        redirect('pakai');
    }

}

?>