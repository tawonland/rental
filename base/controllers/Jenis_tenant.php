<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_tenant extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
        $tema['title'] = 'Jenis Tenant';
        $tema['tema'] = 'jenis_tenant/index';
        $this->load->view('backend/theme', $tema);
    }
	
	public function data($id = 0)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            $this->datatables->select('
                a.id1 as DT_RowId,  
                UPPER(a.jenis) as jenis,
                b.nama,
                a.id1 as aksi
                ');
            $this->datatables->from('rsite_jns a');
            $this->datatables->join('bouwherr b', 'b.idbouwherr = a.id_bouwher');

            $this->datatables->add_column('aksi', '<a href="'.base_url('jenis_tenant/detail/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('jenis_tenant/edit/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('jenis_tenant/del/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
            echo $this->datatables->generate();
		}
	}
    
    public function add($id = 0)
    {
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_jns');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $query = $this->db->insert('rsite_jns', $kolom);

            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('jenis_tenant/index/'.$id);
            }else{
                $this->load->model('Status_model');          
                $insertStatus = $this->Status_model->insertStatus();
                
                $this->set_flashdata('error', $insertStatus['msg']);
            }
        }

        $fields = $this->db->field_data('rsite_penyewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			if($field->name == 'id_bouwherr') continue;
			if($field->name == 'operator') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}

        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $tema['c_id_bouwher'] = $c_id_bouwher;
        
        $tema['url']    = 'jenis_tenant/add/'.$id;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Jenis Tenant';
        $tema['tema']   = 'jenis_tenant/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function edit($idx = 0, $id = 0)
    {
        $this->db->where('id1', $idx);
        $xcek = $this->db->get('rsite');
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();

        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_penyewa');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('tenant');
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_penyewa');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'operator') {
                    $this->db->select('bouwherr.nama');
                    $this->db->from('bouwherr');
                    $this->db->where('bouwherr.idbouwherr', $this->input->post('id_bouwherr', true));
                    $get = $this->db->get();
                    if($get->num_rows() > 0)
                    {
                        $tmp = $get->row();
                        $tmp = $tmp->nama;
                        $kolom[$field->name] = $tmp;
                    }
                    continue;
                }
                if($field->name == 'id_rsite') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $tmp->id1;
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $id);
            $query = $this->db->update('rsite_penyewa', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('tenant/index/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			//if($field->name == 'id_bouwherr') continue;
			if($field->name == 'operator') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'tenant/edit/'.$idx.'/'.$id;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Penyewa';
        $tema['tema']   = 'tenant/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function bouwherr($jenis = '')
    {
        $this->db->select('bouwherr.idbouwherr, bouwherr.nama');
        $this->db->join('rsite_jns', 'rsite_jns.id_bouwher = bouwherr.idbouwherr');
        $this->db->where('rsite_jns.jenis', $jenis);
        $get = $this->db->get('bouwherr');
        foreach($get->result() as $r)
        {
            echo '<option value="'.$r->idbouwherr.'">'.$r->nama.'</option>';
        }
    }
    
    public function detail($id = 0)
    {

        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_jns');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('jenis_tenant');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_jns');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}

        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $tema['c_id_bouwher'] = $c_id_bouwher;
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Jenis Tenant';
        $tema['tema']   = 'jenis_tenant/detail';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($id = 0)
    {
        
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite_jns');

        //ambil status (pesan) penghapusan data
        $this->load->model('Status_model');          
        $delStatus = $this->Status_model->deleteStatus();
        
        $this->set_flashdata('error', $delStatus['msg']);
        
        redirect($this->router->class);
    }
  
	private function validasi($aneh = false)
	{
		$error = array(
			'required'      => 'Input %s tidak boleh kosong'
		);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required', $error);
        $this->form_validation->set_rules('id_bouwher', 'Bouwherr', 'required', $error);
		
        return $this->form_validation->run(); 
	}
}
