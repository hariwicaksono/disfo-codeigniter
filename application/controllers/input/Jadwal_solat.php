<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Jadwal_solat extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_solat','m_curd']);
		$this->load->library('upload');
	}
	
	public function show()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id_bulan=$_POST['bulan'];
			$this->vars['id_bulan']=$id_bulan;
			$this->vars['title']="Setup Jadwal Sholat Bulan " . str_bulan($id_bulan);
			$this->vars['display']=$this->vars['jadwal_solat']=TRUE;
			$this->vars['data']=$this->m_solat->get_solat($id_bulan);
			$this->vars['content']='input/jadwal_solat';
			$this->load->view('backend/index',$this->vars);
		}else{
			redirect('dashboard');
		}
	}
	
	public function load_bulan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return $this->load->view('input/modal_bulan');
		}else{
			redirect('dashboard');
		}
	}		
	
	public function load_import(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['id_bulan'] =$_POST['id_bulan'];
			$this->vars['modal_title']='Import Jadwal Solat';
			return $this->load->view('input/modal_import_solat',$this->vars);
		}else{
			redirect('dashboard');
		}
	}	

	public function import(){
		if(isset($_FILES["file"]["name"])){
			$id_bulan=$_POST['id_bulan'];
			$this->upload->initialize($this->set_upload_options_excel('./uploads'));
			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				$this->vars['type']="alert-danger";
				$this->vars['message'] = $this->upload->display_errors();
			}else{
				$jadwal_solat=$this->m_solat->get_solat($id_bulan);
				if($jadwal_solat->num_rows()>0){
					$this->m_curd->hapus(array('id_bulan' => $id_bulan),'jadwal_solat');
				}
				$data = array('upload_data' => $this->upload->data());
				$filename = $this->upload->data('file_name');
				$path = './uploads/'.$filename;	
				
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

				$spreadsheet = $reader->load($path);
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);	

				// array Count
				$arrayCount = count($allDataInSheet);
				$flag = 0;
				$createArray = array('NO', 'IMSAK', 'SUBUH', 'TERBIT','DUHA', 'DZUHUR', 'ASHAR', 'MAGRIB', 'ISYA');
				$makeArray = array('NO' => 'NO', 'IMSAK' => 'IMSAK', 'SUBUH' => 'SUBUH', 'TERBIT' => 'TERBIT', 'DUHA' => 'DUHA', 'DZUHUR' => 'DZUHUR', 'ASHAR' => 'ASHAR', 'MAGRIB' => 'MAGRIB', 'ISYA' => 'ISYA');
				$SheetDataKey = array();
				foreach ($allDataInSheet as $dataInSheet) {
					foreach ($dataInSheet as $key => $value) {
						if (in_array(trim($value), $createArray)) {
							$value = preg_replace('/\s+/', '', $value);
							$SheetDataKey[trim($value)] = $key;
						} 
					}
				}

				$dataDiff = array_diff_key($makeArray, $SheetDataKey);
				if (empty($dataDiff)) {
					$flag = 1;
				}
				// match excel sheet column
				if ($flag == 1) {
					$tgl=0;
					for ($i = 2; $i <= $arrayCount; $i++) {
						$tgl++;
						$tanggal = date("Y") . "-" . $id_bulan . "-" . $tgl;
						$no = $SheetDataKey['NO'];
						$imsak = $SheetDataKey['IMSAK'];
						$subuh = $SheetDataKey['SUBUH'];
						$terbit = $SheetDataKey['TERBIT'];
						$duha = $SheetDataKey['DUHA'];
						$dzuhur = $SheetDataKey['DZUHUR'];
						$ashar = $SheetDataKey['ASHAR'];
						$magrib = $SheetDataKey['MAGRIB'];
						$isya = $SheetDataKey['ISYA'];
 
						$no = filter_var(trim($allDataInSheet[$i][$no]), FILTER_SANITIZE_STRING);
						$imsak = filter_var(trim($allDataInSheet[$i][$imsak]), FILTER_SANITIZE_STRING);
						$subuh = filter_var(trim($allDataInSheet[$i][$subuh]), FILTER_SANITIZE_STRING);
						$terbit = filter_var(trim($allDataInSheet[$i][$terbit]), FILTER_SANITIZE_STRING);
						$duha = filter_var(trim($allDataInSheet[$i][$duha]), FILTER_SANITIZE_STRING);
						$dzuhur = filter_var(trim($allDataInSheet[$i][$dzuhur]), FILTER_SANITIZE_STRING);
						$ashar = filter_var(trim($allDataInSheet[$i][$ashar]), FILTER_SANITIZE_STRING);
						$magrib = filter_var(trim($allDataInSheet[$i][$magrib]), FILTER_SANITIZE_STRING);
						$isya = filter_var(trim($allDataInSheet[$i][$isya]), FILTER_SANITIZE_STRING);
						

						$query=$this->m_curd->add_new('jadwal_solat',array('id_bulan' => $id_bulan, 'tanggal' => $tanggal, 'imsak' => $imsak, 'subuh' => $subuh, 'terbit' => $terbit, 'duha' => $duha, 'dzuhur' => $dzuhur, 'ashar' => $ashar, 'magrib' => $magrib, 'isya' => $isya));
						if($query){
							$ket ="Tersimpan";
						}else{
							$ket = "Gagal Disimpan";
						}							
						$fetchData[] = array('tanggal' => $tanggal, 'ket' => $ket);
					}
					$this->vars['type']="alert-success";
					$this->vars['message']="Import Finish " . count($fetchData) . " Data";
					$this->vars['dataInfo'] = $fetchData;
				} else {
					$this->vars['type']="alert-danger";
					$this->vars['message']="Please import correct file, did not match excel sheet column";					
				}
			}

			$this->vars['id_bulan']=$id_bulan;
			$this->vars['title']="Setup Jadwal Sholat Bulan " . str_bulan($id_bulan);
			$this->vars['display']=$this->vars['jadwal_solat']=TRUE;
			$this->vars['data']=$this->m_solat->get_solat($id_bulan);
			$this->vars['content']='input/jadwal_solat';
			$this->load->view('backend/index',$this->vars);			
		}else{
			redirect('dashboard');
		}
	}
	
	private function set_upload_options_excel($file_path){   
		//  upload an image options
		$config = array();
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size']      = '15360';
		$config['overwrite']     = TRUE;
		$config['encrypt_name'] = TRUE;
		return $config;
	}
	


}
