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
    <p>Isikan data Penyewa pada form berikut dengan lengkap dan benar</p>
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

<?php if($this->session->flashdata('success')) { ?>
<div class="note note-info">
    <ul style="margin-left: -15px;margin-bottom: 0;">
        <?php
            echo '<li>'.$this->session->flashdata('success').'</li>';
        ?>
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
                <table>
                    <tr>
                        <td width="100"><strong>ID Site</strong></td>
                        <td>: <?php echo $site->siteid; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Site Name</strong></td>
                        <td>: <?php echo $site->sitename; ?></td>
                    </tr>
                </table>
                
                <hr>
            
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
                                    <select name="id_bouwherr" class="form-control id_bouwherr">
                                    <?php
                                    if($data['id_bouwherr'] != '')
                                    {
                                        $this->db->select('bouwherr.idbouwherr, bouwherr.nama');
                                        $this->db->join('rsite_jns', 'rsite_jns.id_bouwher = bouwherr.idbouwherr');
                                        $this->db->where('rsite_jns.jenis', $data['jenis']);
                                        $get = $this->db->get('bouwherr');
                                        foreach($get->result() as $r)
                                        {
                                            $selected = ($r->idbouwherr == $data['id_bouwherr'] ? ' selected' : '');
                                            echo '<option value="'.$r->idbouwherr.'"'.$selected.'>'.$r->nama.'</option>';
                                        }
                                    }else{
                                        $this->db->select('bouwherr.idbouwherr, bouwherr.nama');
                                        $this->db->join('rsite_jns', 'rsite_jns.id_bouwher = bouwherr.idbouwherr');
                                        $this->db->where('rsite_jns.jenis', 'b2s');
                                        $get = $this->db->get('bouwherr');
                                        foreach($get->result() as $r)
                                        {
                                            echo '<option value="'.$r->idbouwherr.'">'.$r->nama.'</option>';
                                        }
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
                                <label class="col-sm-2 control-label">No. SPK</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nospk" value="<?php echo $data['nospk']; ?>" class="form-control aneh" placeholder="No. SPK">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tgl. RFI</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. RFI" name="tglrfi" required="" value="<?php echo ($data['tglrfi'] == '' ? date('Y-m-d') : $data['tglrfi']); ?>" id="datepicker2">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Type SPK</label>
                                <div class="col-sm-8">
                                    <input type="text" name="typeskn" value="<?php echo $data['typeskn']; ?>" class="form-control aneh" placeholder="Type SPK">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tgl. SPK</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. SPK" name="tglspk" required="" value="<?php echo ($data['tglspk'] == '' ? date('Y-m-d') : $data['tglspk']); ?>" id="datepicker2">
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
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
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
                                    <?php echo formx_number(array('id' => 'nilai_kontrak', 'name' => 'nilai_kontrak'), isset($data['nilai_kontrak']) ? $data['nilai_kontrak'] : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Masa Sistem Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="text" name="masa_sistem_pembayaran" value="<?php echo $data['masa_sistem_pembayaran']; ?>" class="form-control aneh" placeholder="Masa Sistem Pembayaran">
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
                                    <?php echo formx_number(array('id' => 'nilai_invoice_pertagihan', 'name' => 'nilai_invoice_pertagihan'), isset($data['nilai_invoice_pertagihan']) ? $data['nilai_invoice_pertagihan'] : '', $c_edit); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('tenant/index/'.$site->id1); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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