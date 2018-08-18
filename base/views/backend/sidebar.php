<ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <li class="heading" style="border-bottom: 1px solid #3d4957;padding-bottom: 13px;">
        <h3 class="uppercase bold">Menu Utama</h3>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('site')?>" class="nav-link nav-toggle">
            <i class="icon-globe"></i>
            <span class="title">Site</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($this->router->class == 'report' ? 'open' : ''); ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-printer"></i>
            <span class="title">Report</span>
            <span class="arrow <?php echo ($this->router->class == 'report' ? 'open' : ''); ?>"></span>
        </a>
        <ul class="sub-menu"<?php echo ($this->router->class == 'report' ? ' style="display: block;"' : ''); ?>>
            <li class="nav-item  ">
                <a href="<?php echo base_url('report/rental')?>" class="nav-link ">
                    <span class="title"><i class="fa fa-circle-o"></i> Report Rental</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('report/site')?>" class="nav-link ">
                    <span class="title"><i class="fa fa-circle-o"></i> Report Site</span>
                </a>
            </li> 
            <li class="nav-item  ">
                <a href="<?php echo site_url('report/gaji')?>" class="nav-link ">
                    <span class="title"><i class="fa fa-circle-o"></i> Report Gaji</span>
                </a>
            </li> 
            <li class="nav-item  ">
                <a href="<?php echo site_url('report/rekap')?>" class="nav-link ">
                    <span class="title"><i class="fa fa-circle-o"></i> Report Rekap</span>
                </a>
            </li>                                                                   
        </ul>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('../gaia')?>" class="nav-link nav-toggle">
            <i class="icon-arrow-left"></i>
            <span class="title">Projects</span>
        </a>
    </li>
</ul>