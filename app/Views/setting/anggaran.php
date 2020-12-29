      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">   
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Invoice Paid</h4>
                  </div>
                  <div class="card-body">
                    <?php  $m = date("m"); $p = jum($m,1);
                     echo format_rp($p);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">          
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Invoivce Unpaid</h4>
                  </div>
                  <div class="card-body">
                  <?php $u = jum($m,0);
                     echo format_rp($u);
                    ?>          
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">   
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Invoice</h4>
                  </div>
                  <div class="card-body">
                    <?=format_rp($p+$u)?>
                  </div>
                </div>
              </div>
            </div>
        </div>


          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">                    
                    <button class="btn btn-primary ml-auto akat">Tambah Data</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped tabel" id="<?=$da?>">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Nominal</th>                                                    
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>                                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>




      

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Anggaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?=form_open(getSegment(1).'/act-ang', " id='form' ")?>
        <input type="hidden" name="id" id="idkat" value="">
        <div class="form-group">                    
          <input type="text" name="kat" id="kat" class="form-control" placeholder="Nama Anggaran">
        </div>

        <div class="form-group">                    
          <select class="form-control" name="kate" id="kate">
            <option value="">Pilih Kategori</option>
            <?php foreach ($ka as $row) {?>
            <option value="<?=$row->kategori_id?>"><?=$row->kategori_name?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">                    
          <input type="text" name="price" id="price" class="form-control" placeholder="Nominal">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>