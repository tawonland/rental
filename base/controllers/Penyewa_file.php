<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa_file extends Auth_Controller
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
        $tema['title'] = 'Penyewa File';
        $tema['tema'] = 'penyewa_file/index';
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
                rsite_penyewa_file.id1 as DT_RowId, 
                DATE_FORMAT(rsite_penyewa_file.tgl_upload, \'%d-%m-%Y\') as tgl_upload, 
                rsite_penyewa_file.deskripsi,
                DATE_FORMAT(rsite_penyewa_file.tgl_receive, \'%d-%m-%Y\') as tgl_receive, 
                rsite_penyewa_file.namafile,
                rsite_penyewa_file.keterangan,
                rsite_penyewa_file.id1 as aksi
                ');
            $this->datatables->from('rsite_penyewa_file');
            $this->datatables->where('id_rsite_penyewa', $idx);
            
            $this->datatables->add_column('namafile', '<a href="'.base_url('upload/file/$1').'" class="btn btn-info btn-xs" download><i class="fa fa-file"></i> $1</a>', 'namafile');
            $this->datatables->add_column('aksi', '<a href="'.base_url('penyewa_file/detail/'.$id.'/'.$idx.'/$1').'" class="label label-info" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a> <a href="'.base_url('penyewa_file/edit/'.$id.'/'.$idx.'/$1').'" class="label label-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a> <a href="'.base_url('penyewa_file/del/'.$id.'/'.$idx.'/$1').'" class="label label-danger" data-toggle="tooltip" hapus="ok" title="Delete"><i class="fa fa-remove"></i></a>', 'aksi');
            
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
            $file = $this->do_upload();
            if($file !== 'file gagal diupload')
            {
                $fields = $this->db->field_data('rsite_penyewa_file');
                $kolom = array();
                foreach ($fields as $field)
                {
                    if($field->name == 'id1') continue;
                    if($field->name == 'tgl_upload') continue;
                    if($field->name == 'id_rsite_penyewa') {
                        $tmp = $tema['site'];
                        $kolom[$field->name] = $idx;
                        continue;
                    }
                    if($field->name == 'namafile') {
                        $kolom['tgl_upload'] = date('Y-m-d');
                        $kolom[$field->name] = $file;
                        continue;
                    }
                    $kolom[$field->name] = $this->input->post($field->name, true);
                }
                
                $query = $this->db->insert('rsite_penyewa_file', $kolom);
                
                if($query)
                {
                    $idnya = $this->db->insert_id();
                    
                    $this->session->set_flashdata('error', 'Data berhasil ditambah');
                    redirect('penyewa_file/index/'.$id.'/'.$idx);
                }else{
                    $this->session->set_flashdata('error', 'Data gagal ditambah');
                }
            }else{
                $this->session->set_flashdata('error', 'File gagal diupload. File harus berupa PDF, JPG, DOC, atau DOCX.');
            }
        }

        $fields = $this->db->field_data('rsite_penyewa_file');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
			if($field->name == 'id_rsite') continue;
			$tema['data'][$field->name] = set_value($field->name);
		}
        
        $tema['url']    = 'penyewa_file/add/'.$id.'/'.$idx;
        $tema['tombol'] = 'Tambah';
        $tema['title']  = 'Tambah Penyewa File';
        $tema['tema']   = 'penyewa_file/form';
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
        $cek = $this->db->get('rsite_penyewa_file');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_file/index/'.$id.'/'.$idx);
        }
        
        if($this->validasi(true))
        {
            $fields = $this->db->field_data('rsite_penyewa_file');
            $kolom = array();
            foreach ($fields as $field)
            { 
                if($field->name == 'id1') continue;
                if($field->name == 'tgl_upload') continue;
                if($field->name == 'id_rsite_penyewa') {
                    $tmp = $tema['site'];
                    $kolom[$field->name] = $idx;
                    continue;
                }
                if($field->name == 'namafile') {
                    $file = $this->do_upload();
                    if($file !== 'file gagal diupload')
                    {
                        $kolom['tgl_upload'] = date('Y-m-d');
                        $kolom[$field->name] = $this->input->post($field->name, true);
                    }
                    continue;
                }
                $kolom[$field->name] = $this->input->post($field->name, true);
            }
            
            $this->db->where('id1', $idy);
            $query = $this->db->update('rsite_penyewa_file', $kolom);
            
            if($query)
            {
                $idnya = $id;
                
                $this->session->set_flashdata('error', 'Data berhasil diubah');
                redirect('penyewa_file/index/'.$id.'/'.$idx);
            }else{
                $this->session->set_flashdata('error', 'Data gagal diubah');
            }
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_file');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['url']    = 'penyewa_file/edit/'.$id.'/'.$idx.'/'.$idy;
        $tema['tombol'] = 'Edit';
        $tema['title']  = 'Edit Penyewa File';
        $tema['tema']   = 'penyewa_file/form';
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
        $cek = $this->db->get('rsite_penyewa_file');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('penyewa_file');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_penyewa_file');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $tema['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}
        
        $tema['tombol'] = 'Detail';
        $tema['title']  = 'Detail Penyewa File';
        $tema['tema']   = 'penyewa_file/detail';
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
        $query = $this->db->delete('rsite_penyewa_file');
        
        if($query)
        {
            $this->session->set_flashdata('error', 'Data berhasil dihapus');
        }else{
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        
        redirect('penyewa_file/index/'.$id.'/'.$idx);
    }
    
    private function do_upload()
    {
        $this->load->library('upload');
        $nama_file = date('d-m-Y-h-i-s-'.rand(0000,9999));

        $config['upload_path']          = APPPATH.'/../upload/file/';
        $config['allowed_types']        = 'pdf|jpg|doc|docx';
        $config['file_name']            = $nama_file;
        $config['overwrite']            = TRUE;

        $this->upload->initialize($config);

        if(! $this->upload->do_upload('file'))
        {
            return 'file gagal diupload';
        }else{
            $data = $this->upload->data();
            return $data['file_name'];
        }
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

        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', $error);
        $this->form_validation->set_rules('tgl_receive', 'Tgl. Receive', 'required', $error);
        if(@$_FILES['file']['name'] == '' && !$aneh)
        {
            $this->form_validation->set_rules('namafile', 'File Upload', 'required', $error);
        }
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', $error);
        
        return $this->form_validation->run(); 
	}
}
