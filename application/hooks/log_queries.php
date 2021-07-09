<?php
function logQueries() 
    {
        $CI = & get_instance();
        print_r($CI);exit();
        $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d') . '.php'; 
        $handle = fopen($filepath, "a+");                        

        $times = $CI->db->query_times;
        foreach ($CI->db->queries as $key => $query) 
        { 
            $sql = $query . " \n Execution Time:" . $times[$key]; 

            fwrite($handle, $sql . "\n\n");    
        }

        fclose($handle);  
    }
?>