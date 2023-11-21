<?php
class modelGetNomor extends CI_Model
{       
public function getKodeLayananHeader($prefix)
    {
        $DATE = date('ymd');
        $q = $this->db->query("SELECT MAX(RIGHT(no_trx_layanan,6)) AS kd_max FROM mt_nomor_trx 
        WHERE SUBSTRING(no_trx_layanan,1,3)= '$prefix' AND SUBSTRING(no_trx_layanan,4,6)= $DATE");
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
        return $prefix . $DATE . $kd;
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
        $y = date('y');
        $d = date('m');
        $tdy = $y.$d;
        $q = $this->db->query("SELECT MAX(RIGHT(no_periksa,2)) AS kd_max FROM ts_hasil_expertisi_pa WHERE SUBSTRING(no_periksa,1,1)='$prefix' AND SUBSTRING(no_periksa,3,4)= $tdy");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%02s", $tmp);
            }
        } else {
            $kd = "01";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $prefix .'-' . date('ym') . $kd;
    }
}