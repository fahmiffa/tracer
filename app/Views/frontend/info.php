<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
                <?php if (!empty($inf)) {
                    foreach ($inf as $row) { ?>
                        <h2 class="mb-3"><?= $row->pos_name ?></h2>
                        <p class="text-small"><?= date_to_id($row->pos_date) ?></p>
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url($row->pos_asset) ?>">
                            </div>
                            <div class="col-sm-4 my-auto">
                                <p><?= $row->pos_des ?></p>
                            </div>
                        </div>
                        <hr>
                <?php }
                } ?>
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar ftco-animate pl-md-4 py-md-5">
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Info</h3>
                        <?php
                        $ps = app('tb_pos');
                        foreach ($ps as $row) {
                        ?>
                            <li><a href="<?= base_url('info/' . url_title(strtolower($row->pos_name))) ?>"><?= $row->pos_name ?></a> </li>
                        <?php } ?>
                    </div>
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3>Loker List :</h3>
                    <div class="tagcloud">
                        <?php
                        $lk = app('tb_loker');
                        foreach ($lk as $row) {
                        ?>
                            <a href="<?= base_url('loker/' . url_title(strtolower($row->loker_name))) ?>" class="tag-cloud-link"><?= $row->loker_name ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>