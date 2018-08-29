<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function formx_input($data = '', $value = '', $c_edit = true, $extra = '')
{
    
	if(empty($extra)){
		$extra = 'class="'._form_class().'"';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	return form_input($data, $value , $extra);	
}

function formx_inputdate($data = '', $value = '', $c_edit = true, $extra = '')
{
    
	if(empty($extra)){
		$extra = 'class="'._form_class().'"';
		$extra .= 'autocomplete = "off" ';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	if(!$c_edit){
		$value = tgl_indo($value);
	}

	if(!$c_edit){
		return form_input($data, $value , $extra);
	}

	$form = '<div class="input-group">';
	$form .= form_input($data, $value , $extra);
	$form .= '<span class="input-group-btn">
                <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>';
	$form .= '</div>';

	return 	$form;
}

function formx_email($data = '', $value = '', $c_edit = TRUE, $extra = '')
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

function formx_number($data = '', $value = '', $c_edit = TRUE, $extra = '')
{
    
	if(empty($extra)){
		$extra = 'class="'._form_class().'"';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	$defaults = array(
		'type' => 'number',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
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
		$extra = 'class="'._form_class().'"';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	return form_dropdown($data, $options, $selected, $extra);
}

function formx_checkbox($data = '', $value = '', $checked = FALSE, $c_edit = TRUE, $extra = '')
{
	$extra = 'class="minimal"';
	return form_checkbox($data, $value, $checked, $extra);
}

function _form_class()
{
	return 'form-control';
}