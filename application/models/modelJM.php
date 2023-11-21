<?php
class modelJM extends CI_Model
{ 
    function get_jm($tgl_awal,$tgl_akhir,$dokter,$penjamin)
    {
        $query = $this->db->query("call SP_LAPORAN_PENDAPATAN_PELAYANAN_11('$tgl_awal','$tgl_akhir','$dokter','$penjamin')");
        return $query->result_array();
    }
}