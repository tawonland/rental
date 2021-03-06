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
    <p>Isikan data Penyewa File pada form berikut dengan lengkap dan benar</p>
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
                    <span class="caption-subject bold uppercase"> Data Penyewa File</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('penyewa_file/index/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
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
                                <label class="col-sm-2 control-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" value="<?php echo $data['namafile']; ?>" class="form-control aneh" placeholder="File">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="5"><?php echo $data['deskripsi']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. Receive</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. Receive" name="tgl_receive" required="" value="<?php echo ($data['tgl_receive'] == '' ? date('Y-m-d') : $data['tgl_receive']); ?>" id="datepicker1">
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
                                <label class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <select name="keterangan" class="form-control">
                                    <?php
                                    $arr = array('SPK','Invoice','Lain');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['keterangan'] ? ' selected' : '');
                                        echo '<option value="'.$v.'"'.$selected.'>'.($v).'</opition>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('penyewa_file/index/'.$site->id.'/'.$site->idx); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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