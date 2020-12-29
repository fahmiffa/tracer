<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <?php if (!empty($lok)) {
          foreach ($lok as $row) { ?>
            <h2 class="mb-3"><?= $row->loker_name ?></h2>
            <img src="<?= base_url($row->loker_asset) ?>">
            <p><?= $row->loker_con ?></p>
            <p class="text-small">Sampai Tanggal : <?= date_to_id($row->loker_date) ?></p>
            <a href="#" class="btn btn-success">Daftar</a>
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
</section>