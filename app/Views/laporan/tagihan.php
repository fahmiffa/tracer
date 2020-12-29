      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
          <div class="asu" style="display: contents;">
            <h1><?php echo $title;?></h1>
          </div>                      
          </div>

          <div class="section-body">     

            <div class="row">
              <div class="col-12">
                <div class="card">       
                  <div class="card-body">

                    <div class="table-responsive">
                      <table class="table table-striped lap" id="<?php echo $da;?>">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Billing</th>
                            <th>Client</th>
                            <th>Nominal</th>                            
                            <th>Tanggal</th>
                            <th>PPN 10%</th>                
                            <th>Total</th>
                            <th>Status</th>                                                        
                          </tr>
                        </thead>
                        <tbody>                                                         
                        </tbody>
                         <!-- <tfoot>                                 
                          <tr>
                            <td colspan="6" class="text-center font-weight-bold">Grand Total</td>
                            <td><?php $ppn = $ot[0]->service_price*$ot[0]->reg_ppn/100; ?>
                                <?=format_rp($ot[0]->service_price+$ot[0]->bil_uniq+$ppn)?></td>
                          </tr>
                        </tfoot> -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>