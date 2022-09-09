<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Training Monthly</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Planing Training</th>
                    <th>Jumlah Training</th>
                    <th>Admin Approval</th>
                    <th>Bod Approval</th>
                    <th>Reject</th>
                </tr>
            </thead>
            <?php

            use Faker\Provider\Base;

            $i = 0;
            foreach ($date as $dates) : ?>
            <tr>
                <td><a
                        href="<?= base_url() ?>/kadiv_accept/<?= $dates->rencana_training ?>"><?= $dates->rencana_training ?></a>
                    <input type="hidden" id="date<?= $i ?>" value="<?= $dates->rencana_training ?>">
                </td>
                <td>
                    <div id="jumlah_training<?= $i ?>"></div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php $i++;
            endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
// $(document).ready(function(i) {
//     const date = $('#date' + i).val()
//     console.log(date)
// $("#jumlah_training" + i).html(
//     `<span>${date}</span>`
// );
// });

// $.ajax({
//     type: 'post',
//     url: "<?= base_url(); ?>/sum_training",
//     async: true,
//     dataType: "json",
//     data: {
//         id_tna: id_tna,
//     },
//     success: function(data) {
//         jQuery.noConflict()
//         window.location.reload()

//     }

// })
</script>
<?= $this->endSection() ?>