<section class="ftco-no-pb pt-5">
  <div class="container">
    <?php $da = app('tb_app'); ?>
    <h4 class="pt-5 text-center font-weight-bold"><?= $title ?></h4>
    <div class="row">
      <div class="col-lg-12 ftco-animate py-md-2 mt-md-2 ">
        <?php echo session()->info; ?>
        <?php echo form_open('reg', ' id="forms"'); ?>
        <div class="form-group">
          <label>Cari NIS/Nama/No HP/Alamat/Nama Kelas</label>
          <div class="input-group mb-3">
            <input type="text" id="key" name="key" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Cari&nbsp;<i class="fa fa-search"></i></button>
            </div>
          </div>
          <div id="tag"></div>
        </div>
        </form>
      </div>
      <div class="col-lg-12 ftco-animate" id="data"></div>
    </div>
  </div>
  </div>
</section>



<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <p class="modal-title">Konfirmasi</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="con">
          <?php echo form_open('home/act', 'id="form" '); ?>
          <input type="hidden" name="nis" id="nis">
          <div class="form-group row">
            <div class="col-sm-12">
              <label>Masukan Tanggal Lahir Anda :</label>
              <input type="date" class="form-control" name="date" id="date" required>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Next</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>