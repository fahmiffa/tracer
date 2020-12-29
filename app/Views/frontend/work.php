<section class="ftco-no-pb pt-5">
    <div class="container">
        <h4 class="pt-5 text-center font-weight-bold"><?= $title ?></h4>
        <div class="row">
            <div class="col-lg-12 ftco-animate py-md-2 mt-md-2">
                <?php echo session()->info; ?>
                <?= form_open('home/act-done', ' id="form" ') ?>
                <div class="form-group">
                    <p class="font-weight-bold">Apakah Anda masih bekerja / Wirausaha sebagai <?= $cr->work_name ?> ?</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value="1" class="form-check-input" name="work" checked>Ya
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value="0" class="form-check-input" name="work">Tidak
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Apakah ada pergantian posisi/perubahan gaji/penghasilan ?</p>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value="1" class="form-check-input as" name="as" id="as" checked>Ya
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" value="" class="form-check-input as" name="as">Tidak
                        </label>
                    </div>
                </div>
                <div id="in">
                    <div class="form-group">
                        <label for="username">Posisi Pekerjaan / Wirausaha</label>
                        <input id="workn" type="text" class="form-control" name="workn" autofocus placeholder="Masukan Posisi Pekerjaan / Wirausaha">
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