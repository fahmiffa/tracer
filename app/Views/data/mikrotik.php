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
                  <div class="card-header">   
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="tabel">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>                            
                            <th>Status</th>                                                                                   
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>        
                        
                        <?php 
                        if ($data != 0) {
                            $no =1;
                            foreach ($data as $row) :?>
                          <tr>
                        <td><?=$no++?></td>
                        <td><?=$row['name']; ?></td>
                        <td><?=hotspot($row['disabled']); ?></td>
                        <td><button class="btn btn-sm btn-warning um" uri="<?=$uri?>" id="<?=$row['name']; ?>"><i class="fa fa-edit"></i></button></td>
                        </tr>                    
                        <?php endforeach;
                        }?>
                                                                              
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>

      