<?php

class Admin_Controller extends CI_Controller {

    public $data = array();
    public $dynamicDB;


    function __construct() {
        parent::__construct();
        $this->load->dbutil();
        $this->CI =& get_instance();
        $this->lang->load('message_lang', 'english');
        $this->data['language'] = $this->lang->language;

    }

    //Unique database validation
    public function unique_db() {
        $db_name = 'practical_'.$this->input->post('db_name');
        
        if (empty($db_name))
            $check = $this->dbutil->database_exists($db_name);

        else
            $check = $this->dbutil->database_exists($db_name);

        if ($check > 0) {
            $this->form_validation->set_message("unique_db", "%s already exists");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Unique database validation
    public function unique_table() {
        
        $db_name = $this->input->post('db_name');
        $table_name = $this->input->post('table_name');

        $customdatabase=$this->ConnectDatabase($db_name);
    
        if (empty($db_name))
            $check = $customdatabase->table_exists($table_name);
        else
            $check = $customdatabase->table_exists($table_name);

        if ($check > 0) {
            $this->form_validation->set_message("unique_table", "%s already exists");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ConnectDatabase($dbname){
        $host='localhost';
        $user='root';
        $pass='';
        $dbname=$dbname;
        $port='';

        $this->dynamicDB = array(
         'hostname' => $host,
         'username' => $user,
         'password' => $pass,
         'database' => $dbname,
         'dbdriver' => 'mysqli',
         'dbprefix' => '',
         'pconnect' => FALSE,
         'db_debug' => TRUE,
         'port' => $port
     );
        
        $dynamicDB = $this->load->database($this->dynamicDB, TRUE);
        return $dynamicDB;
    }

    
}
