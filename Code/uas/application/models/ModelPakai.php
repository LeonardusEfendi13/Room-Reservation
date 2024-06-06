<?php 
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 
class ModelPakai extends CI_Model { 
    //manip table pinjam 
    public function simpanPakai($data) {
        $this->db->insert('pakai', $data); 
    } 
    
    public function selectData($table, $where) { 
        return $this->db->get($table, $where); 
    } 
    
    public function updateData($data, $where) { 
        $this->db->update('pakai', $data, $where); 
    } 
    
    public function deleteData($tabel, $where) { 
        $this->db->delete($tabel, $where);
    } 
    
    public function joinData() { 
        $this->db->select('*'); 
        $this->db->from('pakai'); 
        $this->db->join('detail_pakai', 'detail_pakai.no_pakai=pakai.no_pakai', 'Right'); 
        return $this->db->get()->result_array();
    } 
    
    public function simpanDetail($idbooking, $nopakai) { 
        $sql = "INSERT INTO detail_pakai (no_pakai,id_fasilitas) SELECT pakai.no_pakai,booking_detail.id_fasilitas FROM pakai, booking_detail WHERE booking_detail.id_booking=$idbooking AND pakai.no_pakai='$nopakai'"; 
        $this->db->query($sql); 
    } 
}


?>