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
        <h4 class="modal-title">Tambah Karyawan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?=form_open(getSegment(1).'/act-kar', " id='form' ")?>
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">                    
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Karyawan">
        </div>

        <div class="form-group">                    
          <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
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