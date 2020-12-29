<section class="ftco-no-pb pt-5">
    <div class="container">
        <h4 class="pt-5 text-center font-weight-bold">Data pribadi</h4>
        <div class="row">
            <div class="col-lg-8 ftco-animate py-md-2 mt-md-2 mx-auto">
                <?php echo session()->info; ?>
                <?php echo form_open_multipart('home/act-step2', ' id="form" '); ?>
                <input type="hidden" name="nis" value="<?= session()->nis ?>">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input id="email" type="email" class="form-control" name="email" autofocus placeholder="Masukan Email">
                </div>

                <div class="form-group">
                    <label for="username">Nomor HP</label>
                    <input id="hp" type="text" class="form-control" name="hp" autofocus placeholder="Masukan Nomor HP">
                </div>

                <div class="form-group">
                    <label for="username">Alamat</label>
                    <textarea class="form-control" name="al" id="al"></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Status</label>
                    <select class="form-control" name="works" id="works">
                        <option value="">Pilih Status</option>
                        <option value="1">Bekerja</option>
                        <option value="2">Berwirausaha</option>
                        <option value="0">Belum bekerja</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="username">Posisi Pekerjaan / Wirausaha</label>
                    <input id="workn" type="text" class="form-control" name="workn" autofocus placeholder="Masukan Posisi Pekerjaan / Wirausaha">
                </div>

                <div class="form-group">
                    <label for="username">Deskripsikan dimana anda bekerja, berwirausaha atau alasan belum bekerja</label>
                    <textarea class="form-control" name="work" id="work"></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Estimasi Pendapatan Anda</label>
                    <input id="price" type="text" class="form-control" name="price">
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <div class="form-group custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Next
                    </button>
                </div>
                </form>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>



<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
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