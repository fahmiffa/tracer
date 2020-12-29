<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
    <div class="col-lg-4 sidebar ftco-animate pl-md-4 py-md-5">
    <?php echo $this->include('es/side'); ?>      
      </div>

      
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">  

      <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
        Tambah Data
      </button>      
        <table class="table table-striped" id="example">
            <thead>                                 
            <tr>
                <th>No.</th>                            
                <th>Name</th>
                <th>Tanggal</th>                               
            </tr>
            </thead>
            <tbody>            
              <?php
              $n=1;
              foreach($da as $row) {?>
                <tr>
                  <td><?=$n++?></td>
                  <td><?=$row->lomba_name?></td>
                  <td><?=trans_date($row->lomba_date)?></td>                  
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div> <!-- .col-md-8 -->
    </div>
  </div>
</section>


<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Tambah Lomba</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?=form_open(getSegment(1).'/act-lom', " id='form' ")?>

        <div class="form-group">
        <select name="lom" id="lom" class="selectpicker" data-live-search="true" data-style="btn-info">
          <option value="">Pilih Lomba</option>
          <?php foreach( $ad as $row) :?>
            <option value="<?=$row->lomba_id?>"><?php echo $row->lomba_name;?></option>
          <?php endforeach;?>                                     
        </select> 
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