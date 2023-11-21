<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Bed Monitoring RSUD Waled</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
                        <li class="breadcrumb-item active">Dashboard Bed Monitoring</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>BED MONITORING<br><?php echo longdate_indo(date('Y-m-d'));?></h3>
                        </div>
                        <div class="card-body">
                        <div class="row justify-content-center text-center">
                        <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas VIP</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '2'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>
                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas I</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered" >
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '3'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>
                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen;">Kelas II</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '4'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == '0'):?>class="bg-danger"<?php endif;?>>
                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        <div class="col-md-4 justify-content-center">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas III</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '5'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>
                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>                            
                            </div>
                        <div class="col-md-3 justify-content-center">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas ICU</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '6'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>
                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>       
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas NICU</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '10'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </table>
                                    </div>
                                </div>                       
                            </div>                        
                        <div class="col-md-3 justify-content-center">
                                <div class="card">
                                    <div class="card-header" style="background-color:palegreen">Kelas PICU</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <thead style="background-color:paleturquoise">
                                                <th>RUANG</th>
                                                <th>Kapasitas</th>
                                                <th>Terpakai</th>
                                                <th>Tersedia</th>
                                            </thead>
                                            <?php foreach($mt_unit as $u):?>
                                            <?php if($u['KODE_UNIT'] == '11'):?>
                                            <?php $tersedia = $u['JUMLAH'] - $u['TERPAKAI'];?>
                                            <tr <?php if($tersedia == 0):?>class="bg-danger"<?php endif;?>>                                                <td><?= $u['RUANG'];?></td>
                                                <td><?= $u['JUMLAH'];?></td>
                                                <td><?= $u['TERPAKAI'];?></td>
                                                <td><?= $tersedia;?></td>
                                            </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->