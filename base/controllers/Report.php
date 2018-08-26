<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Dany_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function rental()
    {
        $tema['title'] = 'Report Rental';
        $tema['tema'] = 'report/rental';
        $this->load->view('backend/theme', $tema);
    }
    
    public function site()
    {
        $tema['title'] = 'Report Site';
        $tema['tema'] = 'report/site';
        $this->load->view('backend/theme', $tema);
    }
    
    public function gaji()
    {
        $tema['title'] = 'Report Gaji';
        $tema['tema'] = 'report/gaji';
        $this->load->view('backend/theme', $tema);
    }

    public function expenses()
    {
        $tema['title'] = 'Report Expenses';
        $tema['tema'] = 'report/expenses';
        $this->load->view('backend/theme', $tema);
    }
    
    public function rekap()
    {
        $tema['title'] = 'Report Rekap';
        $tema['tema'] = 'report/rekap';
        $this->load->view('backend/theme', $tema);
    }
	
	public function data($jenis = '')
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            if($jenis == 'rental')
            {
                $this->datatables->select('
                    siteid as DT_RowId,
                    siteid,
                    sitename,
                    address,
                    jenis,
                    nama,
                    nospk,
                    typeskn,
                    DATE_FORMAT(tglspk, \'%d-%m-%Y\') as tglspk,
                    DATE_FORMAT(leasestart, \'%d-%m-%Y\') as leasestart,
                    DATE_FORMAT(leaseend, \'%d-%m-%Y\') as leaseend,
                    akanberakhir,
                    status
                    ');
                $this->datatables->from('v_rsite_datarental');
            }else if($jenis == 'site'){
                $this->datatables->select('
                    id1 as DT_RowId,
                    CONCAT(\'<strong>ID:</strong> \', siteid, \'<br><strong>\', sitename, \'</strong>\') as site,
                    CONCAT(\'<strong>Alamat:</strong> \', address, \'<br><strong>Kota:</strong> \', city, \'<br><strong>Provinsi:</strong> \', province) as alamat,
                    sitecontractperiod,
                    akanberakhir,
                    CONCAT(DATE_FORMAT(leasestart, \'%d-%m-%Y\'), \'<br><strong>s/d</strong><br>\', DATE_FORMAT(leaseend, \'%d-%m-%Y\')) as lease
                    ');
                $this->datatables->from('v_rsite_datasite');
            }else if($jenis == 'gaji'){
                $this->datatables->select('
                    siteid as DT_RowId,
                    CONCAT(\'<strong>ID:</strong> \', siteid, \'<br><strong>\', sitename, \'</strong>\') as site,
                    CONCAT(\'<strong>Alamat:</strong> \', address, \'<br><strong>Kota:</strong> \', city, \'<br><strong>Provinsi:</strong> \', province) as alamat,
                    sitecontractperiod,
                    jenis_biaya,
                    FORMAT(jumlah, 2, \'de_DE\') as jumlah,
                    DATE_FORMAT(tgl_bayar, \'%d-%m-%Y\') as tgl_bayar,
                    IF(sudah_bayar = 1 , \'Sudah Realisasi\', \'-\') as sudah_bayar
                    ');
                $this->datatables->from('v_rsite_gaji');
            }else if($jenis == 'rekap'){
                $this->datatables->select('
                    idoperator as DT_RowId, 
                    operator, 
                    sitename, 
                    city,
                    towerheight,
                    UPPER(sitestatus) as sitestatus, 
                    FORMAT(sewatotal, 2, \'de_DE\') as sewatotal');
                $this->datatables->from('v_rsite_rekap');
                //$this->datatables->like('operator', $this->input->post('operator'));

            }
            else if($jenis == 'expenses'){
                $this->datatables->select('
                    siteid as DT_RowId,
                    CONCAT(\'<strong>ID:</strong> \', siteid, \'<br><strong>\', sitename, \'</strong>\') as site,
                    keterangan,
                    UPPER(jenis_biaya) as jenis_biaya,
                    FORMAT(jumlah, 2, \'de_DE\') as jumlah,
                    DATE_FORMAT(tgl_bayar, \'%d-%m-%Y\') as tgl_bayar,
                    IF(sudah_bayar = 1 , \'Sudah Realisasi\', \'-\') as sudah_bayar
                    ');

                $this->datatables->from('v_rsite_expenses');

                $tgl_bayar_awal = $this->input->get('tgl_bayar_awal');
                $tgl_bayar_akhir = $this->input->get('tgl_bayar_akhir');

                if(!empty($tgl_bayar_awal) AND !empty($tgl_bayar_akhir)){
                   $this->datatables->where('tgl_bayar >=', $tgl_bayar_awal);
                   $this->datatables->where('tgl_bayar <=', $tgl_bayar_akhir);
                }

            }
            echo $this->datatables->generate();
		}
	}
	
	public function export_xls($jenis = '')
	{
        require_once APPPATH."/third_party/PHPExcel/PHPExcel.php";

        if($jenis == 'rental')
        {
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
            $ws->getColumnDimension('G')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);
            $ws->getColumnDimension('I')->setAutoSize(true);
            $ws->getColumnDimension('J')->setAutoSize(true);
            $ws->getColumnDimension('K')->setAutoSize(true);
            $ws->getColumnDimension('L')->setAutoSize(true);
            $ws->getColumnDimension('M')->setAutoSize(true);
            
            $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");
            
            $ws->setCellValue('A1', 'DATA DAFTAR RENTAL PT. CITRA GAIA');
            $ws->setCellValue('A2', strtoupper($this->apps->tgl_indo(date('Y-m-d'))).' '.date('H:i:s'));
            
            $ws->setCellValue('A4', 'NO');
            $ws->setCellValue('B4', 'SITE ID');
            $ws->setCellValue('C4', 'SITE NAME');
            $ws->setCellValue('D4', 'ADDRESS');
            $ws->setCellValue('E4', 'JENIS');
            $ws->setCellValue('F4', 'NAMA');
            $ws->setCellValue('G4', 'NO. SPK');
            $ws->setCellValue('H4', 'TYPE SKN');
            $ws->setCellValue('I4', 'TANGGAL SPL');
            $ws->setCellValue('J4', 'LEASE START');
            $ws->setCellValue('K4', 'LEASE END');
            $ws->setCellValue('L4', 'AKAN BERAKHIR');
            $ws->setCellValue('M4', 'STATUS');
            
            $default_border = array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            );
            $style_header = array(
                'borders' => array(
                    'bottom' => $default_border,
                    'left' => $default_border,
                    'top' => $default_border,
                    'right' => $default_border,
                )
            );
            $style_headerx = array(
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
            
            $ws->getStyle('A4')->applyFromArray( $style_headerx );
            $ws->getStyle('B4')->applyFromArray( $style_headerx );
            $ws->getStyle('C4')->applyFromArray( $style_headerx );
            $ws->getStyle('D4')->applyFromArray( $style_headerx );
            $ws->getStyle('E4')->applyFromArray( $style_headerx );
            $ws->getStyle('F4')->applyFromArray( $style_headerx );
            $ws->getStyle('G4')->applyFromArray( $style_headerx );
            $ws->getStyle('H4')->applyFromArray( $style_headerx );
            $ws->getStyle('I4')->applyFromArray( $style_headerx );
            $ws->getStyle('J4')->applyFromArray( $style_headerx );
            $ws->getStyle('K4')->applyFromArray( $style_headerx );
            $ws->getStyle('L4')->applyFromArray( $style_headerx );
            $ws->getStyle('M4')->applyFromArray( $style_headerx );
            
            $this->db->order_by('sitename asc');
            $get = $this->db->get('v_rsite_datarental');
            $baris = 5;
            foreach($get->result() as $r)
            {
                $ws->setCellValue('A'.$baris, $baris-4);
                $ws->setCellValue('B'.$baris, $r->siteid);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->address);
                $ws->setCellValue('E'.$baris, strtoupper($r->jenis));
                $ws->setCellValue('F'.$baris, $r->nama);
                $ws->setCellValue('G'.$baris, $r->nospk);
                $ws->setCellValue('H'.$baris, $r->typeskn);
                $ws->setCellValue('I'.$baris, $r->tglspk == NULL ? '' : $this->apps->tgl_indo($r->tglspk));
                $ws->setCellValue('J'.$baris, $r->leasestart == NULL ? '' : $this->apps->tgl_indo($r->leasestart));
                $ws->setCellValue('K'.$baris, $r->leaseend == NULL ? '' : $this->apps->tgl_indo($r->leaseend));
                $ws->setCellValue('L'.$baris, $r->akanberakhir);
                $ws->setCellValue('M'.$baris, strtoupper($r->status));
                
                $ws->getStyle('A'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('B'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('C'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('D'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('E'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('F'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('G'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('H'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('I'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('J'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('K'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('L'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('M'.$baris)->applyFromArray( $style_header );
                
                $baris += 1;
            }
            
             $ws->getStyle("A5:B".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("E5:E".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("H5:M".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("A1:K4")
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                         
            $ws->mergeCells('A1:M1');
            $ws->mergeCells('A2:M2');
            $ws->getStyle( "A1:M4" )->getFont()->setBold( true );
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report Rental.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }else if($jenis == 'site'){
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
            $ws->getColumnDimension('G')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);
            $ws->getColumnDimension('I')->setAutoSize(true);
            $ws->getColumnDimension('J')->setAutoSize(true);
            
            $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");
            
            $ws->setCellValue('A1', 'DATA DAFTAR SITE PT. CITRA GAIA');
            $ws->setCellValue('A2', strtoupper($this->apps->tgl_indo(date('Y-m-d'))).' '.date('H:i:s'));
            
            $ws->setCellValue('A4', 'NO');
            $ws->setCellValue('B4', 'SITE ID');
            $ws->setCellValue('C4', 'SITE NAME');
            $ws->setCellValue('D4', 'ADDRESS');
            $ws->setCellValue('E4', 'CITY');
            $ws->setCellValue('F4', 'PROVINCE');
            $ws->setCellValue('G4', 'SITE CONTRACT PERIOD');
            $ws->setCellValue('H4', 'AKAN BERAKHIR');
            $ws->setCellValue('I4', 'LEASE START');
            $ws->setCellValue('J4', 'LEASE END');
            
            $default_border = array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            );
            $style_header = array(
                'borders' => array(
                    'bottom' => $default_border,
                    'left' => $default_border,
                    'top' => $default_border,
                    'right' => $default_border,
                )
            );
            $style_headerx = array(
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
            
            $ws->getStyle('A4')->applyFromArray( $style_headerx );
            $ws->getStyle('B4')->applyFromArray( $style_headerx );
            $ws->getStyle('C4')->applyFromArray( $style_headerx );
            $ws->getStyle('D4')->applyFromArray( $style_headerx );
            $ws->getStyle('E4')->applyFromArray( $style_headerx );
            $ws->getStyle('F4')->applyFromArray( $style_headerx );
            $ws->getStyle('G4')->applyFromArray( $style_headerx );
            $ws->getStyle('H4')->applyFromArray( $style_headerx );
            $ws->getStyle('I4')->applyFromArray( $style_headerx );
            $ws->getStyle('J4')->applyFromArray( $style_headerx );
            
            $this->db->order_by('sitename asc');
            $get = $this->db->get('v_rsite_datasite');
            $baris = 5;
            foreach($get->result() as $r)
            {
                $ws->setCellValue('A'.$baris, $baris-4);
                $ws->setCellValue('B'.$baris, $r->siteid);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->address);
                $ws->setCellValue('E'.$baris, $r->city);
                $ws->setCellValue('F'.$baris, $r->province);
                $ws->setCellValue('G'.$baris, $r->sitecontractperiod);
                $ws->setCellValue('H'.$baris, $r->akanberakhir);
                $ws->setCellValue('I'.$baris, $r->leasestart == NULL ? '' : $this->apps->tgl_indo($r->leasestart));
                $ws->setCellValue('J'.$baris, $r->leaseend == NULL ? '' : $this->apps->tgl_indo($r->leaseend));
                
                $ws->getStyle('A'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('B'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('C'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('D'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('E'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('F'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('G'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('H'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('I'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('J'.$baris)->applyFromArray( $style_header );
                
                $baris += 1;
            }
            
             $ws->getStyle("A5:B".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("G5:J".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("A1:K4")
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                         
            $ws->mergeCells('A1:J1');
            $ws->mergeCells('A2:J2');
            $ws->getStyle( "A1:J4" )->getFont()->setBold( true );
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report Site.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }else if($jenis == 'gaji'){
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
            $ws->getColumnDimension('G')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);
            $ws->getColumnDimension('I')->setAutoSize(true);
            $ws->getColumnDimension('J')->setAutoSize(true);
            $ws->getColumnDimension('K')->setAutoSize(true);
            
            $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");
            
            $ws->setCellValue('A1', 'DATA DAFTAR GAJI PT. CITRA GAIA');
            $ws->setCellValue('A2', strtoupper($this->apps->tgl_indo(date('Y-m-d'))).' '.date('H:i:s'));
            
            $ws->setCellValue('A4', 'NO');
            $ws->setCellValue('B4', 'SITE ID');
            $ws->setCellValue('C4', 'SITE NAME');
            $ws->setCellValue('D4', 'ADDRESS');
            $ws->setCellValue('E4', 'CITY');
            $ws->setCellValue('F4', 'PROVINCE');
            $ws->setCellValue('G4', 'SITE CONTRACT PERIOD');
            $ws->setCellValue('H4', 'JENIS BIAYA');
            $ws->setCellValue('I4', 'JUMLAH');
            $ws->setCellValue('J4', 'TANGGAL BAYAR');
            $ws->setCellValue('K4', 'TELAH BAYAR');
            
            $default_border = array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            );
            $style_header = array(
                'borders' => array(
                    'bottom' => $default_border,
                    'left' => $default_border,
                    'top' => $default_border,
                    'right' => $default_border,
                )
            );
            $style_headerx = array(
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
            
            $ws->getStyle('A4')->applyFromArray( $style_headerx );
            $ws->getStyle('B4')->applyFromArray( $style_headerx );
            $ws->getStyle('C4')->applyFromArray( $style_headerx );
            $ws->getStyle('D4')->applyFromArray( $style_headerx );
            $ws->getStyle('E4')->applyFromArray( $style_headerx );
            $ws->getStyle('F4')->applyFromArray( $style_headerx );
            $ws->getStyle('G4')->applyFromArray( $style_headerx );
            $ws->getStyle('H4')->applyFromArray( $style_headerx );
            $ws->getStyle('I4')->applyFromArray( $style_headerx );
            $ws->getStyle('J4')->applyFromArray( $style_headerx );
            $ws->getStyle('K4')->applyFromArray( $style_headerx );
            
            $this->db->order_by('sitename asc');
            $get = $this->db->get('v_rsite_gaji');
            $baris = 5;
            foreach($get->result() as $r)
            {
                $ws->setCellValue('A'.$baris, $baris-4);
                $ws->setCellValue('B'.$baris, $r->siteid);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->address);
                $ws->setCellValue('E'.$baris, $r->city);
                $ws->setCellValue('F'.$baris, $r->province);
                $ws->setCellValue('G'.$baris, $r->sitecontractperiod);
                $ws->setCellValue('H'.$baris, strtoupper($r->jenis_biaya));
                $ws->setCellValue('I'.$baris, number_format($r->jumlah, 0, ',', '.'));
                $ws->setCellValue('J'.$baris, $this->apps->tgl_indo($r->tgl_bayar));
                $ws->setCellValue('K'.$baris, ($r->sudah_bayar == 0 ? '-' : 'Sudah Realisasi'));
                
                $ws->getStyle('A'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('B'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('C'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('D'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('E'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('F'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('G'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('H'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('I'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('J'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('K'.$baris)->applyFromArray( $style_header );
                
                $baris += 1;
            }
            
             $ws->getStyle("A5:B".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("G5:H".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("J5:K".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("I5:I".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
             $ws->getStyle("A1:K4")
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                         
            $ws->mergeCells('A1:K1');
            $ws->mergeCells('A2:K2');
            $ws->getStyle( "A1:K4" )->getFont()->setBold( true );
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report Gaji.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }else if($jenis == 'rekap'){

            $filter = 'ALL PROJECT';

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $ws = $objPHPExcel->getActiveSheet();
            $ws->setTitle('Data');

            $ws->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $ws->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

            //Auto Width
            $ws->getColumnDimension('A')->setWidth(5);
            $ws->getColumnDimension('B')->setAutoSize(true);
            $ws->getColumnDimension('D')->setAutoSize(true);
            $ws->getColumnDimension('F')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);
            $ws->getColumnDimension('I')->setAutoSize(true);
            $ws->getColumnDimension('O')->setAutoSize(true);
            $ws->getColumnDimension('P')->setAutoSize(true);
            //
            
            //$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

            $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");
            
            $ws->getStyle( "A5:T5" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $ws->getStyle( "A5:T5" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->getStyle( "T6" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $ws->getStyle( "T6" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);            
            $ws->getStyle( "A6:S6" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->getStyle( "E7:S7" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "E7:S7" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $ws->getStyle( "F" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "H" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "I" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "L" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "N" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->getStyle( "T6" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $ws->getStyle( "E8:S8" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "E9:S9" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->setCellValue('A1', 'ADMINISTRATION REPORT')->mergeCells('A1:C1');
            //$ws->getRowDimension('1')->setWidth(40);

            $ws->setCellValue('A2', 'PT. CITRA GAIA')->mergeCells('A2:C2');
            $ws->setCellValue('A3', 'PROJECT : '.$filter)->mergeCells('A3:C3');
            $ws->setCellValue('A4', 'PERIODE '. date('d/m/Y'))->mergeCells('A3:C3');
            
            //row 5
            $ws->setCellValue('A5', 'NO')->mergeCells('A5:A9');
            $ws->setCellValue('B5', 'OPR')->mergeCells('B5:B9');
            $ws->setCellValue('C5', 'SITE NAME/LOKASI')->mergeCells('C5:C9');
            $ws->setCellValue('D5', 'KABUPATEN')->mergeCells('D5:D9');
            $ws->setCellValue('E5', '')->mergeCells('E5:K5');
            $ws->setCellValue('L5', '')->mergeCells('L5:S5');
            $ws->setCellValue('T5', '');

            //row 6
            $ws->setCellValue('E6', 'PROGRESS')->mergeCells('E6:F6');
            $ws->setCellValue('G6', 'LAHAN')->mergeCells('G6:K6');
            $ws->setCellValue('L6', 'SEWA OPERATOR')->mergeCells('L6:O6');
            $ws->setCellValue('P6', 'OUSTANDING RENTAL')->mergeCells('P6:S6');
            $ws->setCellValue('T6', "HARGA SEWA\nTOTAL")->mergeCells('T6:T9');
            $ws->getStyle('T6')->getAlignment()->setWrapText(true);
            
            // //row 7
            $ws->setCellValue('E7', "TOWER\nHIGH")->mergeCells('E7:E9');
            $ws->getStyle('E7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('F7', "STATUS")->mergeCells('F7:F8');;

            $ws->setCellValue('G7', "NILAI SEWA\n(Rp.)")->mergeCells('G7:G9');
            $ws->getStyle('G7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('H7', "MULAI\nSEWA")->mergeCells('H7:H9');
            $ws->getStyle('H7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('I7', "AKHIR\nSEWA")->mergeCells('I7:I9');
            $ws->getStyle('I7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('J7', "DURASI\n(th)")->mergeCells('J7:J9');
            $ws->getStyle('J7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('K7', "SISA\nSEWA\n(th)")->mergeCells('K7:K9');
            $ws->getStyle('K7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('L7', "NILAI SEWA");
            $ws->getStyle('L1:L'.$ws->getHighestRow())->getAlignment()->setWrapText(true);

            $ws->setCellValue('M7', "LAMA\nSEWA\n(th)")->mergeCells('M7:M9');
            $ws->getStyle('M7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('N7', "TANGGAL SEWA")->mergeCells('N7:N8');
            $ws->setCellValue('O7', "RENTAL");
            $ws->setCellValue('O8', "PAYMENT");
            $ws->getStyle('O7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('P7', "Harga Sewa/th");

            $row_count = 6;
            $ws->mergeCells("P".($row_count+1).":S".($row_count+1));
            $ws->mergeCells("P".($row_count+1).":S".($row_count+2));

            //Row 8
            $ws->setCellValue('L8', "OPERATOR");

            //Row 9
            
            $ws->setCellValue('F9', "Progress");
            $ws->setCellValue('L9', "(Rp./bln)");
            $ws->setCellValue('N9', "AWAL");
            $ws->setCellValue('O9', "DURATION");
            $ws->setCellValue('P9', "Thn");
            $ws->setCellValue('Q9', "Sewa/thn");
            $ws->setCellValue('R9', "PPN");
            $ws->setCellValue('S9', "Jumlah");
          
            $default_border = array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            );
            $style_header = array(
                'borders' => array(
                    'bottom' => $default_border,
                    'left' => $default_border,
                    'top' => $default_border,
                    'right' => $default_border,
                ),
                    'font'  => array(
                    'size'  => 11
                )
            );
            $style_headerx = array(
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
            
            // //border header row 5
            $ws->getStyle('A5:A9')->applyFromArray( $style_headerx );
            $ws->getStyle('B5:B9')->applyFromArray( $style_headerx );
            $ws->getStyle('C5:C9')->applyFromArray( $style_headerx );
            $ws->getStyle('D5:D9')->applyFromArray( $style_headerx );
            $ws->getStyle('A5:K5')->applyFromArray( $style_headerx );
            $ws->getStyle('L5:S5')->applyFromArray( $style_headerx );
            $ws->getStyle('T5')->applyFromArray( $style_headerx );
            
            // //border header row 6
            $ws->getStyle('E6:F6')->applyFromArray( $style_headerx );
            $ws->getStyle('G6:K6')->applyFromArray( $style_headerx );
            $ws->getStyle('L6:O6')->applyFromArray( $style_headerx );
            $ws->getStyle('P6:S6')->applyFromArray( $style_headerx );
            $ws->getStyle('T6:T9')->applyFromArray( $style_headerx );
            
            // //border header row 7
            $ws->getStyle('E7:E9')->applyFromArray( $style_headerx );
            $ws->getStyle('F7')->applyFromArray( $style_headerx );
            $ws->getStyle('G7:G9')->applyFromArray( $style_headerx );
            $ws->getStyle('H7:H9')->applyFromArray( $style_headerx );
            $ws->getStyle('I7:I9')->applyFromArray( $style_headerx );
            $ws->getStyle('J7:J9')->applyFromArray( $style_headerx );
            $ws->getStyle('K7:K9')->applyFromArray( $style_headerx );
            $ws->getStyle('L7:L9')->applyFromArray( $style_headerx );
            $ws->getStyle('M7:M9')->applyFromArray( $style_headerx );
            $ws->getStyle('N7:N9')->applyFromArray( $style_headerx );
            $ws->getStyle('O7:O9')->applyFromArray( $style_headerx );
            $ws->getStyle('P7:P9')->applyFromArray( $style_headerx );

            // //border header row 8
            $ws->getStyle('F9')->applyFromArray( $style_headerx );
            $ws->getStyle('N9')->applyFromArray( $style_headerx );
            $ws->getStyle('O9')->applyFromArray( $style_headerx );
            $ws->getStyle('P9')->applyFromArray( $style_headerx );
            $ws->getStyle('Q9')->applyFromArray( $style_headerx );
            $ws->getStyle('R9')->applyFromArray( $style_headerx );
            $ws->getStyle('S9')->applyFromArray( $style_headerx );

            $ws->getColumnDimension('C')->setAutoSize(true);
            
            $filter_operator = $this->input->post('operator');

            $this->db->order_by('sitename asc');
            
            if(!empty($filter_operator)){
                $this->db->like('operator', $filter_operator);
            }
            
            $get = $this->db->get('v_rsite_rekap');

            $baris = 10;
            $barisx = 10;
            $col_strlen = array();
            foreach($get->result() as $r)
            {
                $sitenilasewa       = to_money($r->sitenilasewa); // G
                $oprnilaisewa       = to_money($r->oprnilaisewa); //L
                $outstdsewaperthn   = to_money($r->outstdsewaperthn);
                $outstdppn          = to_money($r->outstdppn);
                $outjml             = to_money($r->outjml);
                $sewatotal          = to_money($r->sewatotal);

                $ws->setCellValue('A'.$baris, $baris-9);
                $ws->setCellValue('B'.$baris, $r->operator);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->city);
                $ws->setCellValue('E'.$baris, $r->towerheight);
                $ws->setCellValue('F'.$baris, strtoupper($r->sitestatus));
                $ws->setCellValue('G'.$baris, $sitenilasewa);
                $ws->setCellValue('H'.$baris, $r->leasestart == NULL ? '' : to_dmY($r->leasestart));
                $ws->setCellValue('I'.$baris, $r->leaseend == NULL ? '' : to_dmY($r->leaseend));
                $ws->setCellValue('J'.$baris, $r->sitedurasimonth == 0 ? $r->sitedurasiyear : $r->sitedurasiyear.'+'.$r->sitedurasimonth);
                $ws->setCellValue('K'.$baris, $r->sitesisasewa);
                $ws->setCellValue('L'.$baris, $oprnilaisewa);
                $ws->setCellValue('M'.$baris, $r->oprlamasewa);
                $ws->setCellValue('N'.$baris, $r->oprsewaawal == NULL ? '' : to_dmY($r->oprsewaawal));
                $ws->setCellValue('O'.$baris, 'Per '.$r->oprdurasi);
                $ws->setCellValue('P'.$baris, $r->outstdth);
                $ws->setCellValue('Q'.$baris, $outstdsewaperthn);
                $ws->setCellValue('R'.$baris, $outstdppn);
                $ws->setCellValue('S'.$baris, $outjml);
                $ws->setCellValue('T'.$baris, $sewatotal);
                
                $ws->getStyle("A".$baris)->applyFromArray( $style_header );
                $ws->getStyle('B'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('C'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('D'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('E'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('F'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('G'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('H'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('I'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('J'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('K'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('L'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('M'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('N'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('O'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('P'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('Q'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('R'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('S'.$baris)->applyFromArray( $style_header );
                $ws->getStyle('T'.$baris)->applyFromArray( $style_header );
                
                $col_strlen['G'][strlen($sitenilasewa)] = strlen($sitenilasewa);
                $col_strlen['L'][strlen($oprnilaisewa)] = strlen($oprnilaisewa);
                $col_strlen['Q'][strlen($outstdsewaperthn)] = strlen($outstdsewaperthn);
                $col_strlen['R'][strlen($outstdppn)] = strlen($outstdppn);
                $col_strlen['S'][strlen($outjml)] = strlen($outjml);
                $col_strlen['T'][strlen($sewatotal)] = strlen($sewatotal);

                $baris += 1;
            }

            $width_default['G'] = 10;
            $width_default['L'] = 10;
            $width_default['Q'] = 8;
            $width_default['R'] = 3;
            $width_default['S'] = 7;
            $width_default['T'] = 7;

            if(count($col_strlen) > 0){
                foreach ($col_strlen as $key => $value) {
                    $max[$key] = max($col_strlen[$key]);

                    $width[$key] = $max[$key] < $width_default[$key] ? $width_default[$key] : $max[$key];

                    $ws->getColumnDimension($key)->setWidth($width[$key]+1);
                }
            }

            $ws->getColumnDimension('N')->setWidth(15);

            $ws->getStyle("G".$barisx.":G".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $ws->getStyle("L".$barisx.":L".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $ws->getStyle("Q".$barisx.":Q".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $ws->getStyle("R".$barisx.":R".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $ws->getStyle("S".$barisx.":S".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $ws->getStyle("T".$barisx.":T".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report Rekap.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');

        }else if($jenis == 'expenses'){
            //
            $tgl_bayar_awal = $this->input->get('tgl_bayar_awal');
            $tgl_bayar_akhir = $this->input->get('tgl_bayar_akhir');
            $txtSearch  = $this->input->get('txtSearch');
            //

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $ws = $objPHPExcel->getActiveSheet();
            
            $ws->setTitle('Data');
            
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

            $ws->setCellValue('A1', 'DATA DAFTAR SITE EXPENSES PT. CITRA GAIA');
            $ws->setCellValue('A2', strtoupper($this->apps->tgl_indo(date('Y-m-d'))).' '.date('H:i:s'));

            if(!empty($tgl_bayar_awal) AND !empty($tgl_bayar_akhir)){
                $ws->setCellValue('A3','TANGGAL BAYAR   : ' . strtoupper($this->apps->tgl_indo($tgl_bayar_awal)) . ' s/d ' . strtoupper($this->apps->tgl_indo($tgl_bayar_akhir)));
            }

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
            
            $style_border = array(
                'borders' => array(
                    'bottom' => $default_border,
                    'left' => $default_border,
                    'top' => $default_border,
                    'right' => $default_border,
                ),
                    'font'  => array(
                    'size'  => 11
                )
            );

            $ws->getStyle('A5')->applyFromArray( $style_table_header );
            $ws->getStyle('B5')->applyFromArray( $style_table_header );
            $ws->getStyle('C5')->applyFromArray( $style_table_header );
            $ws->getStyle('D5')->applyFromArray( $style_table_header );
            $ws->getStyle('E5')->applyFromArray( $style_table_header );
            $ws->getStyle('F5')->applyFromArray( $style_table_header );
            $ws->getStyle('G5')->applyFromArray( $style_table_header );
            $ws->getStyle('H5')->applyFromArray( $style_table_header );

            $ws->setCellValue('A5', 'NO');
            $ws->setCellValue('B5', 'SITE ID');
            $ws->setCellValue('C5', 'SITE NAME');
            $ws->setCellValue('D5', 'KETERANGAN');
            $ws->setCellValue('E5', 'JENIS BIAYA');
            $ws->setCellValue('F5', 'JUMLAH');
            $ws->setCellValue('G5', 'TGL BAYAR');
            $ws->setCellValue('H5', 'SUDAH BAYAR');
            
            //header align
            $ws->getStyle( "A5:F5" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            

            //list data
            $this->db->select('
                    siteid,
                    sitename,
                    keterangan,
                    UPPER(jenis_biaya) as jenis_biaya,
                    jumlah,
                    tgl_bayar,
                    IF(sudah_bayar = 1 , \'Sudah Realisasi\', \'-\') as sudah_bayar
                    ');

            $this->db->from('v_rsite_expenses');

            $this->db->where('1','1');

            if(!empty($tgl_bayar_awal) AND !empty($tgl_bayar_akhir)){
               $this->db->where('tgl_bayar >=', $tgl_bayar_awal);
               $this->db->where('tgl_bayar <=', $tgl_bayar_akhir);
            }

            if(!empty($txtSearch)){
                $searcharray = array(
                    'sitename'      => $txtSearch,
                    'keterangan'    => $txtSearch,
                    'jenis_biaya'   => $txtSearch,
                    'tgl_bayar'     => $txtSearch,
                    'IF(sudah_bayar = 1 , \'Sudah Realisasi\', \'-\')' => $txtSearch
                );
                $this->db->group_start();
                $this->db->or_like($searcharray);
                $this->db->group_end();
            }

            $get = $this->db->get();

            $baris = 6;
            $barisx = 6;
            $col_strlen = array();

            foreach($get->result() as $r)
            {
                
                // $rsite = new PHPExcel_RichText();
                // $objBold = $rsite->createTextRun('ID: ');
                // $objBold->getFont()->setBold(true);
                // $rsite->createText($r->DT_RowId."\n");
                // $objBold = $rsite->createTextRun($r->sitename);
                // $objBold->getFont()->setBold(true);

                $jumlah = to_money($r->jumlah);

                $ws->setCellValue('A'.$baris, $baris-5);
                $ws->setCellValue('B'.$baris, $r->siteid);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->keterangan);
                $ws->setCellValue('E'.$baris, $r->jenis_biaya);
                $ws->setCellValue('F'.$baris, $jumlah);
                $ws->setCellValue('G'.$baris, to_dmY($r->tgl_bayar));
                $ws->setCellValue('H'.$baris, $r->sudah_bayar);

                $ws->getStyle('A'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('B'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('C'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('D'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('E'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('F'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('G'.$baris)->applyFromArray( $style_border );
                $ws->getStyle('H'.$baris)->applyFromArray( $style_border );

                $ws->getStyle("F".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $ws->getStyle("G".$baris.":H".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $col_strlen['F'][strlen($jumlah)] = strlen($jumlah);

                $baris += 1;
            }

            $ws->getColumnDimension('A')->setWidth(5);
            $ws->getColumnDimension('B')->setAutoSize(true);
            $ws->getColumnDimension('C')->setAutoSize(true);
            $ws->getColumnDimension('D')->setAutoSize(true);
            $ws->getColumnDimension('E')->setAutoSize(true);
            $ws->getColumnDimension('G')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);

            $width_default['F'] = 12;

            if(count($col_strlen) > 0){
                foreach ($col_strlen as $key => $value) {
                    $max[$key] = max($col_strlen[$key]);

                    $width[$key] = $max[$key] < $width_default[$key] ? $width_default[$key] : $max[$key];

                    $ws->getColumnDimension($key)->setWidth($width[$key]+1);
                }
            }

             $ws->getStyle("A1:H5")
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->mergeCells('A1:H1');
            $ws->mergeCells('A2:H2');
            $ws->mergeCells('A3:H3');

            $ws->getStyle( "A1:H5" )->getFont()->setBold( true );

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Daftar Site Expenses.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }
}
