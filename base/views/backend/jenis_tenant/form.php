<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
                <?php echo formx_dropdown(array('id' => 'jenis', 'name' => 'jenis'), $c_rsite_jenis, isset($data['jenis']) ? $data['jenis'] : '', $c_edit) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-sm-2 control-label">Bouwherr</label>
            <div class="col-sm-10">
                <?php echo formx_dropdown(array('id' => 'id_bouwher', 'name' => 'id_bouwher'), $c_id_bouwher, isset($data['id_bouwher']) ? $data['id_bouwher'] : '', $c_edit) ?>
            </div>
        </div>
    </div>
</div>