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

            $filter = 'ALL PROJECT';

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $ws = $objPHPExcel->getActiveSheet();
            $ws->setTitle('Data');

            //Auto Width
            //$ws->getColumnDimension('A')->setAutoSize(true);
            $ws->getColumnDimension('B')->setAutoSize(true);
            $ws->getColumnDimension('C')->setAutoSize(true);
            $ws->getColumnDimension('D')->setAutoSize(true);
            //$ws->getColumnDimension('E')->setAutoSize(true);
            $ws->getColumnDimension('F')->setAutoSize(true);
            //$ws->getColumnDimension('G')->setAutoSize(true);
            $ws->getColumnDimension('H')->setAutoSize(true);
            $ws->getColumnDimension('I')->setAutoSize(true);
            // $ws->getColumnDimension('J')->setAutoSize(true);
            // $ws->getColumnDimension('K')->setAutoSize(true);
            // $ws->getColumnDimension('L')->setAutoSize(true);
            // $ws->getColumnDimension('M')->setAutoSize(true);
            $ws->getColumnDimension('N')->setAutoSize(true);
            $ws->getColumnDimension('O')->setAutoSize(true);
            $ws->getColumnDimension('P')->setAutoSize(true);
            $ws->getColumnDimension('Q')->setAutoSize(true);
            $ws->getColumnDimension('R')->setAutoSize(true);
            $ws->getColumnDimension('S')->setAutoSize(true);
            
            //$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

            $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L& PT. CITRA GAIA\nJl. Manyar Jaya V Blok A-1c SURABAYA\nTelp. 031-5964944 - Fax. 031-5964945");
            
            $ws->getStyle( "A5:T5" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $ws->getStyle( "A5:T5" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->getStyle( "T6" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $ws->getStyle( "T6" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);            
            $ws->getStyle( "A6:S6" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->getStyle( "E7:S7" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $ws->getStyle( "E7:S7" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $ws->getStyle( "T6" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $ws->getStyle( "E8:S8" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $ws->setCellValue('A1', 'ADMINISTRATION REPORT')->mergeCells('A1:C1');
            $ws->getRowDimension('1')->setRowHeight(40);

            $ws->setCellValue('A2', 'PT. CITRA GAIA')->mergeCells('A2:C2');
            $ws->setCellValue('A3', 'PROJECT : '.$filter)->mergeCells('A3:C3');
            $ws->setCellValue('A4', 'PERIODE '. date('d/m/Y'))->mergeCells('A3:C3');
            
            //row 5
            $ws->setCellValue('A5', 'NO')->mergeCells('A5:A8');
            $ws->setCellValue('B5', 'OPR')->mergeCells('B5:B8');
            $ws->setCellValue('C5', 'SITE NAME/LOKASI')->mergeCells('C5:C8');
            $ws->setCellValue('D5', 'KABUPATEN')->mergeCells('D5:D8');
            $ws->setCellValue('E5', '')->mergeCells('E5:K5');
            $ws->setCellValue('L5', '')->mergeCells('L5:S5');
            $ws->setCellValue('T5', '');

            //row 6
            $ws->setCellValue('E6', 'PROGRESS')->mergeCells('E6:F6');
            $ws->setCellValue('G6', 'LAHAN')->mergeCells('G6:K6');
            $ws->setCellValue('L6', 'SEWA OPERATOR')->mergeCells('L6:O6');
            $ws->setCellValue('P6', 'OUSTEANDING RENTAL')->mergeCells('P6:S6');
            $ws->setCellValue('T6', "HARGA SEWA\nTOTAL")->mergeCells('T6:T8');
            $ws->getStyle('T6')->getAlignment()->setWrapText(true);
            
            //row 7
            $ws->setCellValue('E7', "TOWER\nHIGH")->mergeCells('E7:E8');
            $ws->getStyle('E7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('F7', "STATUS");

            $ws->setCellValue('G7', "NILAI SEWA\n(Rp.)")->mergeCells('G7:G8');
            $ws->getStyle('G7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('H7', "MULAI\nSEWA")->mergeCells('H7:H8');
            $ws->getStyle('H7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('I7', "AKHIR\nSEWA")->mergeCells('I7:I8');
            $ws->getStyle('I7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('J7', "DURASI\n(th)")->mergeCells('J7:J8');
            $ws->getStyle('J7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('K7', "SISA\nSEWA\n(th)")->mergeCells('K7:K8');
            $ws->getStyle('K7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('L7', "NILAI SEWA\nOPERATOR\n(Rp./bln)")->mergeCells('L7:L8');
            $ws->getStyle('L7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('M7', "LAMA\nSEWA\n(th)")->mergeCells('M7:M8');
            $ws->getStyle('M7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('N7', "TANGGAL SEWA");
            $ws->setCellValue('O7', "RENTAL\nPAYMENT");
            $ws->getStyle('O7')->getAlignment()->setWrapText(true);

            $ws->setCellValue('P7', "Harga Sewa/th")->mergeCells('P7:S7');

            //Row 8
            $ws->setCellValue('F8', "Progress");
            $ws->setCellValue('N8', "AWAL");
            $ws->setCellValue('O8', "DURATION");
            $ws->setCellValue('P8', "Thn");
            $ws->setCellValue('Q8', "Sewa/thn");
            $ws->setCellValue('R8', "PPN");
            $ws->setCellValue('S8', "Jumlah");
          
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
            
            //border header row 5
            $ws->getStyle('A5:A8')->applyFromArray( $style_headerx );
            $ws->getStyle('B5:B8')->applyFromArray( $style_headerx );
            $ws->getStyle('C5:C8')->applyFromArray( $style_headerx );
            $ws->getStyle('D5:D8')->applyFromArray( $style_headerx );
            $ws->getStyle('A5:K5')->applyFromArray( $style_headerx );
            $ws->getStyle('L5:S5')->applyFromArray( $style_headerx );
            $ws->getStyle('T5')->applyFromArray( $style_headerx );
            
            //border header row 6
            $ws->getStyle('E6:F6')->applyFromArray( $style_headerx );
            $ws->getStyle('G6:K6')->applyFromArray( $style_headerx );
            $ws->getStyle('L6:O6')->applyFromArray( $style_headerx );
            $ws->getStyle('P6:S6')->applyFromArray( $style_headerx );
            $ws->getStyle('T6:T8')->applyFromArray( $style_headerx );
            
            //border header row 7
            $ws->getStyle('E7:E8')->applyFromArray( $style_headerx );
            $ws->getStyle('F7')->applyFromArray( $style_headerx );
            $ws->getStyle('G7:G8')->applyFromArray( $style_headerx );
            $ws->getStyle('H7:H8')->applyFromArray( $style_headerx );
            $ws->getStyle('I7:I8')->applyFromArray( $style_headerx );
            $ws->getStyle('J7:J8')->applyFromArray( $style_headerx );
            $ws->getStyle('K7:K8')->applyFromArray( $style_headerx );
            $ws->getStyle('L7:L8')->applyFromArray( $style_headerx );
            $ws->getStyle('M7:M8')->applyFromArray( $style_headerx );
            $ws->getStyle('N7:N8')->applyFromArray( $style_headerx );
            $ws->getStyle('O7:O8')->applyFromArray( $style_headerx );
            $ws->getStyle('P7:P8')->applyFromArray( $style_headerx );

            //border header row 8
            $ws->getStyle('F8')->applyFromArray( $style_headerx );
            $ws->getStyle('N8')->applyFromArray( $style_headerx );
            $ws->getStyle('O8')->applyFromArray( $style_headerx );
            $ws->getStyle('P8')->applyFromArray( $style_headerx );
            $ws->getStyle('Q8')->applyFromArray( $style_headerx );
            $ws->getStyle('R8')->applyFromArray( $style_headerx );
            $ws->getStyle('S8')->applyFromArray( $style_headerx );
            


            $this->db->order_by('sitename asc');
            $get = $this->db->get('v_rsite_rekap');
            $baris = 9;
            foreach($get->result() as $r)
            {
                $ws->setCellValue('A'.$baris, $baris-4);
                $ws->setCellValue('B'.$baris, $r->operator);
                $ws->setCellValue('C'.$baris, $r->sitename);
                $ws->setCellValue('D'.$baris, $r->city);
                $ws->setCellValue('E'.$baris, $r->towerheight);
                $ws->setCellValue('F'.$baris, $r->sitestatus);
                $ws->setCellValue('G'.$baris, $r->sitenilasewa);
                $ws->setCellValue('H'.$baris, $r->leasestart == NULL ? '' : $this->apps->to_dmY($r->leasestart,'/'));
                $ws->setCellValue('I'.$baris, $r->leaseend == NULL ? '' : $this->apps->to_dmY($r->leaseend,'/'));
                $ws->setCellValue('J'.$baris, $r->sitedurasimonth == 0 ? $r->sitedurasiyear : $r->sitedurasiyear.'+'.$r->sitedurasimonth);
                $ws->setCellValue('K'.$baris, $r->sitesisasewa);
                $ws->setCellValue('L'.$baris, $r->oprnilaisewa);
                $ws->setCellValue('M'.$baris, $r->oprlamasewa);
                $ws->setCellValue('N'.$baris, $r->oprsewaawal == NULL ? '' : $this->apps->to_dmY($r->oprsewaawal,'/'));
                $ws->setCellValue('O'.$baris, $r->oprdurasi);
                $ws->setCellValue('P'.$baris, $r->outstdth);
                $ws->setCellValue('Q'.$baris, $r->outstdsewa);
                $ws->setCellValue('R'.$baris, $r->outstdppn);
                $ws->setCellValue('S'.$baris, $r->outjml);
                $ws->setCellValue('T'.$baris, $r->sewatotal);

                
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
                
                $baris += 1;
            }
            
             $ws->getStyle("A".$baris.":B".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("E".$baris.":E".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("H".$baris.":M".$baris)
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $ws->getStyle("A1:K4")
                         ->getAlignment()
                         ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                         
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
