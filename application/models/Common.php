<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Model {


    public function create_database($databasename) {

        $content = array();
        $content['status'] = 404;
        $content['message'] = $this->data['language']['err_something_went_wrong'];

        $withprifix='practical_'.$databasename;
    
        if (!empty($databasename)) {
            $this->dbforge->create_database($withprifix);
            $content['status'] = 200;
            $content['message'] = sprintf($this->data['language']['succ_rec_updated'], $this->lang->line('database'));
        }
        return $content;
    }

    public function create_table($customdatabase,$post){
        $content = array();
        $content['status'] = 404;
        $content['message'] = $this->data['language']['err_something_went_wrong'];
        
        if ($customdatabase->table_exists($post['table_name'])){ 
            $content['status'] = 404;
            $content['message'] = $this->data['language']['err_something_went_wrong']; 
        } else {
            $fields='';
            foreach ($post['coumn_name'] as $key => $value) {
                $limit='';
                if($post['data_type'][$key]=='VARCHAR' || $post['data_type'][$key]=='CHAR'){
                    $limit='(100)';
                }
                $fields.=' '.'`'.$value.'`'.' '.$post['data_type'][$key].$limit.' NULL,';
            }

            $sql = 'CREATE TABLE '.$post['table_name'].' ('.rtrim($fields,',').')';
            
            $createtbl=$customdatabase->query($sql);
            $this->save_query_in_db($customdatabase,$sql);

            $content['status'] = 200;
            $content['message'] = sprintf($this->data['language']['succ_rec_updated'], 'table');   
        }

        return $content;
        
    }

    function save_query_in_db($customdatabase,$query) {
        $CI = & get_instance();

        
        $filepath = APPPATH . 'logs/'.$customdatabase->database.'-Query-log-' . date('Y-m-d') . '.php'; 
        $handle = fopen($filepath, "a+");                        
        
        $times = $customdatabase->query_times;
        foreach ($customdatabase->queries as $key => $query) 
        { 
            $sql = $query . " \n Execution Time:" . $times[$key]; 

            fwrite($handle, $sql . "\n\n");    
        }

        fclose($handle); 

    }

}
