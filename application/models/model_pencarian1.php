<?php
class model_pencarian extends CI_Model
{       
public function getPasienRI($nomor_rm,$nama_pasien,$alamat)
    {
        //rawatinap
        $query = $this->db->query("call SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('$nomor_rm','$nama_pasien','$alamat')",5);
        return $query->result_array();
    }
public function getPasienRJ($nomor_rm,$nama_pasien,$alamat,$unit,$tgl)
    {
        //rawatjalan
        $query = $this->db->query("call SP_PANGGIL_PASIEN_RAWAT_JALAN('$nomor_rm','$nama_pasien','$alamat','$unit','$tgl')");
        return $query->result_array();
    }
    public function getAllLayanan($kode_unit)
    {
        $t = ['0'];      
        $this->db->where_not_in('tarif',$t);//berdasarkan login
        $this->db->where('kode_unit',$kode_unit);//berdasarkan login
        return $this->db->get('view_panggil_tarif')->result_array();
    }
    public function getLayanan($layanan,$kelas_tarif,$kode_unit)
    {
        $t = ['0'];
        $this->db->where('kelas_tarif',$kelas_tarif);
        $this->db->where_not_in('tarif',$t);//berdasarkan login
        $this->db->where('kode_unit',$kode_unit);//berdasarkan login
        $this->db->like('Tindakan',$layanan);
        return $this->db->get('view_panggil_tarif')->result_array();
    }
    public function search_bulan($unit)
    {
        $this->db->like('nama_bulan', $unit , 'both');
        $this->db->order_by('id_bulan', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mt_bulan')->result();
    }
    public function search_unit($unit)
    {
        $this->db->where('kelas_unit', 1 , 'both');
        $this->db->like('nama_unit', $unit , 'both');
        $this->db->order_by('nama_unit', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mt_unit')->result();
    }
    public function search_unit_ranap($unit)
    {
        $this->db->where('kelas_unit', 2 , 'both');
        $this->db->like('nama_unit', $unit , 'both');
        $this->db->order_by('nama_unit', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mt_unit')->result();
    }
    public function search_dokter($nama_paramedis)
    {
        $this->db->where('keilmuan', 'dr' , 'both');
        $this->db->like('nama_paramedis', $nama_paramedis , 'both');
        $this->db->order_by('nama_paramedis', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mt_paramedis')->result();
    }
    function get_kode_layanan_header($prefix)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_trx_layanan,6)) AS kd_max FROM mt_nomor_trx");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $prefix . date('ymd') . $kd;
        // $q = $this->db->query("SELECT MAX(RIGHT(kode_layanan_header,6)) AS kd_max FROM ts_layanan_header");
        // $kd = "";
        // if ($q->num_rows() > 0) {
        //     foreach ($q->result() as $k) {
        //         $tmp = ((int) $k->kd_max) + 1;
        //         $kd = sprintf("%06s", $tmp);
        //     }
        // } else {
        //     $kd = "0001";
        // }
        // date_default_timezone_set('Asia/Jakarta');
        // return $prefix . date('ymd') . $kd;
    }
    function get_kode_layanan_detail()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_layanan_detail,6)) AS kd_max FROM ts_layanan_detail");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    function getNoPeriksa_new($prefix)
    {
        // $y = date('y');
        // $d = date('m');
        // $tdy = $y.$d;
        // $q = $this->db->query("SELECT MAX(RIGHT(id,2)) AS kd_max FROM mt_nomor_expertisi_pa WHERE SUBSTRING(id,1,1)='$prefix' AND SUBSTRING(id,3,4)= $tdy");
        // $kd = "";        
        // if ($q->num_rows() > 0) {
        //     foreach ($q->result() as $k) {
        //         $tmp = ((int) $k->kd_max) + 1;
        //         $kd = sprintf("%02s", $tmp);
        //     }
        // } else {
        //     $kd = "01";
        // }
        // date_default_timezone_set('Asia/Jakarta');
        // return $prefix .'-' . date('ym') . $kd;
    }
    function getNoPeriksa($prefix)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_periksa,5)) AS kd_max FROM ts_hasil_expertisi_pa");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $prefix .'-' . date('ymd') . $kd;
    }
    
    function count_ex()
    {
        $YEAR = date('Y');
        $query = $this->db->query("SELECT  
        COUNT(IF( MONTH(tgl_baca) = 01, id_detail, NULL)) AS Januari,
        COUNT(IF( MONTH(tgl_baca) = 02, id_detail, NULL)) AS Februari,
        COUNT(IF( MONTH(tgl_baca) = 03, id_detail, NULL)) AS Maret,
        COUNT(IF( MONTH(tgl_baca) = 04, id_detail, NULL)) AS April,
        COUNT(IF( MONTH(tgl_baca) = 05, id_detail, NULL)) AS Mei,
        COUNT(IF( MONTH(tgl_baca) = 06, id_detail, NULL)) AS Juni,
        COUNT(IF( MONTH(tgl_baca) = 07, id_detail, NULL)) AS Juli,
        COUNT(IF( MONTH(tgl_baca) = 08, id_detail, NULL)) AS Agustus,
        COUNT(IF( MONTH(tgl_baca) = 09, id_detail, NULL)) AS September,
        COUNT(IF( MONTH(tgl_baca) = 10, id_detail, NULL)) AS Oktober,
        COUNT(IF( MONTH(tgl_baca) = 11, id_detail, NULL)) AS November,
        COUNT(IF( MONTH(tgl_baca) = 12, id_detail, NULL)) AS Desember
        FROM ts_hasil_expertisi_pa WHERE year(tgl_baca) = $YEAR");
        return $query->result();
    }    
    function count_extdy()
    {
        $YEAR = date('Y');
        $MONTH = date('m');
        $DAY = date('d');
        $query = $this->db->query("SELECT COUNT(id) AS jlh FROM ts_hasil_expertisi_pa WHERE year(tgl_baca) = $YEAR AND DAY(tgl_baca) = $DAY AND MONTH(tgl_baca) = $MONTH");
        return $query->row_array();
    }    
   
    function getRincian($kode)
    {
        $query =$this->db->query("SELECT ts_layanan_header.kode_kunjungan 
        ,mt_pasien.no_rm
        ,mt_pasien.nama_px
        ,ts_layanan_detail.kode_tarif_detail
        ,ts_layanan_detail.total_tarif
        ,ts_layanan_detail.jumlah_layanan
        ,ts_layanan_detail.jumlah_retur
        ,ts_layanan_detail.total_layanan
        ,ts_layanan_detail.kode_tarif_detail
        ,mt_tarif_detail.KODE_TARIF_HEADER
        ,mt_tarif_header.NAMA_TARIF
        FROM ts_layanan_header JOIN ts_layanan_detail 
        ON ts_layanan_header.kode_layanan_header = ts_layanan_detail.kode_layanan_header
        JOIN ts_kunjungan ON ts_layanan_header.kode_kunjungan = ts_kunjungan.kode_kunjungan
        JOIN mt_pasien ON ts_kunjungan.no_rm = mt_pasien.no_rm
        JOIN mt_tarif_detail ON ts_layanan_detail.kode_tarif_detail = mt_tarif_detail.KODE_TARIF_DETAIL
        JOIN mt_tarif_header ON mt_tarif_header.KODE_TARIF_HEADER = mt_tarif_detail.KODE_TARIF_HEADER
        WHERE ts_layanan_header.id = '$kode'");
        return $query->result_array();
    }
    function count_pxrajal_TODAY()
    {
        $YEAR = date('Y');
        $DAY = date('d');
        $month = date('m');
        $query = $this->db->query("SELECT COUNT(IF(kode_penjamin = 'P01',kode_kunjungan, NULL)) AS pasien_umum,
        COUNT(IF(kode_penjamin != 'P01'  ,kode_kunjungan, NULL)) AS pasien_bpjs 
         FROM ts_kunjungan WHERE YEAR(tgl_masuk) = $YEAR AND DAY(tgl_masuk) = $DAY AND MONTH(tgl_masuk) = $month AND (SUBSTRING(kode_unit, 1,1) != 2) AND status_kunjungan != 8");
        return $query->row_array();
    }
    function count_pxranap_TODAY()
    {
        $YEAR = date('Y');
        $DAY = date('d');
        $month = date('m');
        $query = $this->db->query("SELECT COUNT(IF(kode_penjamin = 'P01',kode_kunjungan, NULL)) AS pasien_umum,
        COUNT(IF(kode_penjamin != 'P01',kode_kunjungan, NULL)) AS pasien_bpjs 
         FROM ts_kunjungan WHERE YEAR(tgl_masuk) = $YEAR AND DAY(tgl_masuk) = $DAY AND MONTH(tgl_masuk) = $month AND (SUBSTRING(kode_unit, 1,1) = 2) AND status_kunjungan != 8");
        return $query->row_array();
    }
    function hitung_rajal_today()
    {
        $YEAR = date('Y');
        $DAY = date('d');
        $month = date('m');
        $query = $this->db->query(" SELECT COUNT(*) AS rajal FROM ts_kunjungan WHERE (SUBSTRING(kode_unit, 1,1) != 2) AND YEAR(tgl_masuk) = '$YEAR'
        AND MONTH(tgl_masuk) = '$month' AND DAY(tgl_masuk) = ' $DAY' AND status_kunjungan != 8");
        return $query->row_array();
    }  
    function hitung_ranap_today()
    {
        $YEAR = date('Y');
        $DAY = date('d');
        $month = date('m');
        $query = $this->db->query(" SELECT COUNT(*) AS ranap FROM ts_kunjungan WHERE (SUBSTRING(kode_unit, 1,1) = 2) AND YEAR(tgl_masuk) = '$YEAR'
        AND MONTH(tgl_masuk) = '$month' AND DAY(tgl_masuk) = ' $DAY' AND status_kunjungan != 8");
        return $query->row_array();
    }
    function count_kunjungan()
    {
        $YEAR = date('Y');
        $query = $this->db->query("SELECT  
        COUNT(IF( MONTH(tgl_masuk) = 01, kode_kunjungan, NULL)) AS Januari,
        COUNT(IF( MONTH(tgl_masuk) = 02, kode_kunjungan, NULL)) AS Februari,
        COUNT(IF( MONTH(tgl_masuk) = 03, kode_kunjungan, NULL)) AS Maret,
        COUNT(IF( MONTH(tgl_masuk) = 04, kode_kunjungan, NULL)) AS April,
        COUNT(IF( MONTH(tgl_masuk) = 05, kode_kunjungan, NULL)) AS Mei,
        COUNT(IF( MONTH(tgl_masuk) = 06, kode_kunjungan, NULL)) AS Juni,
        COUNT(IF( MONTH(tgl_masuk) = 07, kode_kunjungan, NULL)) AS Juli,
        COUNT(IF( MONTH(tgl_masuk) = 08, kode_kunjungan, NULL)) AS Agustus,
        COUNT(IF( MONTH(tgl_masuk) = 09, kode_kunjungan, NULL)) AS September,
        COUNT(IF( MONTH(tgl_masuk) = 10, kode_kunjungan, NULL)) AS Oktober,
        COUNT(IF( MONTH(tgl_masuk) = 11, kode_kunjungan, NULL)) AS November,
        COUNT(IF( MONTH(tgl_masuk) = 12, kode_kunjungan, NULL)) AS Desember
        FROM ts_kunjungan WHERE year(tgl_masuk) = $YEAR  AND status_kunjungan  NOT IN (8,11) ");
        return $query->result();
    }
    function count_kunjungan_jenis()
    {
        $YEAR = date('Y');
        $query = $this->db->query("SELECT  
        SUM(IF(kelas_unit = 1 OR a.kode_unit IN ('3007','3009','3010'),1,0))AS rawat_jalan
        ,SUM(IF(kelas_unit = 2 ,1,0))AS rawat_inap
        ,SUM(IF(kelas_unit = 3 AND a.kode_unit NOT IN ('3007','3009','3010'),1,0))AS penunjang
        ,SUM(IF(kelas_unit = 4 ,1,0))AS farmasi
    
        ,SUM(IF(kelas_unit = 1 OR a.kode_unit IN ('3007','3009','3010'),1,0))+
        SUM(IF(kelas_unit = 2 ,1,0))+
        SUM(IF(kelas_unit = 3 AND a.kode_unit NOT IN ('3007','3009','3010'),1,0))+
        SUM(IF(kelas_unit = 4 ,1,0))AS total                    
            FROM ts_kunjungan a
            INNER JOIN mt_unit b ON b.`kode_unit` = a.`kode_unit`
            WHERE YEAR(tgl_masuk) = $YEAR AND status_kunjungan NOT IN (8,11) 
            ");
        return $query->row_array();
    }     
    function count_kunjungan_pasien_umum_tahun()
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM ts_kunjungan WHERE kode_penjamin = 'P01' AND YEAR(tgl_masuk) = '$year' AND status_kunjungan NOT IN (8,11)");
        return $query->row_array();
    }
    function count_kunjungan_pasien_umum_bulan($bulan)
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM ts_kunjungan WHERE kode_penjamin = 'P01' AND YEAR(tgl_masuk) = '$year' AND MONTH(tgl_masuk) ='$bulan' AND status_kunjungan NOT IN (8,11)");
        return $query->row_array();
    }
    function count_kunjungan_pasien_bpjs_tahun()
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM ts_kunjungan WHERE kode_penjamin != 'P01' AND YEAR(tgl_masuk) = '$year' AND status_kunjungan NOT IN (8,11)");
        return $query->row_array();
    }
    function count_kunjungan_pasien_bpjs_bulan($bulan)
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM ts_kunjungan WHERE kode_penjamin != 'P01' AND YEAR(tgl_masuk) = '$year' AND MONTH(tgl_masuk) ='$bulan' AND status_kunjungan NOT IN (8,11)");
        return $query->row_array();
    }
    function count_rm_baru()
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM mt_pasien WHERE YEAR(tgl_entry) = '$year'");
        return $query->row_array();
    }
    function count_rm_baru_bulan($bulan)
    {
        $year = date('Y');
        $query = $this->db->query("SELECT COUNT(*) as total FROM mt_pasien WHERE YEAR(tgl_entry) = '$year' AND MONTH(tgl_entry) ='$bulan'");
        return $query->row_array();
    }
    function count_kunjungan_jenis_bulan($bulan)
    {
        $YEAR = date('Y');
        $query = $this->db->query("SELECT  
        SUM(IF(kelas_unit = 1 OR a.kode_unit IN ('3007','3009','3010'),1,0))AS rawat_jalan
        ,SUM(IF(kelas_unit = 2 ,1,0))AS rawat_inap
        ,SUM(IF(kelas_unit = 3 AND a.kode_unit NOT IN ('3007','3009','3010'),1,0))AS penunjang
        ,SUM(IF(kelas_unit = 4 ,1,0))AS farmasi
    
        ,SUM(IF(kelas_unit = 1 OR a.kode_unit IN ('3007','3009','3010'),1,0))+
        SUM(IF(kelas_unit = 2 ,1,0))+
        SUM(IF(kelas_unit = 3 AND a.kode_unit NOT IN ('3007','3009','3010'),1,0))+
        SUM(IF(kelas_unit = 4 ,1,0))AS total                    
            FROM ts_kunjungan a
            INNER JOIN mt_unit b ON b.`kode_unit` = a.`kode_unit`
            WHERE YEAR(tgl_masuk) = $YEAR AND MONTH(tgl_masuk) = $bulan AND status_kunjungan NOT IN (8,11) 
            ");
        return $query->row_array();
    }   
    function count_kunjungan_bulan($bulan)
    {
        $YEAR = date('Y');
        $query = $this->db->query("SELECT  
        COUNT(IF( DAY(tgl_masuk) = 01, kode_kunjungan, NULL)) AS 'a01',
        COUNT(IF( DAY(tgl_masuk) = 02, kode_kunjungan, NULL)) AS 'a02',
        COUNT(IF( DAY(tgl_masuk) = 03, kode_kunjungan, NULL)) AS 'a03',
        COUNT(IF( DAY(tgl_masuk) = 04, kode_kunjungan, NULL)) AS 'a04',
        COUNT(IF( DAY(tgl_masuk) = 05, kode_kunjungan, NULL)) AS 'a05',
        COUNT(IF( DAY(tgl_masuk) = 06, kode_kunjungan, NULL)) AS 'a06',
        COUNT(IF( DAY(tgl_masuk) = 07, kode_kunjungan, NULL)) AS 'a07',
        COUNT(IF( DAY(tgl_masuk) = 08, kode_kunjungan, NULL)) AS 'a08',
        COUNT(IF( DAY(tgl_masuk) = 09, kode_kunjungan, NULL)) AS 'a09',
        COUNT(IF( DAY(tgl_masuk) = 10, kode_kunjungan, NULL)) AS 'a10',
        COUNT(IF( DAY(tgl_masuk) = 11, kode_kunjungan, NULL)) AS 'a11',
        COUNT(IF( DAY(tgl_masuk) = 12, kode_kunjungan, NULL)) AS 'a12',
        COUNT(IF( DAY(tgl_masuk) = 13, kode_kunjungan, NULL)) AS 'a13',
        COUNT(IF( DAY(tgl_masuk) = 14, kode_kunjungan, NULL)) AS 'a14',
        COUNT(IF( DAY(tgl_masuk) = 15, kode_kunjungan, NULL)) AS 'a15',
        COUNT(IF( DAY(tgl_masuk) = 16, kode_kunjungan, NULL)) AS 'a16',
        COUNT(IF( DAY(tgl_masuk) = 17, kode_kunjungan, NULL)) AS 'a17',
        COUNT(IF( DAY(tgl_masuk) = 18, kode_kunjungan, NULL)) AS 'a18',
        COUNT(IF( DAY(tgl_masuk) = 19, kode_kunjungan, NULL)) AS 'a19',
        COUNT(IF( DAY(tgl_masuk) = 20, kode_kunjungan, NULL)) AS 'a20',
        COUNT(IF( DAY(tgl_masuk) = 21, kode_kunjungan, NULL)) AS 'a21',
        COUNT(IF( DAY(tgl_masuk) = 22, kode_kunjungan, NULL)) AS 'a22',
        COUNT(IF( DAY(tgl_masuk) = 23, kode_kunjungan, NULL)) AS 'a23',
        COUNT(IF( DAY(tgl_masuk) = 24, kode_kunjungan, NULL)) AS 'a24',
        COUNT(IF( DAY(tgl_masuk) = 25, kode_kunjungan, NULL)) AS 'a25',
        COUNT(IF( DAY(tgl_masuk) = 26, kode_kunjungan, NULL)) AS 'a26',
        COUNT(IF( DAY(tgl_masuk) = 27, kode_kunjungan, NULL)) AS 'a27',
        COUNT(IF( DAY(tgl_masuk) = 28, kode_kunjungan, NULL)) AS 'a28',
        COUNT(IF( DAY(tgl_masuk) = 29, kode_kunjungan, NULL)) AS 'a29',
        COUNT(IF( DAY(tgl_masuk) = 30, kode_kunjungan, NULL)) AS 'a30',
        COUNT(IF( DAY(tgl_masuk) = 31, kode_kunjungan, NULL)) AS 'a31'
        FROM ts_kunjungan WHERE year(tgl_masuk) = $YEAR  AND month(tgl_masuk) = $bulan AND status_kunjungan  NOT IN (8,11) ");
        return $query->result();
    }
    
    function get_retur_detail($kode_layanan_header)
    {
        $query = $this->db->query("SELECT ts_retur_header.kode_layanan_header
        ,ts_retur_header.kode_retur_header
        ,ts_retur_detail.kode_retur_detail
        ,ts_retur_header.tgl_retur
        ,mt_tarif_header.NAMA_TARIF
        ,ts_retur_detail.qty_retur
        ,ts_retur_header.total_retur
        FROM ts_retur_header 
        JOIN ts_retur_detail ON ts_retur_header.kode_retur_header=ts_retur_detail.kode_retur_header 
        JOIN ts_layanan_detail ON ts_retur_detail.id_layanan_detail = ts_layanan_detail.id_layanan_detail 
        JOIN mt_tarif_detail ON ts_layanan_detail.kode_tarif_detail = mt_tarif_detail.KODE_TARIF_DETAIL
        JOIN mt_tarif_header ON mt_tarif_detail.KODE_TARIF_HEADER = mt_tarif_header.KODE_TARIF_HEADER
        WHERE ts_retur_header.kode_layanan_header = '$kode_layanan_header'");
        return $query->result_array();
    }
    function count_retur_detail($kode_layanan_header)
    {
        $query = $this->db->query("SELECT ts_retur_header.kode_layanan_header
        ,ts_retur_header.kode_retur_header
        ,ts_retur_detail.kode_retur_detail
        ,ts_retur_header.tgl_retur
        ,mt_tarif_header.NAMA_TARIF
        ,ts_retur_detail.qty_retur
        ,ts_retur_header.total_retur
        FROM ts_retur_header 
        JOIN ts_retur_detail ON ts_retur_header.kode_retur_header=ts_retur_detail.kode_retur_header 
        JOIN ts_layanan_detail ON ts_retur_detail.id_layanan_detail = ts_layanan_detail.id_layanan_detail 
        JOIN mt_tarif_detail ON ts_layanan_detail.kode_tarif_detail = mt_tarif_detail.KODE_TARIF_DETAIL
        JOIN mt_tarif_header ON mt_tarif_detail.KODE_TARIF_HEADER = mt_tarif_header.KODE_TARIF_HEADER
        WHERE ts_retur_header.kode_layanan_header = '$kode_layanan_header'");
        return $query->num_rows();
    }
    function getMtPasien($rm,$nama,$alamat)
    {
        $query = $this->db->query("SELECT * FROM mt_pasien WHERE no_rm LIKE '%$rm%'");
        return $query->result_array();
    }    
    function count_stok_darah($nomor_kantong)
    {
        $this->db->where('nomor_kantong',$nomor_kantong);        
        $this->db->where('status',2);        
        return $this->db->get('tb_stok_darah')->num_rows();
    }
    function get_stok_darah()
    {
        $this->db->where('status',1);        
        $this->db->or_where('status',3);        
        return $this->db->get('tb_stok_darah')->result_array();
    }
    function call_sp_rincian($no_rm,$counter)
    {
        $query = $this->db->query("call RINCIAN_BIAYA_FINAL('$no_rm','$counter','','')");
        return $query->result_array();
    }
    // function call_sp_rincian_final($no_rm1,$counter1)
    // {
    //     $query = $this->db->query("call RINCIAN_BIAYA_FINAL('$no_rm1','$counter1','','')");
    //  return $query->result_array();
    // }
    function px_mati($kode_unit)
    {
        $px_mati = $this->db->query("SELECT 
        SUM(IF(id_alasan_pulang = 6,1,0)) AS kr_48
        ,SUM(IF(id_alasan_pulang = 7,1,0)) AS lb_48
        
        FROM ts_kunjungan
        WHERE DATE(tgl_keluar) BETWEEN '2021-08-01' AND '2021-08-06'
        AND id_alasan_pulang IN (6,7)
        AND kode_unit = $kode_unit");
        return $px_mati->row_array();
    }   
    function hitung_tempat_tidur($kode_unit)
    {
        $this->db->where('kode_unit',$kode_unit);
        $this->db->where('status',1);
        return $this->db->get('mt_ruangan')->num_rows();
    }
    function hitung_mati_kr48($kode_unit)
    {
        $px_mati_kr_48 = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE MONTH(tgl_masuk) = '05'
        AND YEAR(tgl_masuk) = '2021'
        AND id_alasan_pulang IN (6)
        AND kode_unit = $kode_unit");
        return $px_mati_kr_48->num_rows();
    }
    function hitung_mati_lb48($kode_unit)
    {
        $px_mati_kr_48 = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE MONTH(tgl_masuk) = '05'
        AND YEAR(tgl_masuk) = '2021'
        AND id_alasan_pulang IN (7)
        AND kode_unit = $kode_unit");
        return $px_mati_kr_48->num_rows();
    }
    function hitung_perbaikan($kode_unit)
    {
        $px_perbaikan = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE MONTH(tgl_masuk) = '05'
        AND YEAR(tgl_masuk) = '2021'
        AND id_alasan_pulang IN (2)
        AND kode_unit = $kode_unit");
        return $px_perbaikan->num_rows();
    }
    function hitung_aps($kode_unit)
    {
        $px_aps = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE DATE(tgl_masuk) BETWEEN '2021-05-01' AND '2021-05-31'       
        AND id_alasan_pulang IN (9)
        AND kode_unit = $kode_unit");
        return $px_aps->num_rows();
    }
    function hitung_rujuk($kode_unit)
    {
        $px_rujuk = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE DATE(tgl_masuk) BETWEEN '2021-05-01' AND '2021-05-31'       
        AND id_alasan_pulang IN (1)
        AND kode_unit = $kode_unit");
        return $px_rujuk->num_rows();
    }
    function get_pasien_awal($kode_unit)
    {
        $get_px_awal = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE DATE(tgl_masuk) NOT BETWEEN '2021-05-01' AND '2021-05-31'         
        AND DATE(tgl_keluar) BETWEEN '2021-05-01' AND '2021-05-31'         
        AND kode_unit = $kode_unit");
        return $get_px_awal->num_rows();
    }
    function getPasien($kemarin,$sekarang)
    {
        if($kemarin == '' || $sekarang == ''){
            $kemarin = date('Y-m-d', strtotime("-7 day", strtotime(date("Y-m-d"))));
            $sekarang = date('Y-m-d');
        }      
        $query = $this->db->query("call SP_PANGGIL_PASIEN_EXPERTISI_PA('$kemarin','$sekarang','3020','','','')",50);
        return $query->result_array();
    }
    
    function get_pasien_masuk($kode_unit)
    {
        $get_px_awal = $this->db->query("SELECT *                               
        FROM ts_kunjungan
        WHERE DATE(tgl_masuk) BETWEEN '2021-05-01' AND '2021-05-31'         
        AND kode_unit = $kode_unit 
        AND status_kunjungan NOT IN(8,11,9)");
        return $get_px_awal->num_rows();
    }
    function hitung_lama_rawat($kode_unit)
    {
        $hit_lama_rawat = $this->db->query("SELECT kode_unit, SUM(IF(`fc_los_borlostoi`(no_rm,counter)=0,1,`fc_los_borlostoi`(no_rm,counter))) AS lama_rawat
        FROM ts_kunjungan a
        WHERE DATE(tgl_keluar) BETWEEN '2021-05-01' AND '2021-05-31'
        AND kode_unit = $kode_unit
        ;");
        return $hit_lama_rawat->row_array();
    }
    
    function count_px_umum()
    {
        $tgl = date('Y-m-d');
        $count = $this->db->query("SELECT COUNT(no_rm) AS total FROM ts_kunjungan WHERE DATE(tgl_masuk) = '$tgl' AND kode_penjamin = 'P01'");
        return $count->row_array();
    }
    function count_px_not_umum()
    {
        $tgl = date('Y-m-d');
        $count = $this->db->query("SELECT COUNT(no_rm) AS total FROM ts_kunjungan WHERE DATE(tgl_masuk) = '$tgl' AND kode_penjamin != 'P01'");
        return $count->row_array();
    }
    function count_px_ranap_umum()
    {
        $tgl = date('Y-m-d');
        $count = $this->db->query("SELECT COUNT(no_rm) AS total FROM ts_kunjungan WHERE DATE(tgl_masuk) = '$tgl' AND kode_penjamin = 'P01' AND SUBSTRING(kode_unit,1,1) = 2");
        return $count->row_array();
    }
    function count_px_rajal_umum()
    {
        $tgl = date('Y-m-d');
        $count = $this->db->query("SELECT COUNT(no_rm) AS total FROM ts_kunjungan WHERE DATE(tgl_masuk) = '$tgl' AND kode_penjamin = 'P01' AND SUBSTRING(kode_unit,1,1) = 2");
        return $count->row_array();
    }
  
    public function infoRanap()
    {
        $query = $this->db->query("call SP_BRIDGING_SIRANAP2()");
        return $query->result_array();   
    }
}