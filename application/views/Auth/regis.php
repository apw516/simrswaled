<div class="container-fluid mt-2">
    <img class="img-fluid imgbanner rounded" style="width: 100%" alt="Responsive image"
        src="<?= base_url('assets/assets/img/LOGIN.png');?>">
    <marquee>
        SELAMAT DATANG DI HALAMAN LOGIN SEMERUSMART ....
    </marquee>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Form registrasi</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <form  method="post" action="<?= base_url('Auth/registration'); ?>">
                    <table class="table table-sm justify-content-center">
                        <tr>
                            <td>Nama lengkap</td>
                            <td><input type="text" class="form-control" name="namalengkap" id="namalengkap"><?= form_error('namalengkap', '<small class="text-danger">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" id="username"><?= form_error('username', '<small class="text-danger">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>Unit kerja</td>
                            <td><input type="text" class="form-control" name="unitkerja" id="unitkerja"><?= form_error('unitkerja', '<small class="text-danger">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>NIP / NIK</td>
                            <td><input type="text" class="form-control" name="nik" id="nik"><?= form_error('nik', '<small class="text-danger">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="password1" id="password1"><?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>Re-password</td>
                            <td><input type="password" class="form-control" name="password2" id="password2"><?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?></td>
                        </tr>
                    </table>                   
                    <button type="submit" class="btn btn-primary float-right mr-1"><i class="fas fa-user-plus mr-3"></i>Daftar</button>
                    <a href="<?= base_url('Auth');?>" class="btn btn-success float-right mr-1"><i class="fas fa-user-plus mr-3"></i>Login</a>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a style="font:italic" class="text-dark"> <img class="img-fluid imgbanner rounded" style="width: 5%"
                            alt="Responsive image" src="<?= base_url('assets/img/logo.png');?>"> copyright :
                        itrsudwaled2021@semerusmart
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>