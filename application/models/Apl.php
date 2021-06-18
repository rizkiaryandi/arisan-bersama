<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apl extends CI_Model {
    public $name = "Arisan Bersama";
    public $i1 = "Arisan";
    public $i2 = "Bersama";
    
    public function usr(){
        return $this->session->userdata('logUser');
    }

    public function csrf(){
        return form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());
    }

    public function insert($table, $data){
        $this->db->trans_begin();

        $this->db->insert($table, $data);

        if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $this->session->set_flashdata('res', [
					'met'=>'danger',
					'mess'=>'Terjadi kesalahan saat menambah data'
				]);
        }
        else{
                $this->db->trans_commit();
                $this->session->set_flashdata('res',[
					'met'=>'success',
					'mess'=>'Berhasil menambah data'
				]);
        }
    }

    public function price($a) {
 
        if(is_numeric($a)) {
            $fr = 'Rp ' . number_format($a, '2', ',', '.');
            return $fr;
        }
        else {
            return "";
        }
    }
}
