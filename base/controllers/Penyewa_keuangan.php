<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa_keuangan extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index($id = 0, $idx = 0)
    {
        $this->db->select('rsite.id1 as id, rsite_penyewa.id1 as idx, siteid, sitename, operator');
        $this->db->from('rsite');
        $this->db->join('rsite_penyewa', 'rsite_penyewa.id_rsite = rsite.id1','left');
        $this->db->where('rsite.id1', $id);
        $this->db->where('rsite_penyewa.id1', $idx);
        $xcek = $this->db->get();
        if($xcek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('site');
        }
        
        $tema['site'] = $xcek->row();
        $tema['title'] = 'Penyewa Keuangan';
        $tema['tema'] = 'penyewa_keuangan/index';
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
                rsite_penyewa_keuangan.id1 as DT_RowId,  
                rsite_penyewa_keuangan.tagihan_ke,
                rsite_penyewa_keuangan.no_invoice,
                DATE_FORMAT(rsite_penyewa_keuangan.tgl_invoice, \'%d-%m-%Y\') as tgl_invoice,
                rsite_penyewa_keuangan.no_po,
                IF(rsite_penyewa_keuangan.sudah_dibayar = 1, \'Sudah\', \'Belum\') as sudah_dibayar,
                DATE_FORMAT(rsite_penyewa_keuangan.tgl_bayar, \'%d-%m-%Y\') as tgl_bayar,
                FORMAT(rsite_penyewa_keuangan.nilai_invoice, 2, \'de_DE\') as nilai_invoice,
                rsite_penyewa_keuangan.id1 as aksi
                ');
            $this->datatables->from('rsite_penyewa_keuangan');
            $this->datatables->where('id_rsite_penyewa', $idx);
            
            $this->datatables->add_column('no_invoice', '<strong>$1</strong><br>Nilai Invoice: Rp $2', 'no_invoice, nilai_invoice');
            $this->datatables->add_column('aksi', '<a href="'.base_url('penyewa_keuangan/detail/'.$id.'/'.$idx.'/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('penyewa_keuangan/edit/'.$id.'/'.$idx.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('penyewa_keuangan/del/'.$id.'/'.$idx.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
            echo $this->datatables->generate();
		}
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
            $fields = $this->db->field_data('rsite_penyewa_keuangan');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite_penyewa') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $tmp->idx;
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $query = $this->db->insert('rsite_penyewa_keuangan', $kolom);
            
            if($query)
            {
                $idnya = $this->db->insert_id();
                
                $this->session->set_flashdata('error', 'Data berhasil ditambah');
                redirect('penyewa_keuangan/index/'.$id.'/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal ditambah');
            }
        }

        $fields = $this->db->field_data('rsite_penyewa_keuangan');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'penyewa_keuangan/add/'.$id.'/'.$idx;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Penyewa Keuangan';
        $tema['tema']   = 'penyewa_keuangan/form';
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
        $cek = $this->db->get('rsite_penyewa_keuangan');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_keuangan/index/'.$id.'/'.$idx);
        }
        
        if($this->validasi())
        {
            $fields = $this->db->field_data('rsite_penyewa_keuangan');
            $kolom = array();
            foreach ($fields as $field)
            {
                if($field->name == 'id1') continue;
                if($field->name == 'id_rsite_penyewa') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $tmp->idx;
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $idy);
            $query = $this->db->update('rsite_penyewa_keuangan', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('penyewa_keuangan/index/'.$id.'/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_keuangan');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'penyewa_keuangan/edit/'.$id.'/'.$idx.'/'.$idy;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Penyewa Keuangan';
        $tema['tema']   = 'penyewa_keuangan/form';
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
        $cek = $this->db->get('rsite_penyewa_keuangan');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_keuangan');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_keuangan');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Penyewa Keuangan';
        $tema['tema']   = 'penyewa_keuangan/detail';
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
        $query = $this->db->delete('rsite_penyewa_keuangan');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('penyewa_keuangan/index/'.$id.'/'.$idx);
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

        $this->form_validation->set_rules('no_invoice', 'No. Invoice', 'required', $error);
        $this->form_validation->set_rules('tgl_invoice', 'Tgl. Invoice', 'required', $error);
        $this->form_validation->set_rules('no_po', 'No. PO', 'required', $error);
        $this->form_validation->set_rules('sudah_dibayar', 'Sudah Dibayar', 'required', $error);
        $this->form_validation->set_rules('tgl_bayar', 'Tgl. Bayar', 'required', $error);
        $this->form_validation->set_rules('nilai_invoice', 'Nilai Invoice', 'required', $error);
		
        return $this->form_validation->run(); 
	}
}
