      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $title;?></h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    
                    <a class="btn btn-primary ml-auto" href="<?php echo base_url(getSegment(1).'/add-sales');?>">Tambah Data</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped tabel" id="<?php echo $da;?>">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Id Sales</th>
                            <th>Name</th>
                            <th>Email</th>                            
                            <th>Nomor HP</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>                                                           
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>