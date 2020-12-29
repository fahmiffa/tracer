  <div id="app">
      <section class="section">
          <div class="container mt-5">
              <div class="row">
                  <div class="col-12 col-sm-8 offset-sm-2">
                      <div class="login-brand">
                          <!-- <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                      </div>

                      <div class="card card-primary">
                          <div class="card-header">
                              <h4><?= $title ?></h4>
                          </div>

                          <div class="card-body">
                              <?php echo session()->info; ?>
                              <?php echo form_open('reg', ' id="forms"'); ?>
                              <div class="form-group">
                                  <label>Cari NIS/Nama/No HP/Alamat/Nama Kelas</label>
                                  <div class="input-group mb-3">
                                      <input type="text" id="key" name="key" class="form-control" placeholder="Search">
                                      <div class="input-group-append">
                                          <button class="btn btn-primary" type="submit">Cari&nbsp;<i class="fa fa-search"></i></button>
                                      </div>
                                  </div>
                                  <span id="tag"></span>
                              </div>
                              </form>
                          </div>
                          <span id="data"></span>
                      </div>

                      <div class="mt-5 text-muted text-center">
                          <a class="hover text-dark text-decoration-none" href="<?= base_url() ?>">Login</a>
                      </div>
                      <div class="simple-footer">
                          Copyright &copy; develop 2020
                      </div>
                  </div>
              </div>
          </div>
  </div>
  </section>
  </div>



  <!-- The Modal -->
  <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  Modal body..
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

          </div>
      </div>
  </div>