<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_expenses extends Dany_Controller
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
        $tema['title'] = 'Site Expenses';
        $tema['tema'] = 'site_expenses/index';
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
                rsite_pengeluaran.id1 as DT_RowId,
                rsite_pengeluaran.keterangan,
                UPPER(rsite_pengeluaran.jenis_biaya) as jenis_biaya,
                FORMAT(rsite_pengeluaran.jumlah, 2, \'de_DE\') as jumlah,
                DATE_FORMAT(rsite_pengeluaran.tgl_bayar, \'%d-%m-%Y\') as tgl_bayar,
                IF(rsite_pengeluaran.sudah_bayar = 1 , \'Sudah Realisasi\', \'-\') as sudah_bayar,
                rsite_pengeluaran.id1 as aksi
                ');
            $this->datatables->from('rsite_pengeluaran');
            $this->datatables->where('rsite_pengeluaran.id_rsite', $id);
            
            $this->datatables->add_column('aksi', '<a href="'.base_url('site_expenses/edit/'.$id.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('site_expenses/del/'.$id.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
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
            $fields = $this->db->field_data('rsite_pengeluaran');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $tmp->id1;
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $query = $this->db->insert('rsite_pengeluaran', $kolom);
            
            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('site_expenses/index/'.$id);
            }else{
                $this->session->set_flashdata('error', 'Data gagal ditambah');
            }
        }

        $fields = $this->db->field_data('rsite_pengeluaran');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'site_expenses/add/'.$id;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Site Expenses';
        $tema['tema']   = 'site_expenses/form';
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
        $cek = $this->db->get('rsite_pengeluaran');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site_expenses');
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_pengeluaran');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $tmp->id1;
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $id);
            $query = $this->db->update('rsite_pengeluaran', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('site_expenses/index/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_pengeluaran');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'site_expenses/edit/'.$idx.'/'.$id;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Site Expenses';
        $tema['tema']   = 'site_expenses/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($idx = 0, $id = 0)
    {
        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_pengeluaran');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site_expenses/index/'.$idx);
        }
        
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite_pengeluaran');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('site_expenses/index/'.$idx);
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

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', $error);
        $this->form_validation->set_rules('jenis_biaya', 'Jenis Biaya', 'required', $error);
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', $error);
        $this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required', $error);
        $this->form_validation->set_rules('sudah_bayar', 'Sudah Bayar', 'required', $error);
		
        return $this->form_validation->run(); 
	}
}
