<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
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
                    <span class="caption-subject bold uppercase"> Data Jenis Tenant</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('jenis_tenant'); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
			</div>
			<div class="portlet-body">
                <form action="<?php echo base_url($url); ?>" method="post" id="form" class="form-horizontal detailnya" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jenis</label>
                                <div class="col-sm-10">
                                    <select name="jenis" class="form-control jenis">
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
                                    <?php echo form_dropdown('id_bouwher', $c_id_bouwher, '', 'id="id_bouwher" class="form-control input-sm"') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                      
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('jenis_tenant'); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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
$('.jenis').on('change', function(e){
    var val = $('.jenis option:selected').val();
    $.ajax({
        url: '{$url}/tenant/bouwherr/'+val,
        type: "GET",
        timeout: 10000,
        success: function(e) {
            $('.id_bouwherr').html(e);
        },
        error: function(x, t, m) {
            if(t==="timeout") {
                alert("got timeout");
            } else {
                alert(m);
            }
        }
    })
});
EOD;
$this->apps->set_js($js);
?>