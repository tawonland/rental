<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"> <?php echo isset($captionSubject) ? $captionSubject : ''?></span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url($this->router->class); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="portlet-body">
                <!-- form start -->
                <?php echo form_open_multipart($form_action, array('id' => 'form', 'method' => 'post', 'class' => 'form-horizontal')); ?>
                <div class="box-body">
                    <?php
                        $this->load->view($form_data);
                    ?>
                </div>
                <div class="box-footer">
                    <?php
                        if($c_edit)
                        {
                    ?>                  
                        <div class="form-group" style="margin-bottom: 0;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn blue"><i class="fa fa-save"></i> <?php echo $tombol; ?></button>
                                <a href="<?php echo base_url($this->router->class); ?>" class="btn default"><i class="fa fa-long-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <!-- /.box-footer -->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>