<section class="ftco-no-pb pt-5">
    <div class="container">
        <h4 class="pt-5 text-center font-weight-bold">DATA QUESTION</h4>
        <div class="row">
            <div class="col-lg-12 ftco-animate py-md-2 mt-md-2">
                <?php echo session()->info; ?>
                <?php echo form_open('act-step1', ' id="form" '); ?>

                <?php
                $x = 1;
                $n = count($qa);
                for ($i = 0; $i < $n; $i++) {
                ?>
                    <div class="form-group">
                        <p><?= $qa[$i]->q_name ?></p>
                        <input id="qa<?= $i ?>" type="text" class="form-control" name="qa<?= $i ?>" required autofocus placeholder="Masukan Jawaban">
                        <input type="hidden" name="id<?= $i ?>" value="<?= $qa[$i]->q_id ?>">
                    </div>
                <?php } ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-SM" tabindex="4">
                        Save
                    </button>
                </div>
                </form>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>



<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="con">
                    <?php echo form_open('home/act', 'id="form" '); ?>
                    <input type="hidden" name="nis" id="nis">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Masukan Tanggal Lahir Anda :</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Next</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>