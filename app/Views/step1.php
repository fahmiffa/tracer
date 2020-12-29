  <div id="app">
      <section class="section">
          <div class="container mt-5">
              <div class="row">
                  <div class="col-12 col-sm-12 offset-sm-2 col-md-8 offset-md-3 col-lg-6 offset-lg-3 col-xl-6">
                      <div class="login-brand">
                          <!-- <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                      </div>

                      <div class="card card-primary">
                          <div class="card-header">
                              <h4><?= $title ?></h4>
                          </div>

                          <div class="card-body">
                              <?php echo session()->info; ?>
                              <?php echo form_open('act-step1', ' class="needs-validation"  novalidate="" '); ?>

                              <?php
                                $x = 1;
                                $n = count($qa);
                                for ($i = 0; $i < $n; $i++) {
                                ?>
                                  <div class="form-group">
                                      <p><?= $qa[$i]->q_name ?></p>
                                      <input id="qa<?= $i ?>" type="text" class="form-control" name="qa<?= $i ?>" required autofocus placeholder="Masukan Jawaban">
                                      <input type="hidden" name="id<?= $i ?>" value="<?= $qa[$i]->q_id ?>">
                                      <div class="invalid-feedback">
                                          Please fill in your question
                                      </div>
                                  </div>
                              <?php } ?>

                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                      Save
                                  </button>
                              </div>
                              </form>
                          </div>
                      </div>
                      <div class="mt-5 text-muted text-center">
                      </div>
                      <div class="simple-footer">
                          Copyright &copy; develop 2020
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>