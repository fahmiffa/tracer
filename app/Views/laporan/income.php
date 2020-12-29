      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $title;?></h1>
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
                            <th>Client</th>
                            <th>Nominal</th>                            
                            <th>Tanggal</th>
                            <th>PPN 10%</th>                            
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>                                                         
                        </tbody>
                         <tfoot>                                 
                          <tr>
                            <td colspan="5" class="font-weight-bold">Target minimal penjualan <?=$pa[0]->services_name?></td>
                            <td class="align-middle"><?php $pak = $pa[0]->services_price;
                                echo format_rp($pak);
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="5" class="font-weight-bold">PPN 10% +  BHP / USO 1.75%</td>
                            <td><?php
                                $n = $ot[0]->service_price;
                                $ppn = $n*$ot[0]->reg_ppn/100; 
                                $nom = $ot[0]->service_price+$ot[0]->bil_uniq+$ppn;
                                $bhp = $n*11.75/100;                                
                                echo '&#32;'.format_rp($bhp);
                                ?>                              
                            </td>
                          </tr>
                          <tr>
                            <td colspan="5" class="font-weight-bold">Grand Total</td>
                            <td class="align-middle"><?php echo format_rp(($nom)-($bhp+$pak));?>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>