<section class="ftco-no-pb pt-5">
    <div class="container">
        <h4 class="pt-5 text-center font-weight-bold"><?= $title ?></h4>
        <div class="row">
            <div class="col-lg-12 ftco-animate py-md-2 mt-md-2">
                <?php echo session()->info; ?>
                <?= form_open('home/act-yet', ' id="form" ') ?>
                <div class="form-group">
                    <p class="font-weight-bold">Apakah Anda sudah bekerja / Wirausaha ?</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value="1" class="form-check-input as" name="as" checked>Ya
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value class="form-check-input as" name="as">Tidak
                        </label>
                    </div>
                </div>
                <div id="in">
                    <div class="form-group">
                        <label for="username">Posisi Pekerjaan / Wirausaha</label>
                        <input id="workn" type="text" class="form-control" name="workn" autofocus placeholder="Masukan Posisi Pekerjaan / Wirausaha">
                    </div>
                    <div class="form-group">
                        <label for="username">Deskripsikan dimana anda bekerja, berwirausaha</label>
                        <textarea class="form-control" name="work" id="work"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="username">Estimasi Pendapatan Anda</label>
                        <input id="price" type="text" class="form-control" name="price">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Save & Next</button>
                </form>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>