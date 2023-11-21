<?php
class modelBilling extends CI_Model
{
    function getAlamat($rm)
    {
        $query = $this->db->query("SELECT FC_ALAMAT4(no_rm) as alamat FROM mt_pasien WHERE no_rm = '$rm'");
        return $query->row_array();
    }
    function getKodeReturHeader1($prefix)
    {
        // $q = $this->db->query("CALL GET_NOMOR_LAYANAN_HEADER_RETUR('$prefix')");        
        // return $q->row_array();     
        $q = $this->db->query("SELECT MAX(RIGHT(id,6)) AS kd_max FROM ts_nomor_retur_header");
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
        return 'RET' . $prefix . date('ymd') . $kd;  
    }
    
    function getKodeReturDetail1()
    {
        // $q = $this->db->query("CALL GET_NOMOR_LAYANAN_HEADER_RETUR('$prefix')");        
        // return $q->row_array();     
        $q = $this->db->query("SELECT MAX(RIGHT(id,6)) AS kd_max FROM ts_nomor_retur_detail");
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
        return 'RETDET'. date('ymd') . $kd;  
    }
    function hitung_retur_header($kode_header)
    {
        $query = $this->db->query("SELECT * FROM ts_layanan_detail WHERE row_id_header = '$kode_header' AND status_layanan_detail = 'OPN'");
        return $query->num_rows();
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
    
    function get_isi_expert($id_detail)
    {
        $query = $this->db->query("SELECT 
        SUBSTRING_INDEX(hasil,' | ',1) AS makro
        ,SUBSTRING_INDEX(SUBSTRING_INDEX(hasil,' | ',2),' | ',-1) AS mikro
        ,SUBSTRING_INDEX(hasil,' | ',-1) AS kesimpulan
        FROM ts_hasil_expertisi_pa WHERE id_detail = $id_detail");
        return $query->row_array();
    }           
    function getVrincian($kode_unit)
    {
        // $this->db->where('unit',$kode_unit);   
        // $this->db->limit(10,20);
        // return $this->db->get('v_ts_kj')->result_array();
        $kemarin = date('Y-m-d', strtotime("-7 day", strtotime(date("Y-m-d"))));
        $sekarang = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM v_ts_kj WHERE unit = $kode_unit AND tgl_entry >= '$kemarin'");
        return $query->result_array();
    }
    function get_px_rajal($kode_unit)
    {
        $date = date('Y-m-d');
        $query = $this->db->query("CALL WSP_PANGGIL_PASIEN_RAWAT_JALAN_NONIGD_PLUS_SEP('','','','$kode_unit','$date')");
        return $query->result_array();
    }
}
