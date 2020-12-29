  <div id="app">
      <section class="section">
          <div class="container mt-5">
              <div class="row">
                  <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                      <div class="login-brand">
                      </div>

                      <div class="card card-primary">
                          <div class="card-header">
                              <h4><?= $title ?></h4>
                          </div>

                          <div class="card-body">
                              <?php echo session()->info; ?>
                              <?php echo form_open('act-step2', ' id="form" '); ?>
                              <input type="hidden" name="nis" value="<?= session()->nis ?>">
                              <div class="form-group">
                                  <label for="username">Email</label>
                                  <input id="email" type="email" class="form-control" name="email" autofocus placeholder="Masukan Email">
                              </div>

                              <div class="form-group">
                                  <label for="username">Nomor HP</label>
                                  <input id="hp" type="text" class="form-control" name="hp" autofocus placeholder="Masukan Nomor HP">
                              </div>

                              <div class="form-group">
                                  <label for="username">Tanggal Lahir</label>
                                  <input id="birth" type="date" class="form-control" name="birth" autofocus placeholder="Masukan Tanggal lahir">
                              </div>

                              <div class="form-group">
                                  <label for="username">Alamat</label>
                                  <textarea class="form-control" name="al" id="al"></textarea>
                              </div>


                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                      Next
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