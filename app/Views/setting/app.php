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
                  <?php echo form_open(getSegment(1).'/act-app',' id="form"');?>         
                  <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->app_id : ' '; ?>">                    
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->app_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-6">
                          <input type="text" name="al" id="al" value="<?php echo !empty($da) ? $da[0]->app_addr : ' '; ?>" class="form-control" >
                        </div>
                      </div>
     
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Hp</label>
                        <div class="col-sm-6">
                          <input type="number" name="hp" id="hp" value="<?php echo !empty($da) ? $da[0]->app_hp : ' '; ?>" class="form-control">                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-6">
                        <textarea name="des" id="des" class="summernote-simple"><?php echo !empty($da) ? $da[0]->app_des : '' ;?></textarea>
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