      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
          <div class="asu" style="display: contents;">
            <h1><?php echo $title;?></h1>
            <button class="btn btn-primary ml-auto send" id="send" uri="<?=$uri?>">Buat Tagihan</button>
          </div>                      
          </div>

          <div class="section-body">     
            <div class="row">
              <div class="col-12">
                <div class="card">       
                  <div class="card-body">

                    <div class="table-responsive">
                      <table class="table table-striped tabel" id="<?php echo $da;?>">
                        <thead>                                 
                          <tr>
                            <th>No.</th>                            
                            <th>Client</th>
                            <th>Nominal</th>                            
                            <th>Mutasi</th>
                            <th>Tanggal Tagihan</th>                                                                    
                            <th>Status</th>                       
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
        <h4 class="modal-title">Pembayaran Tagihan Client</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?=form_open(getSegment(1).'/act-bayar', " id='form' ")?>
        
        <div class="form-group">          
          <input type="hidden" name="bi" value=" " id="bi">
          <input type="text" name="price" id="price" class="form-control" placeholder="Masukan Jumlah Nominal pembayaran">
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