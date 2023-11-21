<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Indikator Pelayanan Rumah Sakit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Indikator Pelayanan Rumah Sakit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih ruangan</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <?php foreach($unit as $u):?>
                            <option><?= $u['nama_unit'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div> -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Bulan</label>
                        <select class="form-control" id="pilihbulan" onchange="getborlos()">
                            <?php $m = date('m');?>
                            <?= $m;?>
                            <?php foreach($bulan as $u):?>
                            <option <?php if($m == $u['id_bulan']) :?> selected <?php endif;?>
                                value="<?= $u['id_bulan'];?>"><?= $u['nama_bulan'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="indikatorbor">
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique" class="card-header bg-success">BOR ( % )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $bor;?><span class="ml-3" style="font-size:30px">% <i
                                        class="fas fa-laptop-medical ml-4"
                                        style="font-size:60px;opacity:0.3"></i></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique" class="card-header bg-primary">LOS ( Hari )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $los;?><span class="ml-3" style="font-size:30px">Hari<i
                                        class="fas fa-file-medical-alt ml-4"
                                        style="font-size:60px;opacity:0.3"></i></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique" class="card-header bg-info">TOI ( Hari )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $toi;?><span class="ml-3" style="font-size:30px">Hari<i
                                        class="fas fa-hospital-alt ml-4" style="font-size:60px;opacity:0.3"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique;background-color:coral" class="card-header">BTO (
                            kali )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $bto;?><span class="ml-3" style="font-size:30px">kali<i
                                        class="fas fa-notes-medical ml-4" style="font-size:60px;opacity:0.3"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique" class="card-header bg-warning">NDR ( % )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $ndr;?><span class="ml-3" style="font-size:30px">%<i
                                        class="fas fa-notes-medical ml-4" style="font-size:60px;opacity:0.3"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div style="font-size:28px;font-style:oblique" class="card-header bg-danger">GDR ( % )</div>
                        <div class="card-body">
                            <p style="font-size:40px"><?= $gdr;?><span class="ml-3" style="font-size:30px">%<i
                                        class="fas fa-hand-holding-medical ml-4"
                                        style="font-size:60px;opacity:0.3"></i></span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- <div class="container-fluid bg-dark shadow">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="fas fa-table"></i> Grafik Indikator Pelayanan Rumah Sakit</h4>
                    <div class="card">
                        <div class="container">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container-fluid bg-dark shadow mt-3">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="fas fa-table"></i> Tabel Indikator Pelayanan Rumah Sakit</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal awal</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kemarin"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal akhir</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kedepan"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-primary" onclick="tampilborlosstoi()">Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="borlosstoi" id="borlosstoi">

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
