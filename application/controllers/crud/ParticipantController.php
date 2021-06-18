<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParticipantController extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('logUser')) redirect('login');
		else $this->usr = $this->session->userdata('logUser');
    }

    public function add() {
        try {
            $uk = $this->input->post('unique_id');
            
            $getId = $this->db->where('unique_id', $uk)->where('status','join_dibuka')->get('arisan');

            if($getId->num_rows() > 0){
                $d = [
                    "user_id" => $this->usr['id'],
                    "arisan_id" => $getId->row()->id
                ];
                if($this->db->get_where('order_participant', $d)->num_rows() == 0){

                    $this->apl->insert('order_participant',$d);

                    $this->session->set_flashdata('res', [
                        'met'=>'success',
                        'mess'=>'<b>Berhasil Join</b>, mohon menunggu sampai pembuat arisan mengkonfirmasi kamu'
                    ]);
                } else{
                    $this->session->set_flashdata('res', [
                        'met'=>'danger',
                        'mess'=>'Kamu sudah menjadi anggota sebelumnya'
                    ]);
                }
            } else{
                $this->session->set_flashdata('res', [
                    'met'=>'danger',
                    'mess'=>'ID Salah atau Join sudah ditutup'
                ]);
            }
            

            
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat menambah data'
			]);
		}
		redirect('followed-arisan', 'refresh');
    }

	public function status($up="belum_menang", $id){
		$ar = $this->db->get_where('arisan',[
			'id' => $this->db->get_where('order_participant',[
				'id' => $id
			])->row()->arisan_id,
			'user_id' => $this->usr['id']
		]);
		
		if($ar->num_rows() != 1){
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Tindakan Berbahaya'
			]);
			redirect('dashboard');
		}
		try {

            if($up == "tolak"){
				$this->db->where('id', $id)->delete('order_participant');
			} else{
				$d = [
					"status" => $up
				];
	
				$store1 = $this->db->where('id', $id)->update('order_participant',$d);
		
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
			}
		} catch (\Exception $th) {
			$this->session->set_flashdata('res', [
				'met'=>'danger',
				'mess'=>'Terjadi kesalahan saat mengedit data'
			]);
		}
		redirect('participant-list/'.$ar->row()->unique_id);
	}

	public function shake($id){
		$ar = $this->db->get_where('arisan',[
			'id' => $id,
			'user_id' => $this->usr['id']
		]);

		if($ar->num_rows() > 0){
			try {
				$nom = (int) $ar->row()->nominal;
				$this->db
					->where('arisan_id', $id)
					->where('status != "belum_menang"')
					->delete('order_participant');
	
				$t = $this->db				->where('arisan_id', $id)
					->where('status','belum_menang')
					->get('order_participant');
				$q = $t->result();
	
				$income = $nom * $t->num_rows();
				$arg=[];
	
				for($i=1; $i<=$t->num_rows(); $i++){
					array_push($arg, $i);
				}
	
				shuffle($arg);
				for($i=0; $i<$t->num_rows(); $i++){
					$this->db->where('id', $q[$i]->id)->update('order_participant', [
						'number' => $arg[$i],
						'income' => $income
					]);
				}

				$this->db->where('id', $id)->update('arisan',[
					'status' => 'sedang_berlangsung'
				]);
	
			} catch (\Exception $th) {
				$this->session->set_flashdata('res', [
					'met'=>'danger',
					'mess'=>'Terjadi kesalahan saat mengedit data'
				]);
			}
		}
		
		redirect('participant-list/'.$ar->row()->unique_id);
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
