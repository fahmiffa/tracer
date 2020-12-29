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
                  <?php echo form_open(getSegment(1).'/act-client',' id="form"');?>         
                  <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->client_id : ' '; ?>">                    
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Client Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->client_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-6">
                          <input type="text" name="nik" id="nik" value="<?php echo !empty($da) ? $da[0]->client_nik : ' '; ?>" class="form-control">                     
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Client Email</label>
                        <div class="col-sm-6">
                          <input type="email" name="email" id="email" value="<?php echo !empty($da) ? $da[0]->client_email : ' '; ?>" class="form-control" 
                          <?php echo !empty($da) ? 'readonly' : ' '; ?> >
                        </div>
                      </div>
     
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Hp</label>
                        <div class="col-sm-6">
                          <input type="number" name="hp" id="hp" value="<?php echo !empty($da) ? $da[0]->client_hp : ' '; ?>" class="form-control">  
                          <small>Gunakan Format 082324604951</small>                      
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-6">
                        <textarea name="al" id="al" class="summernote-simple"><?php echo !empty($da) ? $da[0]->client_addr : '' ;?></textarea>
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