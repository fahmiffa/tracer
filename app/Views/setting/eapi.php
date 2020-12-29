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
                    <?=form_open(getSegment(1).'/act-api', " id='form' ")?>
                      <input type="hidden" name="id" id="id" value="<?=(!empty($wa)) ? $wa[0]->id_api : ''?>">

                      <div class="form-group">
                      <label>Nama </label>
                        <input type="text" name="name" id="name" class="form-control" value="<?=(!empty($wa)) ? $wa[0]->name_api : ''?>" <?=(!empty($wa)) ? 'readonly' : ''?> >
                      </div>

                      <div class="form-group">
                      <label>Token </label>
                      <textarea class="form-control api" name="token" id="token"><?=(!empty($wa)) ? $wa[0]->api : ''?></textarea>                        
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
