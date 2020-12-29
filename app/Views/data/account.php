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
                                      <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Data</button>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-striped tabel" id="<?php echo $da; ?>">
                                          <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Username</th>
                                                  <th>Pas</th>
                                                  <th>Tipe</th>
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



      <!-- The Modal -->
      <div class="modal" id="myModal">
          <div class="modal-dialog">
              <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title">Tambah Account</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <?php echo form_open(getSegment(1) . '/act-account', ' id="form"'); ?>
                      <input type="hidden" name="id" id="id">
                      <div class="card-body">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Username</label>
                              <div class="col-sm-6">
                                  <input type="text" name="name" id="name" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Password</label>
                              <div class="col-sm-6">
                                  <input type="password" name="pass" id="pass" class="form-control">
                              </div>
                          </div>


                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Tipe</label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="tipe" id="tipe">
                                      <option value="">Pilih Role</option>
                                      <option value="admin">Admin</option>
                                      <option value="alumni">Alumni</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label"></label>
                              <div class="col-sm-6">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                          </div>
                      </div>
                      </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>