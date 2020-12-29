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
                <?php echo session()->info; ?>          
                  <?php echo form_open('dashboard/act-paket',' id="form"');?>         
                  <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->service_id : ' '; ?>">                    
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->service_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-6">
                        <input type="text" name="price" id="price" value="<?php echo !empty($da) ? $da[0]->service_price : ''; ?>" class="form-control">                   
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Speed</label>
                        <div class="col-sm-6">
                          <input type="text" name="speed" id="speed" value="<?php echo !empty($da) ? $da[0]->service_speed : ' '; ?>" class="form-control">                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Time</label>
                        <div class="col-sm-6">
                          <input type="text" name="time" id="time" value="<?php echo !empty($da) ? $da[0]->service_time : ' '; ?>" class="form-control">                        
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