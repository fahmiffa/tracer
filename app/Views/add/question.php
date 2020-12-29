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
                              <?php echo form_open(getSegment(1) . '/act-question', ' id="form"'); ?>
                              <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->q_id : ' '; ?>">
                              <div class="card-body">

                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Qeustion</label>
                                      <div class="col-sm-6">
                                          <textarea name="ques" id="ques" class="summernote-simple"><?php echo !empty($da) ? $da[0]->q_name : ''; ?></textarea>
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