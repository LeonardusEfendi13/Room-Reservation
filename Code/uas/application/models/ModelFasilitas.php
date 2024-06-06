<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModelFasilitas extends CI_Model {

    //Manajemen Fasilitas
    public function getFasilitas() {
        return $this->db->get('fasilitas');
    }

    public function fasilitasWhere($where) {
        return $this->db->get_where('fasilitas', $where);
    }

    public function simpanFasilitas($data = null) {
        $this->db->insert('fasilitas', $data);
    }

    public function updateFasilitas($data = null, $where = null) {
        $this->db->update('fasilitas', $data, $where);
    }

    public function hapusFasilitas($where = null) {
        $this->db->delete('fasilitas', $where);
    }

    public function total($field, $where) {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('fasilitas');
        return $this->db->get('kategori');
    }

    //Manajemen kategori
    public function getKategori() {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where) {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null) {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null) {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null) {
        $this->db->update('kategori', $data, $where);
    }
    //Join
    public function joinKategoriFasilitas($where) { $this->db->select('fasilitas.id_kategori, kategori.id_kategori');
        $this->db->from('fasilitas'); $this->db->join('kategori','kategori.id_kategori = fasilitas.id_kategori');
        $this->db->where($where); return $this->db->get();
    }

    public function getLimitFasilitas() { 
        $this->db->limit(5); 
        return $this->db->get('fasilitas'); 
    }
    
}
?>