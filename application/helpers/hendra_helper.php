<?php defined('BASEPATH') or exit('No direct script access allowed');

	function monthName($i) // $i = 1..12
    {
        static $month  = array(
            "Muharram", " Syafar", "Rabiul Awal", " Rabiul Akhir",
            "Jumadil Awal", " Jumadil Akhir", "Rajab", "Sya'ban",
            "Ramadhan", "Syawal", "Dzulka'dah", "Dzulhijjah"
        );
        return $month[$i-1];
    }

    function GregorianToHijri($time = null)
    {
        if ($time === null) $time = time();
        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);

        return JDToHijri(
            cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    }
	function HijriToGregorian($m, $d, $y)
    {
        return jd_to_cal(CAL_GREGORIAN,
            HijriToJD($m, $d, $y));
    }

    # Julian Day Count To Hijri
    function JDToHijri($jd)
    {
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return array($m, $d, $y);
    }

    # Hijri To Julian Day Count
    function HijriToJD($m, $d, $y)
    {
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }
if (! function_exists('get_ip_address')) {
	function get_ip_address() {
		return getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');
	}
}

if (! function_exists('bersihkan')){
	function bersihkan($message)
	{
		if(!get_magic_quotes_gpc())
			$message = addslashes($message);
			$message = stripslashes($message);
			$message = strip_tags($message);
			$message = htmlentities($message);
			$message =htmlspecialchars($message);
			return trim($message);
	}	
}
if (! function_exists('str_bulan')){
	function str_bulan($num)
	{
		switch($num){
			case 1:
				return "Januari";
			case 2:
				return "Februari";
			case 3:
				return "Maret";
			case 4:
				return "April";
			case 5:
				return "Mei";
			case 6:
				return "Juni";
			case 7:
				return "Juli";
			case 8:
				return "Agustus";
			case 9:
				return "September";
			case 10:
				return "Oktober";
			case 11:
				return "November";
			case 12:
				return "Desember";				
		}
	}	
}
if(! function_exists('hari')){
	function hari($day)
	{
		switch($day){
			case 'Sun':
				$hari_ini = "Minggu";
			break;

			case 'Mon':			
				$hari_ini = "Senin";
			break;

			case 'Tue':
				$hari_ini = "Selasa";
			break;

			case 'Wed':
				$hari_ini = "Rabu";
			break;

			case 'Thu':
				$hari_ini = "Kamis";
			break;

			case 'Fri':
				$hari_ini = "Jumat";
			break;

			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
		
		return $hari_ini;
	}
	
}
if(! function_exists('kegiatan')){
	function kegiatan($num)
	{
		switch($num){
			case 1:
				$hari_ini['id'] = "KBM";
				$hari_ini['ket']="Kegiatan Belajar Mengajar";
			break;

			case 2:			
				$hari_ini['id'] = "Upacara";
				$hari_ini['ket']="Upacara Bendera Setiap Hari Senin";
			break;

			case 3:
				$hari_ini['id'] = "Istirahat";
				$hari_ini['ket']="Waktunya Istirahat";
			break;

			case 4:
				$hari_ini['id'] = "Imtaq";
				$hari_ini['ket']="Kegiatan Penguatan Iman dan Taqwa";
			break;

			case 5:
				$hari_ini['id'] = "Senam";
				$hari_ini['ket']="Kegiatan Kebugaran Jasmani";
			break;

			case 6:
				$hari_ini['id'] = "Bersih-bersih";
				$hari_ini['ket']="Kegiatan Membersihkan Lingkungan Sekolah";
			break;	
			case 7:
				$hari_ini['id'] = "Kegiatan Lainnya";
				$hari_ini['ket']="Kegiatan Kokurikuler / Pembiasaan Lainnya";
			break;			
			default:
				$hari_ini['id'] = "";	
				$hari_ini['ket']="";				
			break;
		}
		
		return $hari_ini;
	}
	
}
if(!function_exists('status_koneksi')){
	function status_koneksi($sCheckHost = 'www.google.com') 
	{
		return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
	}	
}