<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login(){
        $this->load->view('authTemp', [
			'title' => 'Login',
			'page' => 'auth/login',
            'data' => []
		]);
    }

    public function loginAction(){
        $userData=$this->db->get_where('users', [
            "username" => $this->input->post('username')
        ])->row();
        if(password_verify($this->input->post('password'), $userData->password)){
            $this->session->set_userdata('logUser',[
                'id' => $userData->id,
                'name' => $userData->name,
                'username' => $userData->username,
                'level' => $userData->role,
                'timeout' => date('YMdHis')
            ]);
                
            $this->session->set_userdata('status', 'normal');
            $this->session->set_flashdata('res',[
                'met'=>'success',
                'mess'=>'Login Sukses'
            ]);
            redirect('dashboard');

        } else{
            
            if($this->input->post('password') == $userData->password){
                $this->session->set_userdata('logUser',[
                    'id' => $userData->id,
                    'name' => $userData->name,
                    'username' => $userData->username,
                    'level' => $userData->role,
                    'tel' => $userData->tel,
                    'timeout' => date('YMdHis')
                ]);
                $this->session->set_userdata('status', 'first');
    
                $this->session->set_flashdata('res',[
                    'met'=>'success',
                    'mess'=>'Login Sukses'
                ]);
                redirect('dashboard');
            } else{
                $this->session->set_flashdata('res',[
                    'met'=>'danger',
                    'mess'=>'Username/Password Salah, Silahkan login ulang'
                ]);
                redirect('login');
            }
        }
    }

    public function register(){
        $this->load->view('authTemp', [
			'title' => 'Login',
			'page' => 'auth/register',
            'data' => []
		]);
    }

    public function registerAction(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $name = $this->input->post('name', TRUE);
        $tel = $this->input->post('tel', TRUE);

        if($this->db->insert('users', [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'name' => $name,
            'tel' => $tel,
        ])){
            $this->session->set_flashdata('res',[
                'met'=>'success',
                'mess'=>'Halo <b>'.$name.'</b>, anda berhasil mendaftar. Silahkan login untuk melanjutkan'
            ]);
        } else{
            $this->session->set_flashdata('res',[
                'met'=>'danger',
                'mess'=>'Pendaftaran gagal, mungkin username sudah terpakai atau lainnya. Silahkan mencoba beberapa saat lagi.'
            ]);
        }

        redirect('login');

    }

    public function logout(){
        $this->session->unset_userdata('logUser');
        redirect('login');
    }

}
