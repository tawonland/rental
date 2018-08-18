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
            <span><?php echo ($site->operator); ?></span>
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
    <p>Isikan data Penyewa Keuangan pada form berikut dengan lengkap dan benar</p>
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
                <table>
                    <tr>
                        <td width="100"><strong>ID Site</strong></td>
                        <td>: <?php echo $site->siteid; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Site Name</strong></td>
                        <td>: <?php echo $site->sitename; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Operator</strong></td>
                        <td>: <?php echo $site->operator; ?></td>
                    </tr>
                </table>
                
                <hr>
            
                <form action="<?php echo base_url($url); ?>" method="post" id="form" class="form-horizontal detailnya" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tagihan Ke</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tagihan_ke" value="<?php echo $data['tagihan_ke']; ?>" class="form-control aneh" placeholder="Tagihan Ke">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. Invoice</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_invoice" value="<?php echo $data['no_invoice']; ?>" class="form-control aneh" placeholder="No. Invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. Invoice</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. Invoice" name="tgl_invoice" required="" value="<?php echo ($data['tgl_invoice'] == '' ? date('Y-m-d') : $data['tgl_invoice']); ?>" id="datepicker1">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. PO</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_po" value="<?php echo $data['no_po']; ?>" class="form-control aneh" placeholder="No. PO">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sudah Bayar</label>
                                <div class="col-sm-10">
                                    <select name="sudah_dibayar" class="form-control">
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
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. Bayar" name="tgl_bayar" required="" value="<?php echo ($data['tgl_bayar'] == '' ? date('Y-m-d') : $data['tgl_bayar']); ?>" id="datepicker1">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nilai Invoice</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nilai_invoice" value="<?php echo $data['nilai_invoice']; ?>" class="form-control aneh" placeholder="Nilai Invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('penyewa_keuangan/index/'.$site->id.'/'.$site->idx); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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