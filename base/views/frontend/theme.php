<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('frontend/'.$tema);

if(ENVIRONMENT == 'development'){

  $enable_profiler = $this->output->enable_profiler(TRUE);

  $array = json_decode(json_encode($enable_profiler), True);

  unset($final_output);
}
?>