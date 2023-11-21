<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Set Tempat Tidur</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Bank darah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <a class="btn btn-success setbedbtn"><i class="fas fa-plus mr-1"></i> TEMPAT TIDUR</a>                            
                            </div>
                            <form action="<?= base_url('IndikatorPelayanan/setbedsave');?>" method="post">
                            <div class="set_bed">
                            </div>
                            <button type="submit" hidden id="setbedsavebtn" class="btn btn-primary float-right"><i class="far fa-save mr-2"></i>SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <table id="tabel_tempat_sare" class="table table-sm table-hover table-striped table-bordered">
                <thead class="bg-info">
                    <th>Unit</th>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                </thead>
                <?php foreach($tt as $t):?>
                    <tr>
                        <td><?= $t['nama_unit'];?></td>
                        <td><?= $t['tahun'];?></td>
                        <td><?= $t['bulan'];?></td>
                        <td><?= $t['jumlah'];?></td>                        
                    </tr>
                <?php endforeach;?>
           </table>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->