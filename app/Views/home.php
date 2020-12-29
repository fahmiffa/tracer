  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <!-- <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4><?=$title?></h4></div>

              <div class="card-body">              
              <?php echo session()->info; ?>
                <?php echo form_open('act', ' Id="form" ');?>                
                  <div class="form-group">
                    <label for="username">Nama Bank</label>
                    <input id="uname" type="text" class="form-control" name="uname" autofocus>         
                  </div>

                  <div class="form-group">
                    <label for="username">Nomor rekening</label>
                    <input id="rek" type="text" class="form-control" name="rek" >       
                  </div>


                  <div class="form-group">
                    <label for="username">Pilih Metode Jatuh Tempo</label>
                    <select name="temp" id="temp" class="form-control">
                      <option value="0" selected>Per Aktif Layanan</option>
                      <option value="1">Prorate Per Bulan</option>                      
                    </select>    
                  </div>               


                  <div class="form-group d-none" id="tang">
                    <label for="username">Tanggal Jatuh Tempo</label>
                    <input type="number" min="1" max="30" name="date" id="date" class="form-control">        
                  </div>


                  <div class="form-group">
                    <label for="username">Paket Layanan</label>
                    <select name="pac" id="pac" class="form-control">
                      <option value="">Pilih Paket</option>
                      <?php foreach( $da as $row) :?>
                        <option value="<?=$row->services_id?>"><?php echo $row->services_name.' '.$row->services_speed.' '.format_rp($row->services_price); ?></option>
                      <?php endforeach;?>                                     
                    </select>    
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Simpan
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
