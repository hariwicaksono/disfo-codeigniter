      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">	
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('images/photo/'.($this->session->foto=="" ? 'default.jpeg' : $this->session->foto)); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('images/photo/'.($this->session->foto=="" ? 'default.jpeg' : $this->session->foto)); ?>" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->fullname; ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
						<?=$this->session->jenis_str; ?>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=site_url($this->session->url_profile); ?>" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>