<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionController extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('logUser')) redirect('login');
		else $this->usr = $this->session->userdata('logUser');
    }

    public function add() {
        try {

            $d = [
                "user_id" => $this->usr['id'],
				"arisan_id " => $this->input->post('arisan_id'),
				"payment_amount" => $this->input->post('payment_amount'),
				"label" => $this->input->post('label')
			];
            
            if($_FILES['img']['name']){
				$this->load->library('upload');
				$this->load->library('image_lib');

				$config['upload_path'] = './images/'; //path folder
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
				
				$config['file_name'] = date($this->usr['id'].'Ymdhis');
				$conf['image_library']='gd2';
				$conf['maintain_ratio']= TRUE;
				$conf['quality']= '75%';
			
				$this->upload->initialize($config);

				if ( $this->upload->do_upload('img')){
					$gbr = $this->upload->data();
					$conf['width']= 1280;
					$conf['source_image']='./images/'.$gbr['file_name'];
					$conf['new_image']= './images/'.$gbr['file_name'];

					$this->image_lib->initialize($conf);
					$this->image_lib->resize();
                    
					$d['img'] = $gbr['file_name'];
				}
			}
			$this->apl->insert('transaction',$d);
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat menambah data'
			]);
		}
		redirect('transaction-list', 'refresh');
    }
    
    public function edit($id) {
        try {
			$ra = $this->db->where('id', $this->db->get_where('transaction',[
				'id'=>$id
			])->row()->arisan_id)->where('user_id', $this->usr['id'])->get('arisan');
			if($ra->num_rows() == 0) redirect('arisan-list');

            $d = [
				"status" => "pembayaran_berhasil"
			];

			$store1 = $this->db->where('id', $id)->update('transaction',$d);
	
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
		redirect('manage-transaction/'.$ra->row()->unique_id);
    }
    
    public function delete() {
        try {
			$del = $this->db->where('id', $this->input->get('id'))->where('user_id', $this->usr['id'])->delete('transaction');
	
			if($del){
				$this->session->set_flashdata('res',[
					'met'=>'warning',
					'mess'=>'Transaksi dihapus'
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
		redirect('transaction-list');
    }
}
