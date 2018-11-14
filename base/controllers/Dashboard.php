<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->data['title'] = 'Home';
        $this->data['subbreadcrumb'] = array('Home');
        $this->data['tema']   = $this->router->class.'/index';
        //$this->data['content'] = 'backend/'.$this->router->class.'/index';
        
        $this->data['noteInfo'] = 'Data '.$this->data['title'];

        $this->load->model('Rsite_penyewa_model');
        $this->load->model('Rsite_model');

        $total_tenant   = $this->Rsite_penyewa_model->getTotalTenant();
        $total_tower    = $this->Rsite_model->getCountAll();

        $this->data['total_tenant'] = $total_tenant;
        $this->data['total_tower']  = $total_tower;

        $this->load->view('backend/theme', $this->data);
    }
	
    public function jml_tenant_persite($id = 0)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables');
            
            $this->datatables->select('
                a.id1 as DT_RowId, 
                a.siteid,
                a.sitename,
                a.city,
                b.jml_tenant
                ');
            
            $this->datatables->from('rsite a');
            $this->datatables->join('v_rsite_jml_tenant b', 'a.id1 = b.id_rsite', 'LEFT');
            
            $data = $this->datatables->generate();

            $data = json_decode($data,TRUE);

            $rs_data = $data['data'];

            // //getDataTenant
            $this->load->model('Rsite_penyewa_model');
            $rs_tenant = $this->Rsite_penyewa_model->getRowsFkAsKey();

            $rows = array();
            foreach ($rs_data as $key => $v) {
                
                $id_rsite = $v['DT_RowId'];

                $rows[$key] = $v;
                $rows[$key]['site'] = '<a href="'.base_url('tenant/index/'.$id_rsite).'">';
                $rows[$key]['site'] .= '<strong>ID:</strong> ' . $v['siteid'] . '<br><strong>' . $v['sitename']. '</strong>';
                $rows[$key]['site'] .= '</a>';

                $a_tenant = array();
                if(isset($rs_tenant[$id_rsite])){
                    foreach ($rs_tenant[$id_rsite] as $k_rsite => $v_rsite) {
                        $a_tenant[] = $v_rsite['operator'];
                    }
                }

                $list_tenant = '';
                
                if($a_tenant){
                    $list_tenant .= '<ul><li>';
                    $list_tenant .= implode('</li><li>', $a_tenant);
                    $list_tenant .= '</li></ul>';
                }                

                $rows[$key]['nama_tenant'] = $list_tenant;
            }

            $data['data'] = $rows;
            
            echo json_encode($data);


        }
    }

	public function tgl_invoice_blm_bayar($id = 0)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
            $this->load->library('datatables');
            
            $this->datatables->select('
                a.id1 as DT_RowId, 
                CONCAT(\'<strong>ID:</strong> \', c.siteid, \'<br><strong>\', c.sitename, \'</strong>\') as site,
                b.operator,
                DATE_FORMAT(a.tgl_invoice, \'%d-%m-%Y\') as tgl_invoice,
                DATE_FORMAT(b.leaseend, \'%d-%m-%Y\') as leaseend
                ');
            $this->datatables->from('rsite_penyewa_keuangan a');
            $this->datatables->join('rsite_penyewa b', 'a.id_rsite_penyewa = b.id1');
            $this->datatables->join('rsite c', 'b.id_rsite = c.id1');
            $this->datatables->where('a.sudah_dibayar', 0);
            
            echo $this->datatables->generate();
		}
	}

    public function leaseend_site($id = 0)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables');
            
            $this->datatables->select('
                a.id1 as DT_RowId, a.siteid, a.sitename, a.city,  b.operator, YEAR(b.leasestart) AS th_leasestart, YEAR(b.leaseend) AS th_leasesend
                ');

            $this->datatables->from('rsite a');
            $this->datatables->join('rsite_penyewa b', 'a.id1 = b.id_rsite');
            $this->datatables->where('b.leaseend >=', date('Y-m-d'));
            
            $data = $this->datatables->generate();

            $data = json_decode($data,TRUE);

            $rs_data = $data['data'];

            $rows = array();
            foreach ($rs_data as $key => $v) {
                $rows[$key] = $v;
                $rows[$key]['site']  = '<strong>ID:</strong> ' . $v['siteid'] . '<br><strong>' . $v['sitename']. '</strong>';
                
                $th_leasestart = $v['th_leasestart'];
                $th_leasesend  = $v['th_leasesend'];
                
                $rows[$key]['lease'] = ' <span class = "pull-left">' . $v['operator'] . '</span>';
                $rows[$key]['lease'] .= ' <span class = "pull-right"> '.$th_leasestart . ' s/d ' . $th_leasesend . '</span>';
            }

        
            $data['data'] = $rows;



            echo json_encode($data);
        }
    }
            
    public function detail($id = 0)
    {
        //load model        
        $this->load->model('Rsite_jenis_model');

        $this->db->where('id1', $id);
        $cek = $this->db->get('rsite_jns');
        if($cek->num_rows() != 1)
        {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('jenis_tenant');
        }
        
        $row = $cek->row_array();
        $fields = $this->db->field_data('rsite_jns');
		foreach ($fields as $field)
		{
			if($field->name == 'id1') continue;
            $this->data['data'][$field->name] = ($row[$field->name] == '' || set_value($field->name)) ? set_value($field->name) : $row[$field->name];
		}

        $this->db->select('idbouwherr, nama');
        $this->db->from('bouwherr');
        $get = $this->db->get();

        $c_id_bouwher = array();
        foreach ($get->result_array() as $key => $value) {
            $c_id_bouwher[$value['idbouwherr']] = strtoupper($value['nama']);
        }

        $this->data['c_rsite_jenis']  = $this->Rsite_jenis_model->c_rsite_jenis();
        $this->data['c_id_bouwher'] = $c_id_bouwher;
        $this->data['tombol'] = 'Detail';
        $this->data['title']  = 'Detail Jenis Tenant';

        $this->data['captionSubject']   = $this->data['title'];
        $this->data['form_action']      = base_url('jenis_tenant/add');
        $this->data['form_data']        = 'backend/jenis_tenant/form';
        $this->data['content']          = 'backend/inc_form_v';

        $this->load->view('backend/theme', $this->data);
    }
    
}
