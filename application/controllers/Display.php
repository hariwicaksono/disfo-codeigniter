<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_kegiatan','m_masjid','m_keuangan','m_agenda','m_news','m_jam_pelajaran','m_jadwal','m_event','m_solat','m_video','m_guru','m_gallery','m_kadis','m_disdik','m_skripsi','m_kp']);
		
	}
	public function index() 
	{
		$this->vars['title']="Display Informasi Kampus";
		$this->vars['display']=TRUE;
		$this->vars['news']=$this->m_news->str_news();
		$this->vars['jampel']=$this->jampel();
		$this->vars['data_event']=$this->m_event->get_event();
		$this->vars['jadwal_solat']=$this->m_solat->get_single_solat(array('id_bulan' => date("m"), 'tanggal' => date("Y-m-d")));
		$this->vars['data_video']=$this->m_video->get_aktif_video2();
		
		switch($this->settings->info['layout']){ 
			case 'layout_2':
				$this->vars['agenda_disdik']=$this->m_disdik->get_agenda();
				$this->vars['data_guru']=$this->m_guru->get_guru();
				$this->vars['event_bulan_ini']=$this->m_event->get_event_bulan_ini();
				$this->vars['data_gallery']=$this->m_gallery->get_aktif_images();
				$content='display/layout_2';
				break;
			case 'layout_3':
				$this->vars['agenda_disdik']=$this->m_disdik->get_agenda();
				$this->vars['agenda_kadis']=$this->m_kadis->get_agenda();
				$this->vars['jadwal_skripsi']=$this->m_skripsi->get_skripsi();
				$this->vars['jadwal_kp']=$this->m_kp->get_kp();
				$content='display/layout_3';
				break;
			case 'layout_4':
				$this->vars['data_guru']=$this->m_guru->get_guru();
				$this->vars['event_bulan_ini']=$this->m_event->get_event_bulan_ini_slide();
				$this->vars['agenda_kadis']=$this->m_kadis->get_agenda();
				$this->vars['data_gallery']=$this->m_gallery->get_aktif_images();
				$content='display/layout_4';
				break;	
			case 'layout_5':
				$this->vars['data_guru']=$this->m_guru->get_guru();
				$this->vars['agenda_instansi']=$this->m_agenda->get_agenda();
				$this->vars['data_gallery']=$this->m_gallery->get_aktif_images();
				$content='display/layout_5';
				break;	
			case 'layout_6':
				$this->vars['data_jumat'] = $this->m_masjid->get_jumatan('status',1);
				$this->vars['data_kegiatan']=$this->m_kegiatan->kegiatan_masjid_bulan(date("n"));
				$this->vars['data_transaksi'] = $this->cek_transaksi('data');
				$content='display/layout_6';
				break;				
			default :
				$content='display/layout_1';
		}
		$this->vars['content']=$content;
		$this->load->view('display/index',$this->vars);
	}
	
	public function get_video(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hasil = $this->m_video->get_aktif_video2();
			echo json_encode($hasil);
		}
	}
	
	public function cek_news(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo $this->m_news->str_news();
		}
	}
	
	public function cek_date(){
		$hasil['hari'] =hari(date("D"));
		$hasil['tanggal']=date("d M Y");
		echo json_encode($hasil);
	}
	
	public function cek_waktu_solat(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$waktu_solat="";
			$jadwal_solat=$this->m_solat->get_single_solat(array('id_bulan' => date("m"), 'tanggal' => date("Y-m-d")));
			if($jadwal_solat->num_rows()>0){
				$solat=$jadwal_solat->row();
				$tanggal=$solat->tanggal;
				$subuh =strtotime($solat->subuh);
				$duha=strtotime($solat->duha);
				$dzuhur=strtotime($solat->dzuhur);
				$ashar=strtotime($solat->ashar);
				$magrib=strtotime($solat->magrib);
				$isya=strtotime($solat->isya);
				if(time() >= $subuh && time() <= $dzuhur){
					$waktu_solat ="Jelang Dzuhur";
					$date =date_create($tanggal . " " . $solat->dzuhur);
					$waktu=date_format($date,"Y-m-d H:i:s");
				}
				if(time() >= $dzuhur && time() <= $ashar){
					$waktu_solat ="Jelang Ashar";
					$date =date_create($tanggal . " " . $solat->ashar);
					$waktu=date_format($date,"Y-m-d H:i:s");
				}	
				if(time() >= $ashar && time() <= $magrib){
					$waktu_solat ="Jelang Magrib";
					$date =date_create($tanggal . " " . $solat->magrib);
					$waktu=date_format($date,"Y-m-d H:i:s");
				}	
				if(time() >= $magrib && time() <= $isya){
					$waktu_solat ="Jelang Isya";
					$date =date_create($tanggal . " " . $solat->isya);
					$waktu=date_format($date,"Y-m-d H:i:s");
				}	
				if(time() > $isya){
					$waktu_solat ="Jelang Subuh";
					$waktu="";
				}
				if(time() < $subuh){
					$waktu_solat ="Jelang Subuh";
					$date =date_create($tanggal . " " . $solat->subuh);
					$waktu=date_format($date,"Y-m-d H:i:s");
				}					
			}
			$hasil=array('jelang' => $waktu_solat, 'waktu' => $waktu);
			echo json_encode($hasil);
		}
	}
	
	public function guru_mengajar(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hari=$_POST['hari'];
			$jam_ke=$_POST['jam_ke'];
			$this->vars['data_mengajar'] =$this->m_jadwal->guru_mengajar($jam_ke,$hari);
			return $this->load->view('display/table_mengajar',$this->vars);
		}
	}
	
	public function slide_guru_mengajar(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hari=$_POST['hari'];
			$jam_ke=$_POST['jam_ke'];
			$this->vars['data_mengajar'] =$this->m_jadwal->guru_mengajar($jam_ke,$hari);
			return $this->load->view('display/slide_mengajar',$this->vars);
		}
	}	
	private function jampel(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hasil['id_jam']=0;
			$hasil['jam_ke']="-";
			$hasil['range_jam']="-";
			$jampel=$this->m_jam_pelajaran->get_jam();
			if($jampel->num_rows() > 0){
				foreach($jampel->result() as $jam){
					$start = strtotime($jam->awal);
					$end = strtotime($jam->akhir);
					if(time() >= $start && time() <= $end) {
						$hasil['id_jam']=0;
						$hasil['jam_ke']=$jam->jam_ke;
						$hasil['range_jam']=$jam->awal . "-" . $jam->akhir;
						break;
					} 				
				}
			}
			return $hasil;
		}
	}
	public function get_jam_pelajaran(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hasil['id_jam']=0;
			$hasil['jam_ke']="";
			$hasil['range_jam']="";
			$jampel=$this->m_jam_pelajaran->get_jam();
			if($jampel->num_rows() > 0){
				foreach($jampel->result() as $jam){
					$start = strtotime($jam->awal);
					$end = strtotime($jam->akhir);
					if(time() >= $start && time() <= $end) {
						$hasil['id_jam']=$jam->id;
						$hasil['jam_ke']=$jam->jam_ke;
						$hasil['range_jam']=$jam->awal . "-" . $jam->akhir;
						break;
					} 				
				}
			}
			echo json_encode($hasil);
		}
	}
	public function cek_kegiatan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id_jam_pelajaran=$_POST['id'];
			$kegiatan=$this->m_jam_pelajaran->get_hari_belajar($id_jam_pelajaran);
			if($kegiatan->num_rows()>0){
				$keg=$kegiatan->row();
				$hari=hari(date("D"));
				switch($hari){
					case 'Senin':			
						$hasil['ket'] = kegiatan($keg->senin)['id'];
						$hasil['des'] = kegiatan($keg->senin)['ket'];
						break;
					case 'Selasa':			
						$hasil['ket'] = kegiatan($keg->selasa)['id'];
						$hasil['des'] = kegiatan($keg->selasa)['ket'];
						break;
					case 'Rabu':			
						$hasil['ket'] = kegiatan($keg->rabu)['id'];
						$hasil['des'] = kegiatan($keg->rabu)['ket'];
						break;
					case 'Kamis':			
						$hasil['ket'] = kegiatan($keg->kamis)['id'];
						$hasil['des'] = kegiatan($keg->kamis)['ket'];
						break;
					case 'Jumat':			
						$hasil['ket'] = kegiatan($keg->jumat)['id'];
						$hasil['des'] = kegiatan($keg->jumat)['ket'];
						break;
					case 'Sabtu':			
						$hasil['ket'] = kegiatan($keg->sabtu)['id'];
						$hasil['des'] = kegiatan($keg->sabtu)['ket'];
						break;
					default :
						$hasil['ket']="Jam Belajar Tidak Aktif";
						$hasil['des'] = "";
				}
			}else{
				$hasil['ket']="Jam Belajar Tidak Aktif";
				$hasil['des'] = "";
			}
			echo json_encode($hasil);
		}else{
			redirect('display');
		}
	}
	
	public function cek_tema(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$hasil['tema']="";
			$hasil['sub_tema']="";			
			$query_tema=$this->db->get('tema');
			if($query_tema->num_rows()>0){
				foreach($query_tema->result() as $tema){
					$start_date=strtotime($tema->start_date);
					$end_date=strtotime($tema->end_date);
					$now_date=strtotime(date("Y-m-d"));
					if(($now_date>=$start_date) && ($now_date<=$end_date)){
						$hasil['tema']=$tema->tema;
						$hasil['sub_tema']=$tema->sub_tema;
					}
				}
			}
			echo json_encode($hasil);
		}
	}
	public function cek_event_bulan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$zz=$this->m_event->get_event_bulan_ini();
			echo json_encode($zz);
		}
	}
	public function cek_event_bulan_slide(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['event_bulan_ini']=$this->m_event->get_event_bulan_ini_slide();
			return $this->load->view('display/event_bulan',$this->vars);
		}
	}
	public function cek_agenda_kadis(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['agenda_kadis']=$this->m_kadis->get_agenda();
			return $this->load->view('display/agenda_kadis',$this->vars);
		}
	}
	public function cek_guru(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['data_guru']=$this->m_guru->get_guru();
			return $this->load->view('display/tempat_guru',$this->vars);
		}
	}
	public function cek_photos(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['data_gallery']=$this->m_gallery->get_aktif_images();
			return $this->load->view('display/tempat_photos',$this->vars);
		}
	}

	public function cek_agenda(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['agenda_instansi']=$this->m_agenda->get_agenda();
			return $this->load->view('display/agenda',$this->vars);
		}
	}	
	
	public function cek_keuangan(){
		$data=$this->m_keuangan->keuangan_masjid();
		$pemasukan =0;
		$pengeluaran=0;
		$saldo=0;
		if($data->num_rows()>0){
			foreach($data->result() as $row){
				if($row->jenis==1){
					$pemasukan = $pemasukan + $row->pemasukan;
				}
				if($row->jenis==2){
					$pengeluaran = $pengeluaran + $row->pengeluaran;
				}				
			}
			$saldo =number_format($pemasukan-$pengeluaran,0,"",".");
		}
		$bulan = date("n");
		$pemasukan_bulan=$this->m_keuangan->nominal_pemasukan($bulan);
		$pengeluaran_bulan=$this->m_keuangan->nominal_pengeluaran($bulan);
		$teks = "Keuangan Bulan : " . date("M Y") .  " Kas : Rp. " . $saldo . "<br />";
		$teks .= " <i class='fa fa-arrow-down text-green'></i> Rp. " . $pemasukan_bulan . " <i class='fa fa-arrow-up text-blue'></i> Rp. " . $pengeluaran_bulan;		
		
		echo $teks;
	}
	
	public function cek_sholat(){
		$data['subuh'] ="00:00";
		$data['duha']="00:00";
		$data['dzuhur']="00:00";
		$data['ashar']="00:00";
		$data['magrib']="00:00";
		$data['isya']="00:00";		
		$jadwal_solat=$this->m_solat->get_single_solat(array('id_bulan' => date("m"), 'tanggal' => date("Y-m-d")));
		if($jadwal_solat->num_rows()>0){
			$solat=$jadwal_solat->row();
			$data['subuh'] =$solat->subuh;
			$data['duha']=$solat->duha;
			$data['dzuhur']=$solat->dzuhur;
			$data['ashar']=$solat->ashar;
			$data['magrib']=$solat->magrib;
			$data['isya']=$solat->isya;
		}		
	}
	
	public function cek_transaksi($param){
		$bulan = date("n");
		$data = $this->m_keuangan->get_transaksi($bulan);
		$hasil = "";
		if($data->num_rows()>0){
			foreach($data->result() as $row){
				if($row->jenis==1){
					$nominal=$row->pemasukan;
				}
				if($row->jenis==2){
					$nominal=$row->pengeluaran;
				}				
				$hasil .= $row->uraian . " Rp. " .number_format($nominal,0,"",".") . "|";
			}
		}
		if($param=='text'){
			echo $hasil;
		}else{
			return $hasil;
		}
	}
	
	public function jumatan(){
		$this->vars['data_jumat'] =$this->m_masjid->get_jumatan('status',1);
		return $this->load->view('display/jadwal_jumat',$this->vars);
	}
	
	public function kegiatan_masjid(){
		$this->vars['data_kegiatan']=$this->m_kegiatan->kegiatan_masjid_bulan(date("n"));
		return $this->load->view('display/kegiatan_masjid',$this->vars);
	}
}
