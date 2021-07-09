<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class ManageDatabase extends Admin_Controller {

	public $data = array();
	public $dynamicDB = array();


    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

	public function index()
	{
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];
		$this->form_validation->set_rules('db_name', $this->lang->line('database'), 'trim|required|callback_unique_db');
		if ($this->form_validation->run() == FALSE) {
			$content['message'] = validation_errors();
		} else {
			
			$check = $this->common->create_database($this->input->post('db_name'));
			if ($check['status'] == 200) {
				$content = $check;
			}
		}
		echo json_encode($content);
		exit;
	}

	public function FormTable(){
		$this->load->view('header');
		$data['alldatabase'] = $this->dbutil->list_databases();
		$this->load->view('form_table',$data);
	}

	public function ListAllDatabase(){
		$this->load->view('header');
		$data['alldatabase'] = $this->dbutil->list_databases();
		$this->load->view('list_database',$data);
	}

	public function GetAllDatabase(){
		$alldatabase = $this->db->query('SELECT schema_name from infomation_schema');
	}

	public function InsertTable(){
		$content = array();
		$content['status'] = 404;
		$content['message'] = $this->data['language']['err_something_went_wrong'];
		$this->form_validation->set_rules('table_name', 'table', 'trim|required|callback_unique_table');
		if ($this->form_validation->run() == FALSE) {
			$content['message'] = validation_errors();
		} else {
			$customdatabase=$this->ConnectDatabase($this->input->post('db_name'));
			$check = $this->common->create_table($customdatabase,$this->input->post());
			if ($check['status'] == 200) {
				$content = $check;
				$content['databasename']=$this->input->post('db_name');
			}
		}
		echo json_encode($content);
		exit;
	}

	public function listtables($param=''){
		$customdatabase=$this->ConnectDatabase($param);
		$data['tables'] = $customdatabase->list_tables();

		$this->load->view('header');
		$this->load->view('list_table',$data);
	}
}
