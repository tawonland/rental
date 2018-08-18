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
    <p>Detail data penyewa subkon</p>
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
                    <span class="caption-subject bold uppercase"> Data Penyewa Subkon</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('penyewa_keuangan/index/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
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
                                <label class="col-sm-2 control-label">Operator</label>
                                <div class="col-sm-10">
                                    <input type="text" name="operator" value="<?php echo $site->operator; ?>" class="form-control aneh" placeholder="Operator" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subkon</label>
                                <div class="col-sm-10">
                                    <select name="id_subkon" class="form-control" disabled>
                                    <?php
                                    $this->db->order_by('nama asc');
                                    $get = $this->db->get('msubkon');
                                    foreach($get->result() as $dt)
                                    {
                                        $selected = ($dt->id1 == $data['id_subkon'] ? ' selected' : '');
                                        echo '<option value="'.$dt->id1.'"'.$selected.'>'.$dt->kode.' / '.$dt->nama.'</opition>';
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
                                <label class="col-sm-2 control-label">Material</label>
                                <div class="col-sm-10">
                                    <input type="text" name="material" value="<?php echo $data['material']; ?>" class="form-control aneh" placeholder="Material" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Uraian Pekerjaan</label>
                                <div class="col-sm-10">
                                    <textarea name="uraian_pekerjaan" class="form-control" placeholder="Uraian Pekerjaan" rows="5" disabled><?php echo $data['uraian_pekerjaan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">UOM</label>
                                <div class="col-sm-10">
                                    <input type="text" name="uom" value="<?php echo $data['uom']; ?>" class="form-control aneh" placeholder="UOM" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" name="qty" value="<?php echo $data['qty']; ?>" class="form-control aneh" placeholder="Quantity" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unit Price</label>
                                <div class="col-sm-10">
                                    <input type="number" name="unit_price" value="<?php echo $data['unit_price']; ?>" class="form-control aneh" placeholder="Unit Price" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Termasuk PPN</label>
                                <div class="col-sm-10">
                                    <select name="termasukppn" class="form-control" disabled>
                                    <?php
                                    $arr = array('Y'=>'Ya', 'T'=>'Tidak');
                                    foreach($arr as $k=>$v)
                                    {
                                        $selected = ($k == $data['termasukppn'] ? ' selected' : '');
                                        echo '<option value="'.$k.'"'.$selected.'>'.($v).'</opition>';
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
                                <label class="col-sm-2 control-label">Tgl. Selesai</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_po" value="<?php echo $this->apps->tgl_indo($data['tglselesai']); ?>" class="form-control aneh" placeholder="No. PO" disabled>
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