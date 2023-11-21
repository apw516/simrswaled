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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Indikator Pelayanan Rumah Sakit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Rawat Inap</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-4">
                            <label for="inputState">Pilih bulan</label>
                            <?php $bulan =  date('m');?>
                            <select id="inputState" class="form-control">
                                <option <?php if($bulan == "01"):?>selected<?php endif;?> value="01">JANUARI</option>
                                <option <?php if($bulan == "02"):?>selected<?php endif;?> value="02">FEBRUARI</option>
                                <option <?php if($bulan == "03"):?>selected<?php endif;?> value="03">MARET</option>
                                <option <?php if($bulan == "04"):?>selected<?php endif;?> value="04">APRIL</option>
                                <option <?php if($bulan == "05"):?>selected<?php endif;?> value="05">MEI</option>
                                <option <?php if($bulan == "06"):?>selected<?php endif;?> value="06">JUNI</option>
                                <option <?php if($bulan == "07"):?>selected<?php endif;?> value="07">JULI</option>
                                <option <?php if($bulan == "08" ):?>selected<?php endif;?> value="08">AGUSTUS</option>
                                <option <?php if($bulan == "09"):?>selected<?php endif;?> value="09">SEPTEMBER</option>
                                <option <?php if($bulan == "10"):?>selected<?php endif;?> value="10">OKTOBER</option>
                                <option <?php if($bulan == "11"):?>selected<?php endif;?> value="11">NOVEMBER</option>
                                <option <?php if($bulan == "12"):?>selected<?php endif;?> value="12">DESEMBER</option>
                            </select>
                        </div>
                        <table class="table table-sm table-responsive table-bordered">
                            <thead>
                            <tr style="font:bold" class="bg-secondary">
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">NO</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">JLH TT</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">RUANGAN</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">PASIEN AWAL</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">PASIEN MASUK</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">TOTAL PASIEN</th>
                                <th colspan="3" style="vertical-align : middle;text-align:center;">PASIEN MENINGGAL</th>
                                <th colspan="3" style="vertical-align : middle;text-align:center;">PASIEN KELUAR</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">PASIEN PULANG (H+M)
                                </th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">PASIEN PINDAH RUANGAN
                                </th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">SISA PASIEN</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">LAMA DIRAWAT</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">HARI RAWAT</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">BOR (%)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">LOS (Hari)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">TOI (Hari)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">BTO (Kali)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">NDR (‰)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">GDR (‰)</th>
                            </tr>
                            <tr class="bg-secondary">
                                <th style="vertical-align : middle;text-align:center;">
                                    < 48 jam</th>
                                <th style="vertical-align : middle;text-align:center;"> > 48 jam</th>
                                <th style="vertical-align : middle;text-align:center;"> Total </th>
                                <th style="vertical-align : middle;text-align:center;"> Perbaikan </th>
                                <th style="vertical-align : middle;text-align:center;"> APS </th>
                                <th style="vertical-align : middle;text-align:center;"> Rujuk </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            <?php $total_tt = 0;
                            $total_mati_kr48 = 0;
                            $total_mati_lb48 = 0;
                            $total_mati_all = 0;
                            $total_perbaikan = 0;
                            $total_aps = 0;
                            $total_rujuk = 0;
                            $total_px_keluar_all = 0;
                            $px_awal_total = 0;
                            $px_masuk_total = 0;
                            $total_px_all = 0;
                            ?>
                            
                            <?php foreach($unit as $u):?>
                            <?php 
                                $kode_unit = $u['kode_unit'];
                                $jlh_tt = $this->model_pencarian->hitung_tempat_tidur($kode_unit);
                                $px_mati_kr48 = $this->model_pencarian->hitung_mati_kr48($kode_unit);
                                $px_mati_lb48 = $this->model_pencarian->hitung_mati_lb48($kode_unit);
                                $px_perbaikan = $this->model_pencarian->hitung_perbaikan($kode_unit);
                                $px_aps = $this->model_pencarian->hitung_aps($kode_unit);
                                $px_rujuk = $this->model_pencarian->hitung_rujuk($kode_unit);
                                $px_awal = $this->model_pencarian->get_pasien_awal($kode_unit);
                                $px_masuk = $this->model_pencarian->get_pasien_masuk($kode_unit);
                                $lama_rawat = $this->model_pencarian->hitung_lama_rawat($kode_unit);
                                // $px_mati = $this->db->query("SELECT 
                                // SUM(IF(id_alasan_pulang = 6,1,0)) AS kr_48
                                // ,SUM(IF(id_alasan_pulang = 7,1,0)) AS lb_48                                
                                // FROM ts_kunjungan
                                // WHERE MONTH(tgl_masuk) = '05'
                                // AND YEAR(tgl_masuk) = '2021'
                                // AND id_alasan_pulang IN (6,7)
                                // AND kode_unit = $kode_unit")->row_array();

                                // $px_keluar = $this->db->query("SELECT 
                                // SUM(IF(id_alasan_pulang = 2,1,0)) AS perbaikan
                                // ,SUM(IF(id_alasan_pulang = 9,1,0)) AS APS                                
                                // ,SUM(IF(id_alasan_pulang = 1,1,0)) AS rujuk                                
                                // FROM ts_kunjungan
                                // WHERE MONTH(tgl_masuk) = '05'
                                // AND YEAR(tgl_masuk) = '2021'
                                // AND kode_unit = $kode_unit")->row_array();

                                // $px_pindah = $this->db->query("SELECT 
                                // SUM(IF(id_alasan_masuk = 13,1,0)) AS perbaikan        
                                // FROM ts_kunjungan
                                // WHERE MONTH(tgl_masuk) = '05'
                                // AND YEAR(tgl_masuk) = '2021'
                                // AND kode_unit = $kode_unit")->row_array();
                            ?>
                            <tr class="text-center">
                                <td><?= $i;?></td>
                                <td><?= $jlh_tt;?></td>
                                <td><?= $u['nama_unit'];?></td>
                                <td><?= $px_awal;?></td>
                                <td><?= $px_masuk;?></td>
                                <td><?= $total_px = $px_awal + $px_masuk;?></td>
                                <td><?= $mati_kr48 = $px_mati_kr48;?></td>
                                <td><?= $mati_lb48 = $px_mati_lb48;?></td>
                                <td><?php echo $total_mati =  $px_mati_kr48 + $px_mati_lb48 ?></td>
                                <td><?= $perbaikan =  $px_perbaikan;?></td>
                                <td><?=  $aps = $px_aps;?></td>
                                <td><?=  $rujuk = $px_rujuk;?></td>
                                <td><?= $total_px_keluar = $total_mati + $px_perbaikan + $px_aps + $px_rujuk ;?>
                                </td>
                                <td></td>
                                <td></td>
                                <td><?=   $lama_rawat['lama_rawat'] ;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>                            
                            <?php
                             $i++;
                             $sub_total_tt = $jlh_tt + $total_tt;
                                $total_tt = $sub_total_tt;

                             $sub_total_mati_kr48 =  $mati_kr48  + $total_mati_kr48; 
                                $total_mati_kr48 = $sub_total_mati_kr48;

                             $sub_total_mati_lb48 =  $mati_lb48  + $total_mati_lb48; 
                                $total_mati_lb48 = $sub_total_mati_lb48;
                             
                             $sub_total_mati =  $total_mati  + $total_mati_all; 
                                $total_mati_all = $sub_total_mati;
                             
                             $sub_total_perbaikan =  $perbaikan  + $total_perbaikan; 
                                $total_perbaikan = $sub_total_perbaikan;

                             $sub_total_aps =  $aps  + $total_aps; 
                                $total_aps = $sub_total_aps;                             

                             $sub_total_rujuk =  $rujuk  + $total_rujuk; 
                                $total_rujuk = $sub_total_rujuk;
                             
                             $sub_total_px_keluar =  $total_px_keluar  + $total_px_keluar_all; 
                                $total_px_keluar_all = $sub_total_px_keluar;
                             
                             $sub_total_px_awal =  $px_awal  + $px_awal_total; 
                                $px_awal_total = $sub_total_px_awal;                             
                             
                             $sub_total_px_masuk =  $px_masuk  + $px_masuk_total; 
                                $px_masuk_total = $sub_total_px_masuk;
                             
                             $sub_total_px =  $total_px  + $total_px_all; 
                                $total_px_all = $sub_total_px;
                             

                             ?>
                            <?php endforeach;?>
                            <tr class="bg-info">
                                <td></td>
                                <td><?=  $total_tt; ?></td>
                                <td>SUBTOTAL</td>
                                <td><?= $px_awal_total;?></td>
                                <td><?= $px_masuk_total;?></td>
                                <td><?= $total_px_all;?></td>
                                <td><?= $total_mati_kr48;?></td>
                                <td><?= $total_mati_lb48;?></td>
                                <td><?= $total_mati_all;?></td>
                                <td><?=  $total_perbaikan;?></td>
                                <td><?= $total_aps;?></td>
                                <td><?= $total_rujuk;?></td>                                  
                                <td><?= $total_px_keluar_all;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->