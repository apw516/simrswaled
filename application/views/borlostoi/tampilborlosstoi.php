<div class="container-fluid">
    <table id="borlosstoi_bulanan" class="table table-sm table-hover table-bordered">
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
                <th style="vertical-align : middle;text-align:center;">< 48 jam</th>
                <th style="vertical-align : middle;text-align:center;"> > 48 jam</th>
                <th style="vertical-align : middle;text-align:center;"> Total </th>
                <th style="vertical-align : middle;text-align:center;"> Perbaikan </th>
                <th style="vertical-align : middle;text-align:center;"> APS </th>
                <th style="vertical-align : middle;text-align:center;"> Rujuk </th>
            </tr>
        </thead>
        <tbody>    
           <!-- <?php $i= 1;
           $JML_TT = 0;
           $PASIEN_AWAL = 0;
           $PASIEN_MSK_DAFTAR = 0;

           $KR_48 = 0;
           $LB_48 = 0;
           $PERBAIKAN = 0;
           $APS = 0;
           $RUJUK = 0;
           $PINDAH = 0;
           $SISA = 0;
           $LAMA_DIRAWAT = 0;
           $LAMA_HARI = 0;
           $HM = 0;
           $TOTAL_PASIEN = 0;
           foreach($borlosstoi as $b):?>     
            <tr class="text-center">
               <td><?= $i;?></td>               
               <td><?= $JML_TT1 = $b['JML_TT'];?></td>  
               <td><?= $b['NAMA_RUANGAN'];?></td>  
               <td><?= $PASIEN_AWAL1 = $b['PASIEN_AWAL'];?></td>  
               <td><?= $PASIEN_MSK_DAFTAR1 = $b['PASIEN_MASUK'];?></td>  
               <td><?= $TOTAL_PASIEN1 = $b['TOTAL_PASIEN'];?></td>  
               <td><?= $KR48_1 = $b['M_KR_48'];?></td>  
               <td><?= $LB48_1 = $b['M_LB_48'];?></td>  
               <td><?= $b['TOTAL_KELUAR_MATI'];?></td>  
               <td><?= $PERBAIKAN1 =  $b['PERBAIKAN_SEMBUH'];?></td>  
               <td><?= $APS1 = $b['APS'];?></td>  
               <td><?= $RUJUK1 = $b['REFERAL_RUJUK'];?></td>  
               <td><?= $hm1 = $b['TOTAL_KELUAR_MATI'] + $PERBAIKAN1 + $APS1 + $RUJUK1;?> </td>  
               <td><?= $PINDAH1 = $b['PINDAH_RUANGAN'];?></td>  
               <td><?= $SISA1 = $b['SISA_PASIEN'];?></td>  
               <td><?= $LAMA_DIRAWAT1 = $b['JML_PASIEN_DIRAWAT'];?></td>  
               <td><?= $LAMA_HARI1 = $b['JML_HARI_RAWAT'];?></td>  
               <td><?= $b['BOR'];?></td>  
               <td><?= $b['LOS'];?></td>  
               <td><?= $b['TOI'];?></td>  
               <td><?= $b['BTO'];?></td>  
               <td><?= $b['NDR'];?></td>  
               <td><?= $b['GDR'];?></td>                        
            </tr>
            <?php $i++; 
            $JML_TT = $JML_TT1 + $JML_TT;
            $JML_TT_TOTAL = $JML_TT;
            
            $PASIEN_AWAL = $PASIEN_AWAL1 + $PASIEN_AWAL;
            $PASIEN_AWAL_TOTAL = $PASIEN_AWAL;

            $PASIEN_MSK_DAFTAR = $PASIEN_MSK_DAFTAR1 + $PASIEN_MSK_DAFTAR;
            $PASIEN_MSK_DAFTAR_TOTAL = $PASIEN_MSK_DAFTAR;
            
            $TOTAL_PASIEN = $TOTAL_PASIEN1 + $TOTAL_PASIEN;
            $TOTAL_PASIEN_MASUK = $TOTAL_PASIEN;
            
            $KR_48 = $KR48_1 + $KR_48;
            $KR_48_TOTAL = $KR_48;
            $LB_48 = $LB48_1 + $LB_48;
            $LB_48_TOTAL = $LB_48;
            $TOTAL_MATI =  $LB_48_TOTAL +  $KR_48_TOTAL;

            $PERBAIKAN = $PERBAIKAN1 + $PERBAIKAN;
            $PERBAIKAN_TOTAL = $PERBAIKAN;

            $HM = $hm1 + $HM;
            $HM_TOTAL = $HM;

            $APS = $APS1 + $APS;
            $APS_TOTAL = $APS;
            $RUJUK = $RUJUK1 + $RUJUK;
            $RUJUK_TOTAL = $RUJUK;

            $PINDAH = $PINDAH1 + $PINDAH;
            $TOTAL_PINDAH = $PINDAH;
            
            $SISA = $SISA1 + $SISA;
            $TOTAL_SISA = $SISA;

            $LAMA_DIRAWAT = $LAMA_DIRAWAT1 + $LAMA_DIRAWAT;
            $TOTAL_LAMA_DIRAWAT = $LAMA_DIRAWAT;
            $LAMA_HARI = $LAMA_HARI1 + $LAMA_HARI;
            $TOTAL_LAMA_HARI = $LAMA_HARI;

            endforeach;?>
            <tr class="bg-info text-center">
                <td></td>
                <td><?= $JML_TT_TOTAL;?></td>
                <td>SUBTOTAL</td>
                <td><?= $PASIEN_AWAL_TOTAL;?></td>
                <td><?= $PASIEN_MSK_DAFTAR;?></td>
                <td><?= $TOTAL_PASIEN_MASUK;?></td>
                <td><?= $KR_48_TOTAL;?></td>
                <td><?= $LB_48_TOTAL;?></td>
                <td><?= $TOTAL_MATI;?></td>
                <td><?= $PERBAIKAN_TOTAL;?></td>
                <td><?= $APS_TOTAL;?></td>
                <td><?= $RUJUK_TOTAL;?></td>
                <td><?= $HM_TOTAL;?></td>
                <td><?= $TOTAL_PINDAH;?></td>
                <td><?= $TOTAL_SISA;?></td>
                <td><?= $TOTAL_LAMA_DIRAWAT;?></td>
                <td><?= $TOTAL_LAMA_HARI;?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr> -->
        </tbody>
    </table>
    <table class="table">
        <thead>
            <th>Nama ruangan</th>
            <th>Pasien awal</th>
            <th>Pasien masuk</th>
            <th>Total pasien</th>
            <th>< 48 jam </th>
        </thead>
        <tbody>
            <?php 
        $jmlh_px_awal = 0;
        $jmlh_px_masuk = 0;
        $jmlh_tot_px = 0;
        $jmlh_KR_48 = 0;
        foreach($px_awal as $p):?>
            <tr>
                <td><?= $p['ruangan'];?></td>
                <td><?= $p['jumlah'];?></td>
                <td><?= $p['jumlah_px_masuk'];?></td>
                <td><?= $total_px = $p['jumlah_px_masuk'] + $p['jumlah'];?></td>
                <td><?= $KR48 = $p['kr_48_1'] + $p['kr_48_2'] ;?></td>
            </tr>
            <?php 
            $jmlh_px_awal1 = $p['jumlah'];
            $jmlh_px_awal = $jmlh_px_awal1 + $jmlh_px_awal;
            
            $jmlh_px_masuk1 = $p['jumlah_px_masuk'];
            $jmlh_px_masuk = $jmlh_px_masuk1 + $jmlh_px_masuk;
            
            $jmlh_tot_px1 = $total_px;
            $jmlh_tot_px = $jmlh_tot_px1 + $jmlh_tot_px;  
            
            $jmlh_KR_481 = $KR48;
            $jmlh_KR_48 = $jmlh_KR_481 + $jmlh_KR_48;  
            
            
        endforeach;?>
        <tr>
            <td></td>
            <td><?= $jmlh_px_awal;?></td>
            <td><?= $jmlh_px_masuk;?></td>
            <td><?= $jmlh_tot_px;?></td>
            <td><?= $jmlh_KR_48;?></td>
        </tr>
    </tbody>
    </table>
</div>