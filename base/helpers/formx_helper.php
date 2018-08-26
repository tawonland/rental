<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function formx_input($data = '', $value = '', $c_edit = true, $extra = '')
{
    
	$extra = '';

	return form_input($data, $value , $extra);	
}

function formx_email($data = '', $value = '', $c_edit = true, $extra = '')
{
    
	if($c_edit)
	{
		return form_email($data, $value , $extra);
	}
	else
	{
		return $value;
	}
	
}


function formx_hidden($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'type' => 'hidden',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

function formx_dropdown($data = '', $options = array(), $selected = array(), $c_edit = TRUE, $extra = '')
{

	if(empty($extra)){
		$extra = _form_class();
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	return form_dropdown($data, $options, $selected, $extra);
}

function _form_class()
{
	return 'class="form-control input-sm"';
}