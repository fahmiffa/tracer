      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Alumni</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-7">
                <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                      <?php if (!empty($jan->al_asset)) { ?>
                        <img alt="image" src="<?php echo base_url($jan->al_asset); ?>" class="rounded-circle author-box-picture">
                      <?php } else { ?>
                        <img alt="image" src="<?php echo base_url(); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                      <?php } ?>
                      <div class="clearfix"></div>
                      <a href="#" class="btn btn-primary mt-3">Alumni</a>
                    </div>
                    <div class="author-box-details">
                      <table class="table table-borderless">
                        <tbody>
                          <tr>
                            <td>Nama</td>
                            <td><?= $jan->al_name ?></td>
                          </tr>
                          <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= date_to_id($jan->al_birth) ?></td>
                          </tr>
                          <tr>
                            <td>Kelas</td>
                            <td><?= $jan->al_class ?></td>
                          </tr>
                          <tr>
                            <td>Tahun Masuk</td>
                            <td><?= $jan->al_in ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr>
                    <p class="font-weight-bold">Histori Pekerjaan</p>
                    <div class="table-responsive">
                      <table class="table table-striped tabel" id="<?php echo $da; ?>">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Pendapatan</th>
                            <th>Tanggal</th>
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