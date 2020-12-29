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
                  <?php echo form_open('act', ' id="form"');?>                                        
                  
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->sales_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-6">
                          <input type="email" name="email" id="email" value="<?php echo !empty($da) ? $da[0]->sales_email : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
     
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Hp</label>
                        <div class="col-sm-6">
                          <input type="number" name="hp" id="hp" value="<?php echo !empty($da) ? $da[0]->sales_hp : ' '; ?>" class="form-control">                        
                        </div>
                      </div>
          
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank</label>
                        <div class="col-sm-6">
                          <input type="text" name="uname" id="uname" value="<?php echo !empty($da) ? $da[0]->prof_bank_name : ' '; ?>" class="form-control">                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-6">
                          <input type="number" name="rek" id="rek" value="<?php echo !empty($da) ? $da[0]->prof_bank : ' '; ?>" class="form-control">                        
                        </div>
                      </div>                          
                      
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Paket</label>
                        <div class="col-sm-6">
                          <input type="text" name="pac" id="pac"  value="<?php echo !empty($da) ? $da[0]->services_name : ' '; ?>" class="form-control" readonly>                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">Update</button>
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