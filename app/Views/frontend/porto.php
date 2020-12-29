<section class="ftco-section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 sidebar ftco-animate pl-md-4 py-md-5">
                <?php echo $this->include('frontend/side'); ?>
            </div>
            <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
                <?php if (!$pr) { ?>
                    <button type="button" class="btn btn-primary btn-sm mb-3 float-left" data-toggle="modal" data-target="#myModal">
                        Tambah Data
                    </button>
                <?php } else { ?>
                    <blockquote class="blockquote">
                        <p class="mb-0"><?= $pr[0]->porto_des ?></p>
                    </blockquote>
                    <hr>
                    <?php
                    $n = json_decode($pr[0]->porto_asset);
                    for ($i = 0; $i < count($n); $i++) { ?>

                        <img width="30%" src="<?= base_url($n[$i]) ?>">
                <?php }
                }  ?>

            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>


<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?= form_open('act-porto', " id='form' ") ?>

                <div class="form-group">
                    <label for="username">Deskripsikan tentang Anda</label>
                    <textarea class="form-control" name="des" id="des"></textarea>
                </div>

                <div class="form-group">
                    <label>Upload Berkas</label>

                    <div class="dropzone">
                        <div class="dz-message">
                            <h3> Klik atau Drop gambar atau file disini</h3>
                        </div>
                        <div id="in"></div>
                    </div>
                </div>s
                <div class="form-group">

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>




<script type="text/javascript">
    Dropzone.autoDiscover = false;

    var foto_upload = new Dropzone(".dropzone", {
        url: "<?= base_url('upload') ?>",
        maxFilesize: 2,
        method: "post",
        acceptedFiles: "image/*",
        paramName: "userfile",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        addRemoveLinks: true,
        success: function(data) {
            console.log(data.xhr.response);
            var da = data.xhr.response;
            $("#in").append("<input type='hidden' name='gambar[]' value='" + da + "'>");
            $(".dz-remove").attr("href", da);
        },
        error: function() {
            console.log(data);

        }
    });


    //Event ketika foto dihapus
    foto_upload.on("removedfile", function(a) {

        var da = a.xhr.response;

        $.ajax({
            type: "post",
            data: {
                token: da
            },
            url: "<?= base_url('remove') ?>",
            cache: false,
            dataType: 'json',
            success: function() {
                console.log("Foto terhapus");
            },
            error: function() {
                console.log("Error");

            }
        });

        $("input[value='" + da + "']").remove();
    });


    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambar").change(function() {
            readURL(this);
        });
    });
</script>