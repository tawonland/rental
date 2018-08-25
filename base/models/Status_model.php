<?php
class Status_model extends Dany_Model {

    /**
     * Status delete
     * @return string
     */
    function insertStatus() {

        $err = $this->db->error();
        $errCode = $err['code'];
        $msg = $this->getErrorMessage($errCode, 'insert');
        
        if ($err['code'] == '1062') {                
                $msg .= ', karena data tersebut sudah ada';    
        }
        else{
            $msg .= ', ' . $err['message'];
        }

        return array('error' => $err, 'msg' => $msg);
    }

	/**
     * Status delete
     * @return string
     */
	function deleteStatus() {

        $err = $this->db->error();
        $errCode = $err['code'];
        $msg = $this->getErrorMessage($errCode, 'delete');

        if ($err['code'] == '1451') {
                $CI =& get_instance();
                $CI->load->model('Label_table_model');

                $errmsg = $err['message'];
                $table = $this->getReferencedTable($errmsg);
                $labelname = $CI->Label_table_model->getlabel($table);
                
                $msg .= ', karena masih memiliki data ' . (!empty($table) ? '<strong>' . (empty($labelname) ? $label : $labelname)  . '</strong>' : '');    
        }


        return array('error' => $err, 'msg' => $msg);
    }

     /**
     * mencari table yang berreferensi berdasarkan pesan error
     * @param object $msg
     * @return string
     */
    function getReferencedTable($msg) {
        $str = $this->getStringBetween($msg,'a foreign key constraint fails (',', CONSTRAINT');
        
        $a_str = explode('.', $str);

        $table = substr(end($a_str), 1,-1);

        return $table;
    }

    function getStringBetween($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

}