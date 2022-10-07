<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="d-flex flex-wrap">
    <div class="card m-2" style="width:400px;height:480px;">
        <div class="m-2">
            <div class="card-header">
                <h3 class="card-title">Contact Us</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>/send_massage" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama"
                            value="<?= session()->get('nama') ?>" disabled>
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
        <div class="card d-flex justify-content-center align-items-center" style="height:170px;"><i
                class="fa-solid fa-location-dot" style="font-size:30px;"></i>
            <p>Address</p>
            <h6 style="margin-bottom:0px;">HRD PT CENTURY BATTERIES INDONESIA (Ext. 7412)</h6>
            <p style="margin-top:0px;">
                <center>Kawasan Industri Mitra, Jl. Mitra Raya Selatan l Blok E/ No.17-18<br>Parungmulya, Kec. Ciampel,
                    Karawang,Jawa Barat 41363</center>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>