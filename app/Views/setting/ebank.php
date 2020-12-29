      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $title;?></h1>
          </div>          

          <div class="section-body">
            <div class="row">
              <div class="col-10">
                <div class="card">
                  <div class="card-body">
                    <?=form_open(getSegment(1).'/act-bank', " id='form' ")?>
                      <input type="hidden" name="id" id="id" value="<?=(!empty($wa)) ? $wa[0]->bank_id : ''?>">

                      <div class="form-group">
                      <label>Nama Bank </label>
                        <input type="text" name="bank" id="bank" class="form-control" value="<?=(!empty($wa)) ? $wa[0]->bank_name : ''?>"> 
                      </div>

                      <div class="form-group">
                      <label>Rekening </label>
                        <input type="text" name="rek" id="rek" class="form-control" value="<?=(!empty($wa)) ? $wa[0]->bank_rek : ''?>"> 
                      </div>                          

                      <div class="form-group">
                      <button type="submit" class="btn btn-primary">Simpan</button>                      
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>
