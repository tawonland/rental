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
    <p>Detail data penyewa keuangan</p>
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
                    <span class="caption-subject bold uppercase"> Data Penyewa Keuangan</span>
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
                                <label class="col-sm-2 control-label">Tagihan Ke</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tagihan_ke" value="<?php echo $data['tagihan_ke']; ?>" class="form-control aneh" placeholder="Tagihan Ke" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. Invoice</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_invoice" value="<?php echo $data['no_invoice']; ?>" class="form-control aneh" placeholder="No. Invoice" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. Invoice</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_po" value="<?php echo $this->apps->tgl_indo($data['tgl_invoice']); ?>" class="form-control aneh" placeholder="No. PO" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. PO</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_po" value="<?php echo $data['no_po']; ?>" class="form-control aneh" placeholder="No. PO" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sudah Bayar</label>
                                <div class="col-sm-10">
                                    <select name="sudah_dibayar" class="form-control" disabled>
                                    <?php
                                    $arr = array('Belum', 'Sudah');
                                    foreach($arr as $k=>$v)
                                    {
                                        $selected = ($k == $data['sudah_dibayar'] ? ' selected' : '');
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
                                <label class="col-sm-2 control-label">Tgl. Bayar</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_po" value="<?php echo tgl_indo($data['tgl_bayar']); ?>" class="form-control aneh" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nilai Invoice</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nilai_invoice" value="<?php echo $data['nilai_invoice']; ?>" class="form-control aneh" placeholder="Nilai Invoice" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sudah Dicetak</label>
                                <div class="col-sm-10">
                                    <?php echo formx_dropdown(array('id' => 'sudah_dicetak', 'name' => 'sudah_dicetak'), arr_belumsudah(), isset($data['sudah_dicetak']) ? $data['sudah_dicetak'] : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sudah Dikirim</label>
                                <div class="col-sm-10">
                                    <?php echo formx_dropdown(array('id' => 'sudah_dikirim', 'name' => 'sudah_dikirim'), arr_belumsudah(), isset($data['sudah_dikirim']) ? $data['sudah_dikirim'] : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sudah Diterima User</label>
                                <div class="col-sm-10">
                                      <?php echo formx_dropdown(array('id' => 'sudah_diterim_user', 'name' => 'sudah_diterim_user'), arr_belumsudah(), isset($data['sudah_diterim_user']) ? $data['sudah_diterim_user'] : '', $c_edit) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. Diterima User</label>
                                <div class="col-sm-10">
                                    <?php echo formx_inputdate(array('id' => 'tgl_diterima_user', 'name' => 'tgl_diterima_user'), $data['tgl_diterima_user'], $c_edit); ?>                 
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