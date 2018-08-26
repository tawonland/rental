<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenant extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index($id = 0)
    {
        $this->db->where('id1', $id);
        $xcek = $this->db->get('rsite');
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $tema['site'] = $xcek->row();
        $tema['title'] = 'Penyewa';
        $tema['tema'] = 'tenant/index';
        $this->load->view('backend/theme', $tema);
    }
	
	public function data($id = 0)
	{
        $this->db->where('id1', $id);
        $xcek = $this->db->get('rsite');
        if($xcek->num_rows() != 1)
        {
            exit('Data tidak ditemukan');
        }

		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            $this->datatables->select('
                rsite_penyewa.id1 as DT_RowId,  
                rsite_penyewa.operator,
                CONCAT(DATE_FORMAT(rsite_penyewa.leasestart, \'%d-%m-%Y\'), \' to \', DATE_FORMAT(rsite_penyewa.leaseend, \'%d-%m-%Y\')) as leasetime,
                UPPER(rsite_penyewa.status) as status,
                FORMAT(rsite_penyewa.nilai_kontrak, 2, \'de_DE\') as nilai_kontrak,
                rsite_penyewa.masa_sistem_pembayaran,
                rsite_penyewa.id1 as link,
                rsite_penyewa.id1 as aksi
                ');
            $this->datatables->from('rsite_penyewa');
            $this->datatables->join('bouwherr', 'bouwherr.idbouwherr = rsite_penyewa.id_bouwherr');
            $this->datatables->where('id_rsite', $id);
            //$this->datatables->order_by('leaseend', 'DESC');
            
            $this->datatables->add_column('link', '<ul style="margin-left: -15px;"><li><a href="'.base_url('penyewa_amandemen/index/'.$id.'/$1').'">Amandemen</a></li><li><a href="'.base_url('penyewa_subkon/index/'.$id.'/$1').'">Subkon</a></li><li><a href="'.base_url('penyewa_file/index/'.$id.'/$1').'">Binder</a></li><li><a href="'.base_url('penyewa_keuangan/index/'.$id.'/$1').'">Keuangan</a></li></ul>', 'link');
            $this->datatables->add_column('aksi', '<a href="'.base_url('tenant/detail/'.$id.'/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('tenant/edit/'.$id.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('tenant/del/'.$id.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
            echo $this->datatables->generate();
		}
	}
    
    public function add($id = 0)
    {
        $this->db->where('id1', $id);
        $xcek = $this->db->get('rsite');
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();
        
        if($this->validasi())
        {
            
            //load model
            $this->load->model('Status_model');      

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
            
            // start transactions
            $this->db->trans_start();

            $query = $this->db->insert('rsite_penyewa', $kolom);
                
            $insertStatus = $this->Status_model->insertStatus();

            $this->data['data'] = $kolom; 

            $this->set_flashdata($insertStatus['status'], $insertStatus['msg']);

            // jika insert tenant gagal 
            if(!$query)
            {
                redirect('tenant/index/'.$id);
            }

            $idtenant = $this->db->insert_id();

            //jike insert tenant berhasil -> insert invoice
            $kolominvoice = array();
            $kolominvoice['id_rsite_penyewa']   = $idtenant;
            $kolominvoice['tagihan_ke']         = '1';
            $kolominvoice['no_invoice']         = '1';
            $kolominvoice['tgl_invoice']        = date('Y-m-d');
            $kolominvoice['no_po']              = '1';
            $kolominvoice['nilai_invoice']      = $this->input->post('nilai_invoice_pertagihan',TRUE);

            $query = $this->db->insert('rsite_penyewa_keuangan', $kolominvoice);

            if ($this->db->trans_status() === FALSE)
            {
                
                $this->session->set_flashdata('error', 'Tagihan gagal dibuat');

                $this->db->trans_rollback();
                redirect('tenant/index/'.$id);
            }

            //$this->session->set_flashdata('success', 'Tagihan gagal dibuat');
            
            $this->db->trans_commit();
            
            redirect('tenant/index/'.$id);
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

        $tema['c_edit'] = TRUE;
        $tema['url']    = 'tenant/add/'.$id;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Penyewa';
        $tema['tema']   = 'tenant/form';
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
                
                $this->session->set_flashdata('success', 'Data berhasil diubah');
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
        
        $tema['c_edit'] = TRUE;
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
    
    public function detail($idx = 0, $id = 0)
    {
        
        $tema['c_edit'] = FALSE;

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
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Penyewa';
        $tema['tema']   = 'tenant/detail';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($idx = 0, $id = 0)
    {
        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_penyewa');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('tenant/index/'.$idx);
        }
        
        $this->db->where('id_rsite_penyewa', $id);
        $query = $this->db->delete('rsite_penyewa_aman');
        $this->db->where('id_rsite_penyewa', $id);
        $query = $this->db->delete('rsite_penyewa_subkon');
        $this->db->where('id_rsite_penyewa', $id);
        $query = $this->db->delete('rsite_penyewa_file');
        $this->db->where('id_rsite_penyewa', $id);
        $query = $this->db->delete('rsite_penyewa_keuangan');
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite_penyewa');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('tenant/index/'.$idx);
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

        $this->form_validation->set_rules('nospk', 'No. SPK', 'required', $error);
        $this->form_validation->set_rules('tglspk', 'Tgl. SPK', 'required', $error);
        $this->form_validation->set_rules('typeskn', 'Type SPK', 'required', $error);
        $this->form_validation->set_rules('tglrfi', 'Tgl. RFI', 'required', $error);
        $this->form_validation->set_rules('leasestart', 'Lease Start', 'required', $error);
        $this->form_validation->set_rules('leaseend', 'Lease End', 'required', $error);
        $this->form_validation->set_rules('status', 'Status', 'required', $error);
        $this->form_validation->set_rules('masa_sistem_pembayaran', 'Masa Sistem Pembayaran', 'required', $error);
		
        return $this->form_validation->run(); 
	}
}
