      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Invoice</div>
            </div>
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h2>Invoice</h2>
                      <div class="invoice-number">Order #<?=$da[0]->reg_id?></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
           
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Client Data:</strong><br>
                          <?=$da[0]->client_name?><br>
                          <?=$da[0]->client_email?><br>
                          <?=$da[0]->client_hp?><br>
                          <?=$da[0]->client_addr?>
                        </address>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">  
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Order Date:</strong><br>
                          <?=$da[0]->reg_date?><br><br>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Order Summary</div>                    
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <th data-width="40">No.</th>
                          <th>Paket</th>
                          <th class="text-center">Price</th>
                          <th class="text-center">Speed</th>
                          <th class="text-center">PPN 10%</th>
                          <th class="text-right">Totals</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?=$da[0]->service_name?></td>
                          <td class="text-center"><?=format_rp($da[0]->service_price)?></td>
                          <td class="text-center"><?=$da[0]->service_speed?></td>
                          <td class="text-center"><?= $pn = $da[0]->service_price*10/100?></td>
                          <td class="text-right"><?=format_rp($da[0]->service_price+$pn)?></td>
                        </tr>
                        <tr>                        
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                        <div class="images">
                          <img src="<?php echo base_url(); ?>/assets/logo-bca.png" alt="bca">    
                          <h3 class="ml-4 font-weight-bold text-primary"> 1310479922</h3>
                        </div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <!-- <div class="invoice-detail-name">Subtotal</div>
                          <div class="invoice-detail-value">$670.99</div> -->
                        </div>
                        <div class="invoice-detail-item">
                          <!-- <div class="invoice-detail-name">Shipping</div>
                          <div class="invoice-detail-value">$15</div> -->
                        </div>
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">Rp.&nbsp;<?=format_rp($da[0]->service_price+$da[0]->reg_uniq+$pn)?></div>
                          <small>Sudah Termasuk Kode Unik</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <!-- <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button> -->
                </div>
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
          </div>
        </section>
      </div>
