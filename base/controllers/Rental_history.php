<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_history extends Auth_Controller
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
        $tema['title'] = 'Rental History';
        $tema['tema'] = 'rental_history/index';
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
                rsite_sewa.id1 as DT_RowId,  
                DATE_FORMAT(rsite_sewa.leasestart, \'%d-%m-%Y\') as leasestart,
                DATE_FORMAT(rsite_sewa.leaseend, \'%d-%m-%Y\') as leaseend,
                FORMAT(rsite_sewa.nilai_sewa,2 ,\'de-DE\') as nilai_sewa,
                rsite_sewa.keterangan,
                rsite_sewa.id1 as aksi
                ');
            $this->datatables->from('rsite_sewa');
            $this->datatables->where('id_rsite', $id);
            $this->db->order_by("id1", "desc");

            $this->datatables->add_column('aksi', '<a href="'.base_url('rental_history/edit/'.$id.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('rental_history/del/'.$id.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
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
            $fields = $this->db->field_data('rsite_sewa');
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
            
            $query = $this->db->insert('rsite_sewa', $kolom);
            
            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('rental_history/index/'.$id);
            }else{
                $this->session->set_flashdata('error', 'Data gagal ditambah');
            }
        }

        $fields = $this->db->field_data('rsite_sewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'rental_history/add/'.$id;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Rental History';
        $tema['tema']   = 'rental_history/form';
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
        $cek = $this->db->get('rsite_sewa');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('rental_history');
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_sewa');
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
            $query = $this->db->update('rsite_sewa', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('rental_history/index/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_sewa');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'rental_history/edit/'.$idx.'/'.$id;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Rental History';
        $tema['tema']   = 'rental_history/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($idx = 0, $id = 0)
    {
        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_sewa');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('rental_history/index/'.$idx);
        }
        
        $this->db->where('id1', $id);
        $query = $this->db->delete('rsite_sewa');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('rental_history/index/'.$idx);
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

        $this->form_validation->set_rules('leasestart', 'Lease Start', 'required', $error);
        $this->form_validation->set_rules('leaseend', 'Lease End', 'required', $error);
		
        return $this->form_validation->run(); 
	}
}
