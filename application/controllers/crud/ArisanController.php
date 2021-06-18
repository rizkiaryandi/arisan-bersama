<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArisanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('logUser')) redirect('login');
		else $this->usr = $this->session->userdata('logUser');
    }

    public function add() {
        try {

            $d = [
                "user_id" => $this->usr['id'],
                "unique_id" => $this->usr['id'].date('H').'-'.date('is'),
				"title" => $this->input->post('title'),
				"description" => $this->input->post('description'),
				"time_start" => $this->input->post('time_start'),
				"nominal" => $this->input->post('nominal'),
				"period" => $this->input->post('period'),
				"long_time" => $this->input->post('long_time')
			];
			$this->apl->insert('arisan',$d);
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat menambah data'
			]);
		}
		redirect('arisan-list', 'refresh');
    }
    
    public function edit() {
        try {

            $d = [
				"title" => $this->input->post('title'),
				"description" => $this->input->post('description'),
				"time_start" => $this->input->post('time_start'),
				"period" => $this->input->post('period'),
				"nominal" => $this->input->post('nominal'),
				"long_time" => $this->input->post('long_time')
			];

			$store1 = $this->db->where('id', $this->input->post('id'))->where('user_id', $this->usr['id'])->update('arisan',$d);
	
			if($store1){
				$this->session->set_flashdata('res',[
					'met'=>'success',
					'mess'=>'Berhasil mengedit data'
				]);
			} else{
				$this->session->set_flashdata('res', [
					'met'=>'danger',
					'mess'=>'Terjadi kesalahan saat mengedit data'
				]);
			}
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat mengedit data'
			]);
		}
		redirect('arisan-list');
    }
    
    public function delete() {
        try {
			$del = $this->db->where('id', $this->input->get('id'))->where('user_id', $this->usr['id'])->delete('arisan');
	
			if($del){
				$this->session->set_flashdata('res',[
					'met'=>'warning',
					'mess'=>'Arisan dihapus'
				]);
			} else{
				$this->session->set_flashdata('res', [
					'met'=>'danger',
					'mess'=>'Terjadi kesalahan saat menghapus data'
				]);
			}
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat menghapus data'
			]);
		}
		redirect('arisan-list');
    }
}
