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
                    <span class="caption-subject bold uppercase"> Data Penyewa Amandemen</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('penyewa_amandemen/index/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
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
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" name="operator" value="<?php echo $this->apps->tgl_indo($data['tgl']); ?>" class="form-control aneh" placeholder="Operator" disabled>
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
                                <label class="col-sm-2 control-label">Jenis Perubahan</label>
                                <div class="col-sm-10">
                                    <select name="jenisperubahan" class="form-control" disabled>
                                    <?php
                                    $arr = array('no spk','tgl spk','tgl sewa','lainnya');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['jenisperubahan'] ? ' selected' : '');
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
                                <label class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>" class="form-control aneh" placeholder="Keterangan" disabled>
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