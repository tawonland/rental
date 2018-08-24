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

    public function export_xls($id = '')
    {
        $this->db->where('id1', $id);
        $xcek = $this->db->get('rsite');
        $site = $xcek->row();

        require_once APPPATH."/third_party/PHPExcel/PHPExcel.php";

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $ws = $objPHPExcel->getActiveSheet();
        $ws->setTitle('Data');
        $ws->getColumnDimension('A')->setAutoSize(true);
        $ws->getColumnDimension('B')->setAutoSize(true);
        $ws->getColumnDimension('C')->setAutoSize(true);
        $ws->getColumnDimension('D')->setAutoSize(true);
        $ws->getColumnDimension('E')->setAutoSize(true);
        $ws->getColumnDimension('F')->setAutoSize(true);

        

        $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");

        $default_border = array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            );

        //pre table header
        $style_pre_table_header = array(
                            'borders' => array(
                            'bottom' => $default_border,
                            'left' => $default_border,
                            'top' => $default_border,
                            'right' => $default_border,
                            ),
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb'=>'EEEEEE'),
                            )
                        );

        $ws->setCellValue('A2','ID Site         : ' . $site->siteid)->mergeCells('A2:B2');
        $ws->setCellValue('A3','Site Name   : ' . $site->sitename)->mergeCells('A3:B3');

        //table header
        $style_table_header = array(
                            'borders' => array(
                            'bottom' => $default_border,
                            'left' => $default_border,
                            'top' => $default_border,
                            'right' => $default_border,
                            ),
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb'=>'EEEEEE'),
                            )
                        );
        
        $ws->getStyle('A5:F5')->applyFromArray( $style_table_header );

        $ws->setCellValue('A5', 'NO');
        $ws->setCellValue('B5', 'KETERANGAN');
        $ws->setCellValue('C5', 'JENIS BIAYA');
        $ws->setCellValue('D5', 'JUMLAH');
        $ws->setCellValue('E5', 'TGL BAYAR');
        $ws->setCellValue('F5', 'SUDAH BAYAR');
        
        //header align
        $ws->getStyle( "A5:F5" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //list data
        $this->db->where('id1', $id);
        $get = $this->db->get('v_rsite_expenses');

        $a_status_exepnses = array('-', 'Sudah Realisasi');
        $baris = 6;
        foreach($get->result() as $r)
        {
            $ws->setCellValue('A'.$baris, $baris-5);
            $ws->setCellValue('B'.$baris, $r->keterangan);
            $ws->setCellValue('C'.$baris, $r->jenis_biaya);
            $ws->setCellValue('D'.$baris, $this->apps->to_money($r->jumlah));
            $ws->setCellValue('E'.$baris, $this->apps->to_dmY($r->tgl_bayar));
            $ws->setCellValue('F'.$baris, $a_status_exepnses[$r->sudah_bayar]);

            $baris += 1;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Expenses.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');

    }
}
