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
                  <?php echo form_open(getSegment(1).'/act-mikro',' id="form"');?>         
                  <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->api_id : ' '; ?>">                    
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ip local mikrotik</label>
                        <div class="col-sm-6">
                          <input type="text" name="ip" id="ip" value="<?php echo !empty($da) ? $da[0]->api_uri : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">username mikrotik</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->api_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">password mikrotik</label>
                        <div class="col-sm-6">
                          <input type="password" name="pass" id="pass" value="<?php echo !empty($da) ? $da[0]->api_pass : ' '; ?>" class="form-control" >
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