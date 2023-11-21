<?php
class modelBorLossToi extends CI_Model
{ 
    function get_unit_ranap()
    {
        $this->db->where('kelas_unit',2);
        // $this->db->where('kode_unit !=',2004);
        return $this->db->get('mt_unit')->result_array();
    }
    function get_sp_borlosstoi($tgl_awal,$tgl_akhir)
    {
        $query = $this->db->query("call SP_BOR_LOS_TOI3('$tgl_awal','$tgl_akhir')");
        return $query->result_array();
    } 
    function cek_ruangan($unit,$bulan,$tahun)
    {
        $cek = $this->db->query("SELECT *
        FROM log_tt_ruangan
        WHERE unit = $unit AND tahun = $tahun AND bulan = $bulan");
        return $cek->num_rows();
    }    
    function get_log_ruangan($unit,$bulan,$tahun)
    {
        $cek = $this->db->query("SELECT *
        FROM log_tt_ruangan
        WHERE unit = $unit AND tahun = $tahun AND bulan = $bulan");
        return $cek->row_array();
    }
    function countpxawal($kode_unit,$tgl_awal,$tgl_akhir)
    {
        $bulan = substr($tgl_akhir,5,2);
        $year = substr($tgl_akhir,0,4);
        $query = $this->db->query("SELECT COUNT(no_rm) as jumlah FROM ts_kunjungan WHERE kode_unit = $kode_unit AND DATE(tgl_masuk) < '$tgl_awal'
        AND MONTH(tgl_keluar) = '$bulan' AND YEAR(tgl_keluar) = '$year'");
        return $query->row_array();
    }
    function count_px_masuk($kode_unit,$tgl_awal,$tgl_akhir)
    {
        $bulan = substr($tgl_akhir,5,2);
        $year = substr($tgl_akhir,0,4);
        $query = $this->db->query("SELECT COUNT(no_rm) AS jumlah FROM ts_kunjungan WHERE kode_unit = '$kode_unit' AND MONTH(tgl_masuk) = '$bulan'
        AND YEAR(tgl_masuk) = '$year'");
        return $query->row_array($kode_unit,$tgl_awal,$tgl_akhir);

    }
    function count_kr_48_1($kode_unit,$tgl_awal,$tgl_akhir){
        $bulan = substr($tgl_akhir,5,2);
        $year = substr($tgl_akhir,0,4);
        $query = $this->db->query("SELECT COUNT(no_rm) as jumlah FROM ts_kunjungan WHERE kode_unit = $kode_unit AND DATE(tgl_masuk) < '$tgl_awal'
        AND MONTH(tgl_keluar) = '$bulan' AND YEAR(tgl_keluar) = '$year' AND id_alasan_pulang = '6'");
        return $query->row_array();
    }
    function count_kr_48_2($kode_unit,$tgl_awal,$tgl_akhir)
    {
        $bulan = substr($tgl_akhir,5,2);
        $year = substr($tgl_akhir,0,4);
        $query = $this->db->query("SELECT COUNT(no_rm) AS jumlah FROM ts_kunjungan WHERE kode_unit = '$kode_unit' AND MONTH(tgl_masuk) = '$bulan'
        AND YEAR(tgl_masuk) = '$year' AND id_alasan_pulang = '6'");
        return $query->row_array($kode_unit,$tgl_awal,$tgl_akhir);

    }

}