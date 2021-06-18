<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();

		if(!$this->session->userdata('logUser')) redirect('login');
		else $this->usr = $this->session->userdata('logUser');
        
    }

	public function index(){
		redirect('dashboard', 'refresh');
	}

	public function dashboard(){
		$arsc = $this->db->select('id')->where('user_id', $this->usr['id'])->get('arisan');
		$ars = $arsc->result();
		
		$data['tArs'] = $this->db->select('count("id") as total')->where('user_id', $this->usr['id'])->get('arisan')->row()->total;
		$data['tFArs'] = $this->db->select('count("id") as total')->where('user_id', $this->usr['id'])->get('order_participant')->row()->total;
		$data['tPrt'] = $this->db->select('SUM("income") as total')->where('user_id', $this->usr['id'])->get('order_participant')->row()->total;
		$data['tTr'] = $this->db->select('SUM("payment_amount") as total')->where('user_id', $this->usr['id'])->get('transaction')->row()->total;

		if(!$data['tPrt']) $data['tPrt'] = 0;
		if(!$data['tTr']) $data['tTr'] = 0;

		$this->load->view('dashboardTemp', [
			'title' => 'Dashboard',
			'page' => 'dashboard/index',
            'data' => $data
		]);
	}

    public function personal(){
		$data['pr'] = $this->db->where('id', $this->usr['id'])->get('users')->row();
		$this->load->view('dashboardTemp', [
			'title' => 'Edit Data Pribadi',
			'page' => 'dashboard/personal/index',
            'data' => $data
		]);
	}
	
    public function arisan(){
		$data['arisan'] = $this->db->where('user_id', $this->usr['id'])->order_by('created_at', 'desc')->get('arisan')->result();
		$this->load->view('dashboardTemp', [
			'title' => 'Arisan',
			'page' => 'dashboard/arisan/index',
            'data' => $data
		]);
	}
	
    public function addArisan(){
		$this->load->view('dashboardTemp', [
			'title' => 'Tambah Arisan',
			'page' => 'dashboard/arisan/add',
            'data' => []
		]);
	}

	
    public function editArisan(){

		$data['ar'] = $this->db->get_where('arisan',[
			'id' => $this->input->get('id'),
			'user_id' => $this->usr['id']
		])->row();
		$this->load->view('dashboardTemp', [
			'title' => 'Edit Arisan',
			'page' => 'dashboard/arisan/edit',
            'data' => $data
		]);
	}

	
    public function transaction(){
		$data['ars'] = $this->db->where('id', $this->usr['id'])->get('arisan')->result();
		$this->load->view('dashboardTemp', [
			'title' => 'List Pembayaran',
			'page' => 'dashboard/transaction/index',
            'data' => $data
		]);
	}


	public function join($i = ""){
		$data['ars'] = $this->db->where('unique_id', $i)->get('arisan')->row();
		$data['arsid'] = $i;
		$this->load->view('dashboardTemp', [
			'title' => 'Join Arisan',
			'page' => 'dashboard/arisan/join',
            'data' => $data
		]);
	}
}