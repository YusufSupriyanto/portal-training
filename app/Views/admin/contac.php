<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title">Contact</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contact as $Contact) : ?>
                <tr>
                    <td><?= $Contact['nama'] ?></td>
                    <td><?= $Contact['email'] ?></td>
                    <td><?= $Contact['pesan'] ?></td>
                    <td>
                        <form action="<?= base_url() ?>/delete_contact" method="post">
                            <input type="hidden" name="id" value="<?= $Contact['id_contact'] ?>" />
                            <button type="submit" class="btn btn-danger btn-sm"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<?= $this->endSection() ?>