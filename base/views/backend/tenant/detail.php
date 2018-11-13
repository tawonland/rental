<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo ($site->sitename == '' ? $site->siteid : $site->sitename); ?></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo $tombol; ?></span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Detail data penyewa</p>
</div>

<?php if($this->session->flashdata('error') || validation_errors() || isset($error)) { ?>
<div class="note note-danger">
    <ul style="margin-left: -15px;margin-bottom: 0;">
        <?php echo isset($error) ? $error : ''; ?>
        <?php
        if($this->session->flashdata('error')){
            echo '<li>'.$this->session->flashdata('error').'</li>';
        }
        ?>
        <?php echo validation_errors('<li>','</li>'); ?>
    </ul>
</div>
<?php } ?>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"> Data Penyewa</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('tenant/index/'.$site->id1); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
			</div>
			<div class="portlet-body">
            
                <form id="form" class="form-horizontal detailnya" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID Site</label>
                                <div class="col-sm-10">
                                    <input type="text" name="operator" value="<?php echo $site->siteid; ?>" class="form-control aneh" placeholder="Operator" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="operator" value="<?php echo $site->sitename; ?>" class="form-control aneh" placeholder="Operator" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jenis</label>
                                <div class="col-sm-10">
                                    <select name="jenis" class="form-control" disabled>
                                    <?php
                                    $arr = array('b2s','collocation');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['jenis'] ? ' selected' : '');
                                        echo '<option value="'.$v.'"'.$selected.'>'.strtoupper($v).'</opition>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bouwherr</label>
                                <div class="col-sm-10">
                                    <select name="id_bouwherr" class="form-control" disabled>
                                    <?php
                                    $this->db->select('idbouwherr as id, nama, kode');
                                    $this->db->order_by('nama asc');
                                    $get = $this->db->get('bouwherr');
                                    foreach($get->result() as $dt)
                                    {
                                        $selected = ($dt->id == $data['id_bouwherr'] ? ' selected' : '');
                                        echo '<option value="'.$dt->id.'"'.$selected.'>'.$dt->kode.'</opition>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Operator</label>
                                <div class="col-sm-10">
                                    <input type="text" name="operator" value="<?php echo $data['operator']; ?>" class="form-control aneh" placeholder="Operator" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. SPK</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nospk" value="<?php echo $data['nospk']; ?>" class="form-control aneh" placeholder="No. SPK" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. RFI</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nospk" value="<?php echo $this->apps->tgl_indo($data['tglrfi']); ?>" class="form-control aneh" placeholder="No. SPK" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Type SPK</label>
                                <div class="col-sm-8">
                                    <input type="text" name="typeskn" value="<?php echo $data['typeskn']; ?>" class="form-control aneh" placeholder="Type SPK" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tgl. SPK</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nospk" value="<?php echo $this->apps->tgl_indo($data['tglspk']); ?>" class="form-control aneh" placeholder="No. SPK" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lease Start</label>
                                <div class="col-sm-8">
                                    <input type="text" name="leasestart" value="<?php echo $this->apps->tgl_indo($data['leasestart']); ?>" class="form-control aneh" placeholder="No. SPK" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lease End</label>
                                <div class="col-sm-8">
                                    <input type="text" name="leaseend" value="<?php echo $this->apps->tgl_indo($data['leaseend']); ?>" class="form-control aneh" placeholder="No. SPK" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" disabled>
                                    <?php
                                    $arr = array('Baru', 'Invoice', 'Payment');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['status'] ? ' selected' : '');
                                        echo '<option value="'.$v.'"'.$selected.'>'.strtoupper($v).'</opition>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nilai Kontrak</label>
                                <div class="col-sm-10">
                                    <?php 
                                    echo formx_input(array('id' => 'number', 'name' => 'nilai_kontrak'), isset($data['nilai_kontrak']) ? to_money($data['nilai_kontrak']) : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Masa Sistem Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="text" name="masa_sistem_pembayaran" value="<?php echo $data['masa_sistem_pembayaran']; ?>" class="form-control aneh" placeholder="Masa Sistem Pembayaran" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Periode Tagihan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Per</span>
                                            <?php echo formx_number(array('id' => 'periode_tagihan', 'name' => 'periode_tagihan'), !empty($data['periode_tagihan']) ? $data['periode_tagihan'] : '1', $c_edit); ?>
                                        <span class="input-group-addon">Bulan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nilai Invoice Pertagihan</label>
                                <div class="col-sm-10">
                                    <?php echo formx_input(array('id' => 'nilai_invoice_pertagihan', 'name' => 'nilai_invoice_pertagihan'), isset($data['nilai_invoice_pertagihan']) ? to_money($data['nilai_invoice_pertagihan']) : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            
			</div>
		</div>
	</div>
</div>

<?php
$url = base_url();
$controller = $this->router->class;
$js = <<<EOD
$('#datepicker1, #datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
});

EOD;
$this->apps->set_js($js);
?>