<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_agenda','m_news','m_solat','m_video','m_gallery','m_kegiatan','m_masjid','m_keuangan','m_cuaca']);
		
	}
	public function index() 
	{ 
		$this->vars['title']="Display Informasi Kampus";
		$this->vars['display']=TRUE;
		$this->vars['news']=$this->m_news->str_news();
		$this->vars['jadwal_solat']=$this->m_solat->get_single_solat(array('id_bulan' => date("m"), 'tanggal' => date("Y-m-d")));
		$this->vars['data_video']=$this->m_video->get_aktif_video2();
		
		switch($this->settings->info['layout']){ 
			case 'layout_2':
				$this->vars['data_jumat'] = $this->m_masjid->get_jumatan('status',1);
				$this->vars['data_kegiatan']=$this->m_kegiatan->kegiatan_masjid_bulan(date("n"));
				$this->vars['data_transaksi'] = $this->cek_transaksi('data');
				$content='display/layout_2';
				break;	
			case 'layout_3':
				$this->vars['agenda_instansi']=$this->m_agenda->agenda_bulan(date("n"));
				$query = $this->m_cuaca->get_settings()->row();
				$city = $query->area;
				$this->vars['current_weather'] = $this->m_cuaca->current_weather($city);
				$content='display/layout_3';
				break;			
			default :
				$this->vars['agenda_instansi']=$this->m_agenda->agenda_bulan(date("n"));
				$this->vars['data_gallery']=$this->m_gallery->get_aktif_images();
				$query = $this->m_cuaca->get_settings()->row();
				$city = $query->area;
				$this->vars['current_weather'] = $this->m_cuaca->current_weather($city);
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
	
}
