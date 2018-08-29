<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
        </li>
        <?php
        if (isset($subbreadcrumb)){
            foreach ($subbreadcrumb as $key => $value) {
                ?>
                <li>
                    <i class="fa fa-circle"></i>
                    <span><?php echo $value; ?></span>
                </li>
                <?
            }
        }
        ?>
        
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>
    <?php 
    if ($c_edit)
    {
        echo 'Isikan data ' . $title . ' pada form berikut dengan lengkap dan benar';
    }
    else{
        echo isset($noteInfo) ? $noteInfo : 'Data '. $title;
    }
    ?>

    </p>
</div>
    

<?php 
$err_msg = $this->session->flashdata('error');

if(isset($err_msg) || validation_errors()) { ?>
<div class="note note-danger">
    <ul style="margin-left: -15px;margin-bottom: 0;">
        <?php
        if($this->session->flashdata('error')){
            echo '<li>'.$err_msg.'</li>';
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

<?php 

unset($_SESSION['error'], $_SESSION['success']);

$this->load->view($content); 
?>