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
                  <?php echo form_open(getSegment(1).'/act-sales',' id="form"');?>         
                  <input type="hidden" name="id" value="<?php echo !empty($da) ? $da[0]->sales_id : ' '; ?>">                    
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sales Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" id="name" value="<?php echo !empty($da) ? $da[0]->sales_name : ' '; ?>" class="form-control">                     
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sales Email</label>
                        <div class="col-sm-6">
                          <input type="email" name="email" id="email" value="<?php echo !empty($da) ? $da[0]->sales_email : ' '; ?>" class="form-control" 
                          <?php echo !empty($da) ? 'readonly' : ' '; ?> >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="pass" id="pass"  class="form-control">                      
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Hp</label>
                        <div class="col-sm-6">
                          <input type="number" name="hp" id="hp" value="<?php echo !empty($da) ? $da[0]->sales_hp : ' '; ?>" class="form-control">    
                          <small>Gunakan Format 082324604951</small>                                          
                        </div>
                      </div>
                      
                      
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Paket Layanan</label>
                        <div class="col-sm-6">
                      <select name="ser" id="ser" class="form-control">
                          <option value="">Pilih Layanan</option>
                          <?php foreach( $ad as $row) :?>
                          <?php if(!empty($da)) {
                             if($da[0]->prof_paket==$row->services_id) { ?>
                            <option value="<?=$row->services_id?>" selected><?php echo $row->services_name.' '.$row->services_speed.' '.format_rp($row->services_price); ?></option>
                          <?php } else { ?>
                            <option value="<?=$row->services_id?>"><?php echo $row->services_name.' '.$row->services_speed.' '.format_rp($row->services_price); ?></option>
                          <?php } } else {?>
                            <option value="<?=$row->services_id?>"><?php echo $row->services_name.' '.$row->services_speed.' '.format_rp($row->services_price); ?></option>
                          <?php } ?>
                          <?php endforeach;?>                                     
                        </select>                                          
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