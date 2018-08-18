<?php
if($this->input->get('ref', true))
{
    $this->db->where('id1', $this->input->get('ref', true));
    $get = $this->db->get('masterharga');
    if($get->num_rows() > 0)
    {
        $r = $get->row();
        $data['material'] = ($data['material'] != $r->material && $data['material'] != '' ? $data['material'] : $r->material);
        $data['uraian_pekerjaan'] = ($data['uraian_pekerjaan'] != $r->description && $data['uraian_pekerjaan'] != '' ? $data['uraian_pekerjaan'] : $r->description);
        $data['uom'] = ($data['uom'] != $r->uom && $data['uom'] != ''? $data['uom'] : $r->uom);
        $data['unit_price'] = ($data['unit_price'] != $r->hargasatuan && $data['unit_price'] != '' ? $data['unit_price'] : $r->hargasatuan);
        $data['termasukppn'] = ($data['termasukppn'] != $r->termasukppn && $data['termasukppn'] != '' ? $data['termasukppn'] : $r->termasukppn);
    }
}
?>
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
    <p>Isikan data Penyewa Subkon pada form berikut dengan lengkap dan benar</p>
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
                    <a href="<?php echo base_url('penyewa_subkon/index/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
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
                                <label class="col-sm-2 control-label">Subkon</label>
                                <div class="col-sm-10">
                                    <select name="id_subkon" class="form-control">
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
                                    <input type="text" name="material" value="<?php echo $data['material']; ?>" class="form-control aneh" placeholder="Material">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Uraian Pekerjaan</label>
                                <div class="col-sm-10">
                                    <textarea name="uraian_pekerjaan" class="form-control" placeholder="Uraian Pekerjaan" rows="5"><?php echo $data['uraian_pekerjaan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">UOM</label>
                                <div class="col-sm-10">
                                    <input type="text" name="uom" value="<?php echo $data['uom']; ?>" class="form-control aneh" placeholder="UOM">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" name="qty" value="<?php echo $data['qty']; ?>" class="form-control aneh" placeholder="Quantity">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unit Price</label>
                                <div class="col-sm-10">
                                    <input type="number" name="unit_price" value="<?php echo $data['unit_price']; ?>" class="form-control aneh" placeholder="Unit Price">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Termasuk PPN</label>
                                <div class="col-sm-10">
                                    <select name="termasukppn" class="form-control">
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
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tgl. Selesai" name="tglselesai" required="" value="<?php echo ($data['tglselesai'] == '' ? date('Y-m-d') : $data['tglselesai']); ?>" id="datepicker1">
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
                  
                    <hr style="margin-top: 5px;">

                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('penyewa_subkon/index/'.$site->id.'/'.$site->idx); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
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