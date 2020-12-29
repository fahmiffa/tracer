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
                  <div class="card-body">                           
                  <label class="font-weight-bold h5 text-primary"><i class="fa fa-user-circle"></i>&nbsp;Client Data</label>                             
                      <?php echo form_open(getSegment(1).'/act-reg',' class="wizard-content mt-2" id="form"');?>         
                      <div class="wizard-pane">                                           
                        <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client Data</label>
                            <div class="col-sm-6">
                            <select class="form-control select2" name="cli" id="cli">
                            <option value="" selected>Pilih Client</option>
                              <?php foreach ($ac as $row) :?>
                              <option value="<?=$row->client_id?>"><?=$row->client_name?></option>
                              <?php endforeach;?>                              
                            </select>
                            </div>
                          </div>

                      <label class="font-weight-bold h5 text-primary"><i class="fa fa-globe"></i>&nbsp;Service Data</label>   

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Paket Layanan</label>
                            <div class="col-sm-6">
                            <select class="form-control select2" name="pac" id="pac" uri="<?php echo $uri;?>">
                            <option value="" selected>Pilih Layanan</option>
                              <?php foreach ($pac as $row) :?>
                              <option value="<?=$row->service_id?>"><?=$row->service_name?></option>
                              <?php endforeach;?>
                            </select>
                            </div>
                          </div>


                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                            <div class="pricing pricing-highlight">
                              <div class="pricing-title" id="pa">
                                Paket 1
                              </div>
                              <div class="pricing-padding">
                                <div class="pricing-price">
                                  <h4>Rp.&nbsp;<span id="pr">300.000</span> /<span style="font-size: 20px;">bulan</span></h4>                                                        
                                </div>
                                <div class="pricing-details">
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label"><label>Speed</label> <span id="sp">10 Mbps</span></div>
                                  </div>
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label"><label>Time</label> <span id="tim">30 Hari</span></div>
                                  </div>    
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">24/7 Support</div>
                                  </div>
                                </div>
                              </div>
                            </div>                     
                            </div>
                          </div>

                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Biaya Lain-lain</label>
                            <div class="col-sm-6">
                                <input type="text" name="price" id="price" class="form-control">
                            </div>
                          </div>
                        </div>

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keterangan Biaya lain-lain</label>
                            <div class="col-sm-6">
                            <textarea name="ket" id="ket" class="summernote-simple"><?php echo !empty($da) ? $da['client_addr'] : '' ;?></textarea>
                            </div>
                          </div>

                          
                          <?php if(!empty($ka)) { ?>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                            <select class="form-control select2" name="kat" id="kat">
                            <option value="" selected>Pilih Kategori</option>
                              <?php foreach ($ka as $row) :?>
                              <option value="<?=$row->kategori_id?>"><?=$row->kategori_name?></option>
                              <?php endforeach;?>
                            </select>
                            </div>
                          </div>
                           <?php } ?>
                          

                           <?php if(!empty($ang)) { ?>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Anggaran</label>
                            <div class="col-sm-6">
                            <select class="form-control select2" name="ang" id="ang">
                            <option value="" selected>Pilih Anggaran</option>
                              <?php foreach ($ang as $row) :?>
                              <option value="<?=$row->anggaran_id?>"><?=$row->anggaran_name?></option>
                              <?php endforeach;?>
                            </select>
                            </div>
                          </div>
                           <?php } ?>
                          


                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">PPN 10%</label>
                            <div class="col-sm-6">
                              <label class="custom-switch mt-2">
                                <input type="checkbox" name="ppn" value="10" class="custom-switch-input" checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Tambahkan PPN 10%</span>
                              </label>
                            </div>
                          </div>
                        </div>


                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>    
                        </div>                      
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>