<section class="ftco-section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 sidebar ftco-animate pl-md-4 py-md-5">
                <?php echo $this->include('frontend/side'); ?>
            </div>

            <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
                <?php echo session()->info; ?>
                <?php echo form_open_multipart('home/act-al', ' id="form" '); ?>
                <input type="hidden" name="nis" value="<?= session()->nama ?>">
                <div class="form-group">
                    <label for="username">Nama</label>
                    <input id="nam" type="text" class="form-control" name="nam" value="<?php echo !empty($al) ? $al[0]->al_name : ' '; ?>">
                </div>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="<?php echo !empty($al) ? $al[0]->al_email : ' '; ?>" <?php echo !empty($al) ? 'readonly' : ' '; ?>>
                </div>

                <div class="form-group">
                    <label for="username">Nomor HP</label>
                    <input id="hp" type="text" class="form-control" name="hp" value="<?php echo !empty($al) ? $al[0]->al_hp : ' '; ?>">
                </div>

                <div class="form-group">
                    <label for="username">Alamat</label>
                    <textarea class="form-control" name="al" id="al"><?php echo !empty($al) ? $al[0]->al_addr : ' '; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Status</label>
                    <select class="form-control" name="works" id="works">
                        <?php if (!empty($al_works)) { ?>
                            <option value="<?= $al[0]->al_works ?>" selected><?= status($al[0]->al_works) ?></option>
                        <?php } ?>
                        <option value="">Pilih Status</option>
                        <option value="1">Bekerja</option>
                        <option value="2">Berwirausaha</option>
                        <option value="0">Belum bekerja</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Posisi Pekerjaan / Wirausaha</label>
                    <input id="workn" type="text" class="form-control" value="<?php echo !empty($aw) ? $aw[0]->work_name : ' '; ?>" name="workn" autofocus placeholder="Masukan Posisi Pekerjaan / Wirausaha">
                </div>

                <div class="form-group">
                    <label for="username">Deskripsikan dimana anda bekerja, berwirausaha atau alasan belum bekerja</label>
                    <textarea class="form-control" name="work" id="work"><?php echo !empty($aw) ? $aw[0]->work_des : ' '; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <div class="form-group custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-xs">
                        Update
                    </button>
                </div>
                </form>

            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>