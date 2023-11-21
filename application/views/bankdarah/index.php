<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Bank darah ( Stok darah )</h1>
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
                            <a class="btn btn-success stokdarah"><i class="fas fa-plus mr-1"></i> STOK DARAH</a>                            
                            </div>
                            <form action="<?= base_url('Bankdarah/simpanstok');?>" method="post">
                            <div class="tambah-darah">
                            </div>
                            <button type="submit" hidden id="simpanstok" class="btn btn-primary float-right">SIMPAN</button>
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
           <table id="tabelstokdarah" class="table table-sm table-bordered">
                <thead>
                    <th>Nomor kantong</th>
                    <th>Golongan darah</th>
                    <th>Jenis</th>
                    <th>Tanggal expired</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php foreach($stok as $s) :?>
                    <tr>
                        <td><?= $s['nomor_kantong'];?></td>                    
                        <td><?= $s['goldar'];?></td>                    
                        <td><?= $s['jenis'];?></td>                    
                        <td><?= $s['tanggal_exp'];?></td>                    
                        <td>
                            <?php if($s['status'] == 1):?><p class="badge text-success">Tersedia!</p><?php endif;?>
                            <?php if($s['status'] == 3):?><p class="badge badge-secondary text-warning">Sudah dipesan!</p><?php endif;?>
                        </td>                    
                        <td><?php if($s['status'] != 3):?>
                        <!-- <button class="btn btn-success mr-1 pesandarah" id-kantong ="<?= $s['id'];?>" nomor-kantong="<?= $s['nomor_kantong'];?>" data-toggle="modal" data-target="#modalPesanDarah"><i class="fas fa-shipping-fast"></i> -->
                        <button class="btn btn-danger mr-1 hapusdarah" id-kantong ="<?= $s['id'];?>" data-toggle="modal" data-target="#modalhapusDarah"><i class="fas fa-trash-alt"></i><?php endif;?>
                        <button class="btn btn-warning editdarah" id-kantong ="<?= $s['id'];?>" data-toggle="modal" data-target="#modaleditDarah"><i class="fas fa-edit"></i></td>                   
                    </tr>
                <?php endforeach;?>
                </tbody>
           </table>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->