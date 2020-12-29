      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>User</h1>
          </div>

          <div class="section-body">   
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-7">
                <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                      <img alt="image" src="<?php echo base_url(); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <a href="#" class="btn btn-primary mt-3">Sales</a>
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#"><?=$da[0]->sales_name?></a>
                      </div>
                      <div class="author-box-job"><?=$da[0]->sales_hp?></div>
                      <div class="author-box-description">
                        <p><?=$da[0]->sales_email?></p>
                      </div>      
                    </div>
                  </div>
                </div>    
              </div>        
            </div>

          </div>
        </section>
      </div>