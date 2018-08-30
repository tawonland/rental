<?php
class Rsite_model extends App_Model {

    function arr_site_available_for_colo()
    {
        $variable = array('Available', 'Not Available', 'Full');

        $data = array();
        foreach ($variable as $key => $value) {
        	$data[$value] = $value;
        }

        return $data;
    }

}