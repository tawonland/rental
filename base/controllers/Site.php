<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $tema['title'] = 'Site';
        $tema['tema'] = 'site/index';
        $this->load->view('backend/theme', $tema);
    }
	
	public function data()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            $this->datatables->select('
                rsite.id1 as DT_RowId,  
                rsite.siteid,
                rsite.sitename,
                rsite.id1 as tenant,
                rsite.id1 as site_expenses,
                IFNULL(CONCAT(DATE_FORMAT(rsite_sewa.leasestart, \'%d-%m-%Y\'), \' to \', DATE_FORMAT(rsite_sewa.leaseend, \'%d-%m-%Y\')), \'Tambah History\') as rental_history,
                rsite.id1 as aksi
                ');
            $this->datatables->from('rsite');
            $this->datatables->join('rsite_sewa', 'rsite.id1 = rsite_sewa.id_rsite and rsite_sewa.id1 in (select max(id1) from rsite_sewa as a where a.id_rsite = rsite.id1)', 'left');
            
            $this->datatables->add_column('rental_history', '<a href="'.base_url('rental_history/index/$1').'" data-toggle="tooltip" title="Rental Hostory">$2</a>', 'aksi, rental_history');
            $this->datatables->add_column('tenant', '<a href="'.base_url('tenant/index/$1').'" class="label label-info" data-toggle="tooltip" title="Tenant"><i class="fa fa-user"></i> Tenant</a>', 'tenant');
            $this->datatables->add_column('site_expenses', '<a href="'.base_url('site_expenses/index/$1').'" class="label label-info" data-toggle="tooltip" title="Site Expenses"><i class="fa fa-money"></i> Expenses</a>', 'site_expenses');
            $this->datatables->add_column('aksi', '<a href="'.base_url('site/detail/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('site/edit/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('site/del/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
            echo $this->datatables->generate();
		}
	}
    
    public function add()
    {
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $query = $this->db->insert('rsite', $kolom);
            
            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $fields = $this->db->field_data('rsite_sewa');
                $kolom = array();
                foreach ($fields as $field)
                {
                    if($field->name == 'id1') continue;
                    if($field->name == 'id_rsite')
                    {
                        $kolom['id_rsite'] = $idnya;
                        continue;
                    }
                    $kolom[$field->name] = $this->input->post($field->name, true);
                }
                
                $query = $this->db->insert('rsite_sewa', $kolom);
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('site');
            }else{
                $this->session->set_flashdata('error', 'Data gagal ditambah');
            }
        }
        
        $fields = $this->db->field_data('rsite');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        $fields = $this->db->field_data('rsite_sewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'site/add';
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Site';
        $tema['tema']   = 'site/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function edit($id = 0)
    {
        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $id);
            $query = $this->db->update('rsite', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('site');
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'site/edit/'.$id;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Site';
        $tema['tema']   = 'site/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function detail($id = 0)
    {
        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite');
		foreach ($fields as $field)
		{
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Site';
        $tema['tema']   = 'site/detail';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($id = 0)
    {

        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $this->db->where('id_rsite', $id);
        $query = $this->db->delete('rsite_sewa');
        
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite');

        //ambil status (pesan) penghapusan data
        $this->load->model('Status_model');          
        $delStatus = $this->Status_model->deleteStatus();
        
        $this->set_flashdata('error', $delStatus['msg']);
        
        redirect('site');
    }
  
	private function validasi($aneh = false)
	{
		$error = array(
			'required'      => 'Input %s tidak boleh kosong',
			'alpha_numeric' => 'Input %s harus berupa huruf dan/atau angka',
			'alpha_numeric_spaces' => 'Input %s harus berupa huruf, angka dan/atau spasi',
			'min_length'    => 'Panjang %s harus lebih dari sama dengan %s karakter',
			'valid_email'   => 'Input %s harus berupa email yang valid',
			'decimal'   => 'Input %s harus berupa bilangan desimal',
		);

        $this->form_validation->set_rules('siteid', 'Site ID', 'required', $error);
        $this->form_validation->set_rules('sitename', 'Site Name', 'required', $error);
        $this->form_validation->set_rules('longitude', 'Longitude', 'required', $error);
        $this->form_validation->set_rules('latitude', 'Latitude', 'required', $error);
        $this->form_validation->set_rules('buidingheight', 'Building Height', 'required', $error);
        $this->form_validation->set_rules('towerheight', 'Tower Height', 'required', $error);
        $this->form_validation->set_rules('availabletowerspace', 'Available Tower Space', 'required', $error);
        $this->form_validation->set_rules('availablegroundspace', 'Available Ground Space', 'required', $error);
		
        return $this->form_validation->run();
	}
}
