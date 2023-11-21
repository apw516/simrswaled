<div class="row">
    <div class="col-md-8">
        <p class="text-center">
            <strong> <?php if($bulan == '01') :?>JANUARI
            <?php elseif($bulan == '02') :?>FEBRUARI
            <?php elseif($bulan == '03') :?>MARET
            <?php elseif($bulan == '04') :?>APRIL
            <?php elseif($bulan == '05') :?>MEI
            <?php elseif($bulan == '06') :?>JUNI
            <?php elseif($bulan == '07') :?>JULI
            <?php elseif($bulan == '08') :?>AGUSTUS
            <?php elseif($bulan == '09') :?>SEPTEMBER
            <?php elseif($bulan == '10') :?>OKTOBER
            <?php elseif($bulan == '11') :?>NOVEMBER
            <?php elseif($bulan == '12') :?>DESEMBER      
            <?php endif;?></strong>
        </p>

        <div class="chart">
            <!-- Sales Chart Canvas -->
            <canvas id="grafdash" height="130" style="height: 180px;"></canvas>
        </div>
        <!-- /.chart-responsive -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
        <p class="text-center">
            <strong>Kunjungan pasien bulan 
            <?php if($bulan == '01') :?>JANUARI
            <?php elseif($bulan == '02') :?>FEBRUARI
            <?php elseif($bulan == '03') :?>MARET
            <?php elseif($bulan == '04') :?>APRIL
            <?php elseif($bulan == '05') :?>MEI
            <?php elseif($bulan == '06') :?>JUNI
            <?php elseif($bulan == '07') :?>JULI
            <?php elseif($bulan == '08') :?>AGUSTUS
            <?php elseif($bulan == '09') :?>SEPTEMBER
            <?php elseif($bulan == '10') :?>OKTOBER
            <?php elseif($bulan == '11') :?>NOVEMBER
            <?php elseif($bulan == '12') :?>DESEMBER      
            <?php endif;?>
            </strong>
        </p>

        <div class="progress-group">
            Rawat jalan
            <span class="float-right"><b><?= $kunjungan_jenis['rawat_jalan'];?></b>
                pasien</span>
            <div class="progress progress-sm">
                <?php $kapasitas = 1000;?>
                <?php $total_rj = $kunjungan_jenis['rawat_jalan'] / $kapasitas;?>
                <?php $total_ri = $kunjungan_jenis['rawat_inap'] / $kapasitas;?>
                <?php $total_p = $kunjungan_jenis['penunjang'] / $kapasitas;?>
                <?php $total_f = $kunjungan_jenis['farmasi'] / $kapasitas;?>
                <div class="progress-bar bg-primary" style="width: <?= $total_rj;?>%"></div>
            </div>
        </div>
        <!-- /.progress-group -->

        <div class="progress-group">
            Rawat inap
            <span class="float-right"><b><?= $kunjungan_jenis['rawat_inap'];?></b>
                pasien</span>
            <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: <?= $total_ri;?>%"></div>
            </div>
        </div>

        <!-- /.progress-group -->
        <div class="progress-group">
            <span class="progress-text">Penunjang</span>
            <span class="float-right"><b><?= $kunjungan_jenis['penunjang'];?></b>
                pasien</span>
            <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: <?= $total_p;?>%"></div>
            </div>
        </div>
        <div class="progress-group">
            <span class="progress-text">Farmasi</span>
            <span class="float-right"><b><?= $kunjungan_jenis['farmasi'];?></b>
                pasien</span>
            <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: <?= $total_f;?>%"></div>
            </div>
        </div>
        <!-- /.progress-group -->


        <!-- /.progress-group -->

        <!-- /.progress-group -->
    </div>
    <!-- /.col -->
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <h5 class="description-header"><?= $kunjungan_jenis['total'];?> </h5>
                <span class="description-text">TOTAL KUNJUNGAN</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <h5 class="description-header"><?= $px_umum_tahun['total'];?></h5>
                <span class="description-text">PASIEN UMUM</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <h5 class="description-header"><?= $px_bpjs_tahun['total'];?></h5>
                <span class="description-text">PASIEN BPJS</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block">
                <h5 class="description-header"><?= $rm_baru['total'];?></h5>
                <span class="description-text">RM BARU</span>
            </div>
            <!-- /.description-block -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
var ctx = document.getElementById('grafdash').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            "01", "02", "03", "04", "05", "06", "07", "08", "09",
            "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25",
            "26", "27", "28", "29", "30", "31"
        ],
        datasets: [{
            label: 'Jumlah kunjungan pasien',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
                <?php
                if (count($expx)>0) {
                   foreach ($expx as $data) {
                    echo $data->a01 . ", ";
                    echo $data->a02 . ", ";
                    echo $data->a03 . ", ";
                    echo $data->a04 . ", ";
                    echo $data->a05 . ", ";
                    echo $data->a06 . ", ";
                    echo $data->a07 . ", ";
                    echo $data->a08 . ", ";
                    echo $data->a09 . ", ";
                    echo $data->a10 . ", ";
                    echo $data->a11 . ", ";
                    echo $data->a12 . ", ";
                    echo $data->a13 . ", ";
                    echo $data->a14 . ", ";
                    echo $data->a15 . ", ";
                    echo $data->a16 . ", ";
                    echo $data->a17 . ", ";
                    echo $data->a18 . ", ";
                    echo $data->a19 . ", ";
                    echo $data->a20 . ", ";
                    echo $data->a21 . ", ";
                    echo $data->a22 . ", ";
                    echo $data->a23 . ", ";
                    echo $data->a24 . ", ";
                    echo $data->a25 . ", ";
                    echo $data->a26 . ", ";
                    echo $data->a27 . ", ";
                    echo $data->a28 . ", ";
                    echo $data->a29 . ", ";
                    echo $data->a30 . ", ";
                    echo $data->a31 . ", ";                    
                  }
                }
              ?>
            ]
        }]
    },
});