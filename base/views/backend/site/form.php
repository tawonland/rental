<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Site</span>
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
    <p>Isikan data Site pada form berikut dengan lengkap dan benar</p>
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
                    <span class="caption-subject bold uppercase"> Data Site</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('site'); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
			</div>
			<div class="portlet-body">
            
                <form action="<?php echo base_url($url); ?>" method="post" id="form" class="form-horizontal detailnya" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="siteid" value="<?php echo $data['siteid']; ?>" class="form-control aneh" placeholder="Site ID">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sitename" value="<?php echo $data['sitename']; ?>" class="form-control aneh" placeholder="Site Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tenant Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tpname" value="<?php echo $data['tpname']; ?>" class="form-control aneh" placeholder="TP Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Status</label>
                                <div class="col-sm-8">
                                    <select name="sitestatus" class="form-control aneh">
                                    <?php
                                    $arr = array('on air', 'on going');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['sitestatus'] ? ' selected' : '');
                                        echo '<option value="'.$v.'"'.$selected.'>'.strtoupper($v).'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Longitude</label>
                                <div class="col-sm-8">
                                    <input type="text" name="longitude" value="<?php echo $data['longitude']; ?>" class="form-control aneh" placeholder="Longitude">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Latitude</label>
                                <div class="col-sm-8">
                                    <input type="text" name="latitude" value="<?php echo $data['latitude']; ?>" class="form-control aneh" placeholder="Latitude">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" value="<?php echo $data['address']; ?>" class="form-control aneh" placeholder="Address">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" value="<?php echo $data['city']; ?>" class="form-control aneh" placeholder="City">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Province</label>
                                <div class="col-sm-8">
                                    <input type="text" name="province" value="<?php echo $data['province']; ?>" class="form-control aneh" placeholder="Province">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site Available For Colo</label>
                                <div class="col-sm-10">
                                    <select name="site_available_for_colo" class="form-control aneh">
                                    <?php
                                    $arr = array('available', 'not available');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['site_available_for_colo'] ? ' selected' : '');
                                        echo '<option value="'.ucwords($v).'"'.$selected.'>'.ucwords($v).'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Type</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sitetype" value="<?php echo $data['sitetype']; ?>" class="form-control aneh" placeholder="Site Type">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tower Type</label>
                                <div class="col-sm-8">
                                    <input type="text" name="towertype" value="<?php echo $data['towertype']; ?>" class="form-control aneh" placeholder="Tower Type">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Building Height (m)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="buidingheight" value="<?php echo $data['buidingheight']; ?>" class="form-control aneh" placeholder="Site Type">
                                        <span class="input-group-addon">meter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tower Height  (m) from DPL</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="towerheight" value="<?php echo $data['towerheight']; ?>" class="form-control aneh" placeholder="Site Type">
                                        <span class="input-group-addon">meter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Availabletower Space</label>
                                <div class="col-sm-8">
                                    <input type="text" name="availabletowerspace" value="<?php echo $data['availabletowerspace']; ?>" class="form-control aneh" placeholder="Availabletower Space">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Availableground Space</label>
                                <div class="col-sm-8">
                                    <input type="text" name="availablegroundspace" value="<?php echo $data['availablegroundspace']; ?>" class="form-control aneh" placeholder="Availableground Space">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Contract Period</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sitecontractperiod" value="<?php echo $data['sitecontractperiod']; ?>" class="form-control aneh" placeholder="Site Contract Period">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comm Case History</label>
                                <div class="col-sm-8">
                                    <select name="commcasehistory" class="form-control aneh">
                                    <?php
                                    $arr = array('Y'=>'Yes', 'N'=>'No');
                                    foreach($arr as $k=>$v)
                                    {
                                        $selected = ($k == $data['commcasehistory'] ? ' selected' : '');
                                        echo '<option value="'.$k.'"'.$selected.'>'.strtoupper($v).'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if($tombol != 'Edit') { ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lease Start</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Lease Start" name="leasestart" required="" value="<?php echo ($data['leasestart'] == '' ? date('Y-m-d') : $data['leasestart']); ?>" id="datepicker1">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lease End</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Lease End" name="leaseend" required="" value="<?php echo ($data['leaseend'] == '' ? date('Y-m-d') : $data['leasestart']); ?>" id="datepicker2">
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
                                <label class="col-sm-2 control-label">Note</label>
                                <div class="col-sm-10">
                                    <input type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>" class="form-control aneh" placeholder="Note">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                  
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('site'); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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