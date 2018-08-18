<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa_subkon extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index($id = 0, $idx = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $tema['site'] = $xcek->row();
        $tema['title'] = 'Penyewa Subkon';
        $tema['tema'] = 'penyewa_subkon/index';
        $this->load->view('backend/theme', $tema);
    }
	
	public function data($id = 0, $idx = 0)
	{
        $this->db->select('siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $id);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            //redirect('site');
        }

		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            $this->datatables->select('
                rsite_penyewa_subkon.id1 as DT_RowId,  
                CONCAT(msubkon.kode, \' / \', msubkon.nama) as msubcon,
                rsite_penyewa_subkon.material,
                IF(rsite_penyewa_subkon.termasukppn = \'Y\', \'Ya\', \'Tidak\') as termasukppn,
                FORMAT(rsite_penyewa_subkon.sub_total, 2, \'de_DE\') as sub_total,
                DATE_FORMAT(rsite_penyewa_subkon.tglselesai, \'%d-%m-%Y\') as tglselesai,
                rsite_penyewa_subkon.id1 as aksi
                ');
            $this->datatables->from('rsite_penyewa_subkon');
            $this->datatables->join('msubkon', 'msubkon.id1 = rsite_penyewa_subkon.id_subkon');
            $this->datatables->where('id_rsite_penyewa', $idx);
            
            $this->datatables->add_column('no_invoice', '<strong>$1</strong><br>Nilai Invoice: Rp $2', 'no_invoice, nilai_invoice');
            $this->datatables->add_column('aksi', '<a href="'.base_url('penyewa_subkon/detail/'.$id.'/'.$idx.'/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('penyewa_subkon/edit/'.$id.'/'.$idx.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('penyewa_subkon/del/'.$id.'/'.$idx.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
            echo $this->datatables->generate();
		}
	}
    
    public function addest($id = 0, $idx = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator, rsite_penyewa.id_bouwherr');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();
        
        $tema['title']  = 'Pilih Master Harga';
        $tema['tema']   = 'penyewa_subkon/formdest';
        $this->load->view('backend/theme', $tema);
    }
    
    public function add($id = 0, $idx = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_penyewa_subkon');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite_penyewa') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $idx;
                    continue;
                }
                if($field->name == 'sub_total') {
                    $kolom[$field->name] = ((double)$this->input->post('qty', true)) * ((double)$this->input->post('unit_price', true));
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $query = $this->db->insert('rsite_penyewa_subkon', $kolom);
            
            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('penyewa_subkon/index/'.$id.'/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal ditambah');
            }
        }

        $fields = $this->db->field_data('rsite_penyewa_subkon');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'penyewa_subkon/add/'.$id.'/'.$idx.($this->input->get('ref', true) ? '?ref='.$this->input->get('ref', true) : '');
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Penyewa Subkon';
        $tema['tema']   = 'penyewa_subkon/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function edit($id = 0, $idx = 0, $idy = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();

        $this->db->where('id1', $idy);
        $cek = $this->db->get('rsite_penyewa_subkon');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_subkon/index/'.$id.'/'.$idx);
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_penyewa_subkon');
            $kolom = array();
            foreach ($fields as $field)
            { 
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite_penyewa') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $idx;
                    continue;
                }
                if($field->name == 'sub_total') {
                    $kolom[$field->name] = ((double)$this->input->post('qty', true)) * ((double)$this->input->post('unit_price', true));
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $idy);
            $query = $this->db->update('rsite_penyewa_subkon', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('penyewa_subkon/index/'.$id.'/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_subkon');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'penyewa_subkon/edit/'.$id.'/'.$idx.'/'.$idy;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Penyewa Subkon';
        $tema['tema']   = 'penyewa_subkon/form';
        $this->load->view('backend/theme', $tema);
    }
    
    public function detail($id = 0, $idx = 0, $idy = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        $tema['site'] = $xcek->row();

        $this->db->where('id1', $idy);
        $cek = $this->db->get('rsite_penyewa_subkon');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_subkon');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_subkon');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Penyewa Subkon';
        $tema['tema']   = 'penyewa_subkon/detail';
        $this->load->view('backend/theme', $tema);
    }
    
    public function del($id = 0, $idx = 0, $idy = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $this->db->where('id1', $idy);
        $query = $this->db->delete('rsite_penyewa_subkon');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('penyewa_subkon/index/'.$id.'/'.$idx);
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

        $this->form_validation->set_rules('id_subkon', 'Subkon', 'required', $error);
        $this->form_validation->set_rules('material', 'Material', 'required', $error);
        $this->form_validation->set_rules('uraian_pekerjaan', 'Uraian Pekerjaan', 'required', $error);
        $this->form_validation->set_rules('qty', 'Quantity', 'required', $error);
        $this->form_validation->set_rules('uom', 'UOM', 'required', $error);
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required', $error);
        $this->form_validation->set_rules('termasukppn', 'Termasuk PPN', 'required', $error);
        $this->form_validation->set_rules('tglselesai', 'Tgl. Selesai', 'required', $error);
        
        return $this->form_validation->run(); 
	}
}
