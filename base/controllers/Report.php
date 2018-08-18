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
                $this->datatables->from('v_rsite_sewa_akanhabis');
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
            
            $ws->setCellValue('A1', 'DATA DAFTAR SEWA PT. CITRA GAIA');
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
            $get = $this->db->get('v_rsite_sewa_akanhabis');
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
                         
            //$ws->mergeCells('A1:M1');
            //$ws->mergeCells('A2:M2');
            $ws->getStyle( "A1:M4" )->getFont()->setBold( true );
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Report Rekap.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }
}