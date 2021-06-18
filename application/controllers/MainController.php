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

	public function participant($unique_id){
		$ars = $this->db
				->select('arisan.*, users.name, users.tel')
				->from('users')
				->join('arisan', 'arisan.user_id = users.id')
				->where('arisan.unique_id', $unique_id)
				->get();
		
		if($ars->num_rows() != 1){
			$this->session->set_flashdata('res', [
				'met'=>'warning',
				'mess'=>'<b>ID Salah</b>, Arisan yang anda maksud tidak ditemukan'
			]);
			redirect('followed-arisan');
		}

		$data['art'] = $ars->row();
		$trk = $this->db
					->select('order_participant.*, users.name, users.tel')
					->from('users')
					->join('order_participant', 'order_participant.user_id = users.id')
					->where('order_participant.arisan_id', $ars->row()->id)
					->order_by('order_participant.number', 'asc')->get();
		$data['participant'] = $trk->result();
		$data['numpa'] = true;
		if($trk->num_rows() > 0){
			if($trk->result()[0]->number > 0) $data['numpa'] = false;
		}
		$this->load->view('dashboardTemp', [
			'title' => 'Anggota Arisan',
			'page' => 'dashboard/participant/index',
            'data' => $data
		]);
	}

	public function followedArisan(){
		$data['arisan'] = $this->db
						->select('arisan.*, order_participant.status, order_participant.number')
						->from('order_participant')
						->join('arisan', 'arisan.id = order_participant.arisan_id')
						->where('order_participant.user_id', $this->usr['id'])
						->order_by('order_participant.created_at', 'desc')
						->get()->result();
		$this->load->view('dashboardTemp', [
			'title' => 'Arisan',
			'page' => 'dashboard/arisan/followed',
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
		$data['transaction'] = $this->db
								->select('transaction.id, arisan.title, arisan.unique_id, arisan.nominal')
								->from('arisan')
								->join('transaction', 'transaction.arisan_id = arisan.id')
								->where('transaction.user_id', $this->usr['id'])->get()->result();
		$this->load->view('dashboardTemp', [
			'title' => 'List Pembayaran',
			'page' => 'dashboard/transaction/index',
            'data' => $data
		]);
	}

	public function addTransaction(){
		$data['arisanJoin'] = $this->db
								->select('order_participant.id, arisan.title, arisan.unique_id, arisan.nominal')
								->from('arisan')
								->join('order_participant', 'order_participant.arisan_id = arisan.id')
								->where('order_participant.user_id', $this->usr['id'])
								->where('order_participant.status != "belum_terkonfirmasi"')->get()->result();
		$this->load->view('dashboardTemp', [
			'title' => 'Tambah Pembayaran',
			'page' => 'dashboard/transaction/add',
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