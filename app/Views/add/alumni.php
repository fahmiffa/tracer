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
                              <?php echo form_open(getSegment(1) . '/act-alumni', ' id="form"'); ?>
                              <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->al_id : ' '; ?>">
                              <div class="card-body">
                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->al_name : ' '; ?>" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">NIS</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="nis" id="nis" value="<?php echo !empty($da) ? $da[0]->al_nis : ' '; ?>" class="form-control" <?php echo !empty($da) ? 'readonly' : ' '; ?>>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Kelas</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="kelas" id="kelas" value="<?php echo !empty($da) ? $da[0]->al_class : ' '; ?>" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Email</label>
                                      <div class="col-sm-6">
                                          <input type="email" name="email" id="email" value="<?php echo !empty($da) ? $da[0]->al_email : ' '; ?>" class="form-control" <?php echo !empty($da) ? 'readonly' : ' '; ?>>
                                      </div>
                                  </div>


                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                      <div class="col-sm-6">
                                          <input type="number" name="in" id="in" value="<?php echo !empty($da) ? $da[0]->al_in : ' '; ?>" class="form-control">
                                      </div>
                                  </div>


                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                      <div class="col-sm-6">
                                          <input type="date" name="birth" id="birth" value="<?php echo !empty($da) ? $da[0]->al_birth : ' '; ?>" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Nomor Hp</label>
                                      <div class="col-sm-6">
                                          <input type="number" name="hp" id="hp" value="<?php echo !empty($da) ? $da[0]->al_hp : ' '; ?>" class="form-control">
                                          <small>Gunakan Format 082324604951</small>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Alamat</label>
                                      <div class="col-sm-6">
                                          <textarea name="al" id="al" class="summernote-simple"><?php echo !empty($da) ? $da[0]->al_addr : ''; ?></textarea>
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
                      </div>
                  </div>
              </div>
          </section>
      </div>