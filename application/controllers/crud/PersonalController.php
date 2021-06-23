<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonalController extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('logUser')) redirect('login');
		else $this->usr = $this->session->userdata('logUser');
		
    }

    public function edit() {
        try {
            $d = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'tel' => $this->input->post('tel'),
			];

            if($this->input->post('password') != ''){
				$d['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->session->set_userdata('status', 'normal');
			}

			$ed = $this->db->where('id', $this->usr['id'])->update('users',$d);
	
			if($ed){

				$u = $this->session->userdata('logUser');
				$this->session->set_userdata('logUser',[
					'id' => $u['id'],
					'name' => $this->input->post('name'),
					'username' => $this->input->post('username'),
					'level' => $u['level'],
					'timeout' => date('YMdHis')
				]);


				$this->session->set_flashdata('res',[
					'met'=>'primary',
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
		redirect('dashboard');
    }

}
