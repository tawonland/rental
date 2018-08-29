<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_invoice extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->data['title'] = 'Notifikasi Invoice';
        $this->data['subbreadcrumb'] = array('Notifikasi Invoice');
        $this->data['content'] = 'backend/'.$this->router->class.'/index';
        
        $this->data['noteInfo'] = 'Data '.$this->data['title'] . ' Yang Belum Dicetak';

        $this->load->view('backend/theme', $this->data);
    }
	
	public function data($id = 0)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            $this->datatables->select('
                a.id1 as DT_RowId, 
                CONCAT(\'<strong>ID:</strong> \', a.siteid, \'<br><strong>\', a.sitename, \'</strong>\') as site,
                a.operator,
                a.masa_sistem_pembayaran,
                a.periode_tagihan,
                a.tagihan_ke,
                a.no_invoice,
                DATE_FORMAT(a.tgl_invoice, \'%d-%m-%Y\') as tgl_invoice,
                FORMAT(a.nilai_invoice, \'de_DE\') as nilai_invoice,
                a.id1 as aksi
                ');
            $this->datatables->from('v_rsite_invoice_blm_cetak a');

            //$this->datatables->add_column('aksi', '<a href="'.base_url('jenis_tenant/detail/$1').'" class="label label-info" data-toggle="tooltip" title="Detail">', 'aksi');
            
            echo $this->datatables->generate();
		}
	}
    
    public function add($id = 0)
    {
        $this->data['c_edit'] = TRUE;
        //load model        
        $this->load->model('Rsite_jenis_model');
        
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
                
                $this->session->set_flashdata('success', 'Data berhasil ditambah');
                redirect('jenis_tenant/index/'.$id);
            }else{

                $this->load->model('Status_model');          
                $insertStatus = $this->Status_model->insertStatus();

                $this->data['data'] = $kolom; 

                $this->set_flashdata('error', $insertStatus['msg']);
            }
        }

        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $this->data['c_rsite_jenis']  = $this->Rsite_jenis_model->c_rsite_jenis();
        $this->data['c_id_bouwher']   = $c_id_bouwher;
        $this->data['tombol'] = 'Tambah';
        $this->data['title']  = 'Tambah Jenis Tenant';
        
        $this->data['captionSubject']  = 'Data Jenis Tenant';
        $this->data['form_action'] = base_url('jenis_tenant/add');
        $this->data['form_data']  = 'backend/jenis_tenant/form';
        $this->data['content']    = 'backend/inc_form_v';

        $this->load->view('backend/theme', $this->data);
    }
    
    public function edit($id = 0)
    {
        $this->data['c_edit'] = TRUE;
        //load model        
        $this->load->model('Rsite_jenis_model');

        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_jns');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('jenis_tenant');
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_jns');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $id);
            $query = $this->db->update('rsite_jns', $kolom);
            
            if($query)
            {
                $idnya = $id;
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('jenis_tenant/detail/'.$id);
            }else{
                $this->load->model('Status_model');          
                $insertStatus = $this->Status_model->updateStatus();
                
                $this->data['data'] = $kolom; 

                $this->set_flashdata('error', $insertStatus['msg']);
            }
        }
        
        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_jns');
        foreach ($fields as $field)
        {
            if($field->name == 'id1') continue;
            $this->data['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
        }

        $this->data['c_rsite_jenis']  = $this->Rsite_jenis_model->c_rsite_jenis();
        $this->data['c_id_bouwher'] = $c_id_bouwher;
        $this->data['action'] = base_url('jenis_tenant/edit/'.$id);
        $this->data['tombol'] = 'Edit';
        $this->data['title']  = 'Edit Jenis Tenant';
        
        $this->data['captionSubject']   = $this->data['title'];
        $this->data['form_action']      = base_url('jenis_tenant/add');
        $this->data['form_data']        = 'backend/jenis_tenant/form';
        $this->data['content']          = 'backend/inc_form_v';

        $this->load->view('backend/theme', $this->data);
    }
        
    public function detail($id = 0)
    {
        //load model        
        $this->load->model('Rsite_jenis_model');

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
            $this->data['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}

        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $this->data['c_rsite_jenis']  = $this->Rsite_jenis_model->c_rsite_jenis();
        $this->data['c_id_bouwher'] = $c_id_bouwher;
        $this->data['tombol'] = 'Detail';
        $this->data['title']  = 'Detail Jenis Tenant';

        $this->data['captionSubject']   = $this->data['title'];
        $this->data['form_action']      = base_url('jenis_tenant/add');
        $this->data['form_data']        = 'backend/jenis_tenant/form';
        $this->data['content']          = 'backend/inc_form_v';

        $this->load->view('backend/theme', $this->data);
    }
    
    public function del($id = 0)
    {
        
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite_jns');

        //ambil status (pesan) penghapusan data
        $this->load->model('Status_model');          
        $delStatus = $this->Status_model->deleteStatus();
        
        $this->set_flashdata($delStatus['status'], $delStatus['msg']);
        
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
