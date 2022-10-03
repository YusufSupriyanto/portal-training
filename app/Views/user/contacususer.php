<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex flex-wrap">
    <div class="m-2 flex-fill bd-highlight h-100 d-inline-block ">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Contact Us</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>/send_massage" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="Email" class="form-control" name="email" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea class="form-control" rows="3" name="pesan" placeholder="Masukan Pesan ..."></textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <div class="m-2 flex-fill bd-highlight h-100 d-inline-block ">
        <div class="card d-flex justify-content-center align-items-center" style="height:139px;"><i
                class="fa-brands fa-whatsapp" style="font-size:30px;"></i>
            <p>Contact</p>
            <a href="https://wa.me/+6282313403747">Hubungi Saya</a>
        </div>
        <div class="card d-flex justify-content-center align-items-center" style="height:139px;"><i
                class="fa-solid fa-envelope" style="font-size:30px;"></i>
            <p>E-mail</p>
            <a
                href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=rifsilhana.yunratika@incoe.astra.co.id">rifsilhana.yunratika@incoe.astra.co.id</a>
        </div>
        <div class="card d-flex justify-content-center align-items-center" style="height:139px;"><i
                class="fa-solid fa-location-dot" style="font-size:30px;"></i>
            <p>Address</p>
            <a
                href="https://www.google.com/maps/place/PT.+Century+Batteries+Indonesia/@-6.374713,107.3156649,17z/data=!4m6!3m5!1s0x2e6975dcd6af7e2f:0x7b284eb4eddc2d81!4b1!8m2!3d-6.3747838!4d107.3179866">Location</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>