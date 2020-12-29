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
                  <div class="card-header">                 
                    <div class="ml-auto">
                    <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Import</button>                
                  <a class="btn btn-primary" href="<?php echo base_url(getSegment(1).'/add-client');?>">Tambah Data</a>
                    </div>                                   
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped tabel" id="<?php echo $da;?>">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <?=(session()->role == 'admin' ? '<th>Sales</th>' : '')?>
                            <th>NIK</th>                                                        
                            <th>Email & HP</th>
                            <th>Alamat</th>
                            <?=(session()->role != 'admin' ? '<th>Action</th>' : '')?>
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


      
      <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <a href="<?php echo base_url('assets/data.csv');?>" class="btn btn-sm btn-info mb-3">Sample CSV</a>
        <?php echo form_open(getSegment(1).'/csv',' id="form"');?>
        <div class="form-group">
          <label for="csv">Upload File CSV</label>
          <input type="file" class="form-control" name="csv" id="csv" accept=".csv"/>  
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
      </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>