<?php if (session()->role != 'alumni') { ?>
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-5 order-md-last">
                    <div class="login-wrap p-4 p-md-5">
                        <?php echo session()->info; ?>
                        <h3 class="mb-4">login</h3>
                        <?= form_open('login', ' id="form" ') ?>
                        <div class="form-group">
                            <label class="label" for="name">NIS</label>
                            <input type="text" id="uname" name="uname" class="form-control" placeholder="Masukan NIS">
                        </div>
                        <div class="form-group">
                            <label class="label" for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary submit"><span class="fa fa-paper-plane"></span></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Start Work Today</span>
                <h2 class="mb-4">Browse Loker </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $n = count($lok);
            for ($i = 0; $i < $n; $i++) { ?>
                <div class="col-md-3 col-lg-2">
                    <a href="<?= base_url('loker/' . url_title(strtolower($lok[$i]->loker_name))) ?>" class=" course-category img d-flex align-items-center justify-content-center" style="background-image: url(<?= base_url($lok[$i]->loker_asset) ?>);">
                        <div class="text w-100 text-center">
                            <h3><?= $lok[$i]->loker_name ?></h3>

                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="col-md-12 text-center mt-5">
                <a href="<?= base_url('loker') ?>" class="btn btn-secondary">Lihat Semua Lowongan Pekerjaan</a>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(<?php echo base_url(); ?>/asset/images/bg_4.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 d-flex align-items-center">
                    <div class="icon"><span class="flaticon-online"></span></div>
                    <div class="text">
                        <strong class="number" data-number="400">0</strong>
                        <span>Alumni Join</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 d-flex align-items-center">
                    <div class="icon"><span class="flaticon-graduated"></span></div>
                    <div class="text">
                        <strong class="number" data-number="4500">0</strong>
                        <span>Lowongan Pekerjaan</span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 d-flex align-items-center">
                    <div class="icon"><span class="flaticon-instructor"></span></div>
                    <div class="text">
                        <strong class="number" data-number="1200">0</strong>
                        <span>Pembina</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 d-flex align-items-center">
                    <div class="icon"><span class="flaticon-tools"></span></div>
                    <div class="text">
                        <strong class="number" data-number="300">0</strong>
                        <span>Lomba</span>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>

<section class="ftco-section ftco-about img">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-12 about-intro">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="d-flex about-wrap">
                            <?php $ps = app('tb_pos'); ?>
                            <div class="img d-flex align-items-center justify-content-center" style="background-image:url(<?php echo base_url($ps[0]->pos_asset); ?>);">
                            </div>
                            <div class="img-2 d-flex align-items-center justify-content-center" style="background-image:url(<?php echo base_url($ps[1]->pos_asset); ?>);">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 py-5">
                        <div class="row justify-content-start pb-3">
                            <div class="col-md-12 heading-section ftco-animate">
                                <span class="subheading">Info</span>
                                <h2 class="mb-4"><?= $ps[0]->pos_name ?></h2>
                                <p><?= $ps[0]->pos_des ?></p>
                                <p><a href="<?= base_url('info') ?>" class="btn btn-primary">All Info</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>