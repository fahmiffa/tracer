      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?php echo $title; ?></h1>
              </div>

              <div class="section-body">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <?php echo session()->info; ?>
                              <div class="card-header">
                                  <div class="ml-auto">
                                      <a class="btn btn-primary" href="<?php echo base_url(getSegment(1) . '/add-' . getSegment(3)); ?>">Tambah Data</a>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-striped tabel" id="<?php echo $da; ?>">
                                          <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Nama</th>
                                                  <th>Jawaban</th>
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