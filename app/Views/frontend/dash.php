<section class="ftco-section pt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 sidebar ftco-animate pl-md-4 py-md-5">
        <?php echo $this->include('frontend/side'); ?>
      </div>

      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">

        <div class="row">
          <?php if ($da && $da[0]->al_stat == 2) { ?>
            <div class="col-sm mb-3">
              <div class="card border-primary shadow-sm">
                <di class="card-header bg-primary text-center">
                  <h4 class="text-white"><i class="fa fa-user font-weight-bold"></i>&nbsp;Data Alumni</h4>
                </di>
                <div class="card-body text-center text-primary">
                  <h1><i class="fa fa-check text-primary font-weight-bold"></i></h1>
                  <smal>Complete</smal>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="col-sm mb-3">
              <div class="card border-danger shadow-sm">
                <di class="card-header bg-danger text-center">
                  <h4 class="text-white"><i class="fa fa-user font-weight-bold"></i>&nbsp;Data Alumni</h4>
                </di>
                <div class="card-body text-center text-danger">
                  <h1><i class="fa fa-remove text-danger font-weight-bold"></i></h1>
                  <smal>Complete</smal>
                </div>
              </div>
            </div>
          <?php } ?>
          <?php if ($pr && $pr[0]->porto_stat == 1) { ?>
            <div class="col-sm">
              <div class="card border-primary shadow-sm">
                <di class="card-header bg-primary text-center">
                  <h4 class="text-white"><i class="fa fa-file font-weight-bold"></i>&nbsp;Data Portofolio</h4>
                </di>
                <div class="card-body text-center text-primary">
                  <h1><i class="fa fa-check text-primary font-weight-bold"></i></h1>
                  <smal>complete</smal>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="col-sm">
              <div class="card border-danger shadow-sm">
                <di class="card-header bg-danger text-center">
                  <h4 class="text-white"><i class="fa fa-file font-weight-bold"></i>&nbsp;Data Portofolio</h4>
                </di>
                <div class="card-body text-center text-danger">
                  <h1><i class="fa fa-remove text-danger font-weight-bold"></i></h1>
                  <smal>Uncomplete</smal>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div> <!-- .col-md-8 -->
    </div>
  </div>
</section>