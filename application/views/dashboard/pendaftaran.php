<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Dashboard Pendaftaran RSUD Waled</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
                        <li class="breadcrumb-item active">Dashboard Pendaftaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center"><h3>PASIEN MASUK /  HARI INI <br><?php echo longdate_indo(date('Y-m-d'));?></h3></div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-header bg-success">Pasien Umum</div>
                                        <div class="card-body"><p style="font-size:80px"><?= $total_px['total'];?><span  class="ml-3" style="font-size:30px">Pasien</span></p></div>
                                        <div class="container">
                                        <table class="table table-sm text-center table-hover">
                                            <thead class="bg-secondary">
                                                <th>Unit</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <tr data-toggle="tooltip" data-placement="top" title="klik detail">
                                                    <td>Rawat Inap</td>
                                                    <td><?= $total_px_ranap_umum['total'];?></td>
                                                </tr>
                                                <tr data-toggle="tooltip" data-placement="top" title="klik detail">
                                                    <td>Rawat Jalan</td>
                                                    <td><?= $total_px_rajal_umum['total'];?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                <div class="card">
                                        <div class="card-header bg-info" >Pasien BPJS dan Asuransi Lain</div>
                                        <div class="card-body"><p style="font-size:80px"><?= $total_px_not_umum['total'];?><span style="font-size:30px" class="ml-3">Pasien</span></p></div>
                                        <div class="container">
                                        <table class="table table-sm text-center table-hover">
                                            <thead class="bg-secondary">
                                                <th>Unit</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <tr class="" data-toggle="tooltip" data-placement="top" title="klik detail">
                                                    <td>Rawat Inap</td>
                                                    <td> 100</td>
                                                </tr>
                                                <tr data-toggle="tooltip" data-placement="top" title="klik detail">
                                                    <td>Rawat jalan</td>
                                                    <td> 20</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">copyrigth:SemerusmartREborn2021</div>
                    </div>
                </div>
            </div>
            <div class="borlosstoi" id="borlosstoi">
                <div class="card">
                    <div class="card-header"><h3>Grafik kunjungan pasien / bulan</h3></div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="borlosstoi" id="borlosstoi">
                <div class="card">
                    <div class="card-header"><h3>Grafik kunjungan pasien / tahun</h3></div>
                    <div class="card-body"></div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->