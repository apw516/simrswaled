<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Data billing system</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Data billing system</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <table id="dataBillingsystem" class="table table-sm table-bordered table-hover">
                <thead class="bg-white">
                    <th>Nomor Layanan</th>
                    <th>Nomor RM</th>
                    <th>Nama paien</th>
                    <th>Tanggal entry</th>
                    <th>Unit asal</th>
                    <th>Total layanan</th>
                    <!-- <th>Status</th> -->
                    <th>Detail</th>
                </thead>
                <tbody>
                    <?php foreach($v_ts_kj as $d) : ?>
                    <tr>
                        <td><?= $d['kode_layanan_header'];?><?php if($d['status_layanan'] == '3'):?><span class="badge badge-danger">*retur</span><?php endif;?></td>
                        <td><?= $d['no_rm'];?></td>
                        <td><?= $d['nama_px'];?></td>
                        <td><?= $d['tgl_entry'];?></td>
                        <td><?= $d['nama_unit'];?></td>
                        <td><?= rupiah($d['total_layanan']);?></td>
                        <td class="text-center">
                                <button class="btn btn-info btn-sm detailBilling" data-toggle="modal" data-target="#modalDetailBilling" id="detailBilling" data-id = <?= $d['id_header'];?>><i class="fas fa-eye"></i></button>

                                <a class="btn btn-success btn-sm rincianBiaya"  id="rincianBiaya" data-rm="<?= $d['no_rm'];?>" data-counter="<?= $d['counter'];?>"><i class="fas fa-print"></i></a>


                            <!-- <a href="<?= base_url('Billing/detailLayanan');?>/<?= $d['id_header'];?>"
                                class="btn btn-success btn-sm" title="Lihat detail"><i class="fas fa-eye"></i></a>

                            <button <?php if($d['status_layanan'] == 3):?>disabled <?php endif;?>class="btn btn-info btn-sm printRincian" title="Print rincian" data-id="<?= $d['kode_layanan_header'];?>" id="printRincian"><i class="fas fa-print"></i></button>     

                       <button class="btn btn-danger btn-sm printRincianRetur" title="Print retur" data-id="<?= $d['kode_layanan_header'];?>" id="printRincianRetur"><i class="fas fa-print"></i></button>              
                            <div hidden id="loading" class="spinner-grow" role="status">
                                <span class="sr-only">Loading...</span>
                            </div> -->
                        </td>
                    </tr>                  
                    <?php endforeach;?>
                </tbody>
            </table>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->