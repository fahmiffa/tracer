      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $title;?></h1>
          </div>          

          <div class="section-body">
            <div class="row">
              <div class="col-10">
                <div class="card">
                  <div class="card-body">
                    <?=form_open(getSegment(1).'/act-notif', " id='form' ")?>
                      <input type="hidden" name="id" id="id" value="<?=(!empty($wa)) ? $wa[0]->wa_id : ''?>">

                      <div class="form-group">
                      <label>Nama notif </label>
                        <input type="text" name="wa" id="wa" class="form-control" value="<?=(!empty($wa)) ? $wa[0]->wa_name : ''?>"> 
                      </div>
                      
                      <div class="form-group">                    
                      <label>Template Pesan </label>
                      <textarea  class="form-control" rows="5"  id="msg" name="msg" placeholder="pesan"><?=(!empty($wa)) ? $wa[0]->wa : ''?></textarea>        
                      </div>

                      
                      <div class="form-group">
                      <label>Jatuh Tempo </label>
                        <input type="number" min="1" max="30" name="temp" id="temp" class="form-control" value="<?=(!empty($wa)) ? $wa[0]->temp : ''?>"> 
                      </div>

                      <div class="form-group">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <hr>
                      <p class="font-weight-bold mt-3">Keterangan</p>
                        <ul>
                          <li><b>{pelanggan}</b> adalah variable nama pelanggan yang sudah di set sistem</li>
                          <li><b>{billing} </b>adalah variable nomor invoice yang sudah di set sistem</li>
                          <li><b>{jumlah}</b> adalah variable jumlah tagihan bulanan yang sudah di set sistem</li>
                          <li><b>{tempo}</b> adalah variable tanggal jatuh tempo tagihan bulanan yang sudah di set sistem</li>
                          <li><b>{bca}</b> adalah variable nomor rekening yang sudah di set oleh sistem admin</li>
                          <li><b>{bri}</b> adalah variable nomor rekening yang sudah di set oleh sistem admin</li>
                          <li><b>{reseller}</b> adalah variable nama reseller yang sudah di set sistem </li>
                          <li><b>{variable}</b> adalah variable nama reseller yang sudah di set sistem </li>
                          <li>dan lain-lain, kata yang masuk tanda {} termasuk variable. jangan di ubah untuk format pengiriman </li>
                        </ul>

                        <p class="font-weight-bold mt-3">Format Penulisan</p>
                        <ul>
                          <li>Membuat text-bold (teks tebal) menggunakan kode berikut :</li>
                          <ul>
                            <li>Awali dan akhiri kata dengan tanda * (bintang) </li>
                            <li>contoh *Harga* akan menjadi <b>Harga</b></li>
                          </ul>          
                          <li>Membuat text-italic (teks miring) menggunakan kode berikut :</li>
                          <ul>
                            <li>Awali dan akhiri kata dengan tanda _ (underscore)</li>
                            <li>contoh _Harga_ akan menjadi <i>Harga</i></li>
                          </ul> 
                        </ul>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>