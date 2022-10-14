<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1 overflow-auto">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
        <form action="<?= base_url() ?>/upload_history" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="hidden" value="<?= $id ?>" name="id_user">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append"></div>
                <button type="submit" class="input-group-text" id="">Upload</button>
            </div>
        </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover overflow-auto" id="example">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Materi Training</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Penyelenggara</th>
                    <th>Tempat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($history as $histories) : ?>
                <tr>
                    <td>
                        <input type="hidden" id="id<?= $i ?>" value="<?= $histories['id_tna'] ?>">
                        <?= $histories['nama'] ?>
                    </td>
                    <td>
                        <h6 style="width:300px;"><?= $histories['training'] ?></h6>
                    </td>
                    <td>
                        <h6 style="width:100px;"><?= $histories['mulai_training'] ?></h6>
                    </td>
                    <td>
                        <h6 style="width:100px;"><?= $histories['rencana_training'] ?></h6>
                    </td>

                    <td><?= $histories['vendor'] ?></td>
                    <td><?= $histories['tempat'] ?></td>
                    <?php if ($histories['keterangan'] == null) : ?>
                    <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#exampleModalLong" onclick="upload(<?= $i ?>)">
                            Confirm
                        </button>
                    </td>
                    <?php else : ?>
                    <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#exampleModal<?= $i ?>" onclick="upload(<?= $i ?>)" style="width:65px;">
                            Edit
                        </button>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url() ?>/sertifikat_upload" method="post" id="form<?= $i ?>"
            enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <thead class="table">
                            <tr>
                                <th scope="col">Sertifikat</th>
                                <th scope="col">Keterangan Lulus/Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <input type="file" name="file" Accept="Application/Pdf" id="file">
                                    <input type="hidden" name="history" id="history">
                                </th>
                                <td>
                                    <input type="text" name="keterangan" id="keterangan">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function upload(i) {
    console.log(i)
    jQuery.noConflict()
    $('#exampleModal').modal('show');
    var id = $('#id' + i).val()
    $('#exampleModal #history').val(id)


}
</script>
<?= $this->endSection() ?>