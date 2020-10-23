<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Guru extends Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_guru','m_curd']);
		$this->load->library('upload');
	}
	
	public function index()
	{
		$this->vars['title']="Data Guru";
		$this->vars['master']=$this->vars['guru']=TRUE;
		$this->vars['data']=$this->m_guru->get_guru();
		$this->vars['content']='master/guru';
		$this->load->view('backend/index',$this->vars);
	}
	
	public function add(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Add New';
			return $this->load->view('master/modal_guru',$this->vars);
		}else{
			redirect('master/guru');
		}
	}
	public function edit(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id=$_POST['id'];
			$this->vars['data']=$this->m_guru->get_single_guru($id);
			$this->vars['modal_title']='Edit';
			return $this->load->view('master/modal_guru',$this->vars);
		}else{
			redirect('master/guru');
		}
	}	
	public function add_foto(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['id']=$_POST['id'];
			$this->vars['modal_title']='Upload Foto';
			return $this->load->view('master/modal_upload_foto',$this->vars);
		}else{
			redirect('master/guru');
		}
	}	
	public function simpan(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if(isset($_POST['id'])){
					//edit
					if($this->validation('edit')){
						$id=$_POST['id']; 
						$filldata=$this->security->xss_clean(array(
							'nip' => $_POST['nip'],
							'nama_lengkap' => $_POST['nama_lengkap'],
							'tgl_lahir' => $_POST['tgl_lahir'],
							'tmp_lahir' => $_POST['tmp_lahir'],
							'ket' => $_POST['ket'],
							'kode_guru' => $_POST['kode_guru']
						));					
						$hasil=$this->m_curd->update(array('id' => $id),'guru',$filldata);
						if($hasil){
							$this->vars['type']='alert-success';
							$this->vars['message']='Berhasil Menyimpan';
						}else{
							$this->vars['type']='alert-danger';
							$this->vars['message']='Gagal Menyimpan';				
						}						
					}else{
						$this->vars['type'] = 'alert-danger';
						$this->vars['message'] = validation_errors();							
					}
				}else{
					//new 
					if($this->validation('new')){
						$filldata=$this->security->xss_clean(array(
							'nip' => $_POST['nip'],
							'nama_lengkap' => $_POST['nama_lengkap'],
							'tgl_lahir' => $_POST['tgl_lahir'],
							'tmp_lahir' => $_POST['tmp_lahir'],
							'ket' => $_POST['ket'],
							'kode_guru' => $_POST['kode_guru']
						));
						$hasil=$this->m_curd->add_new('guru',$filldata);
						if($hasil){
							$this->vars['type']='alert-success';
							$this->vars['message']='Berhasil Menyimpan';
						}else{
							$this->vars['type']='alert-danger';
							$this->vars['message']='Gagal Menyimpan';				
						}						
					}else{
						$this->vars['type'] = 'alert-danger';
						$this->vars['message'] = validation_errors();						
					}
				}
				
			$this->vars['title']="Data Guru";
			$this->vars['master']=$this->vars['guru']=TRUE;
			$this->vars['data']=$this->m_guru->get_guru();
			$this->vars['content']='master/guru';
			$this->load->view('backend/index',$this->vars);	
		}else{
			redirect('master/guru');
		}		
	}
	private function validation($mode){
		$val = $this->form_validation;
		if($mode=="new"){
			$val->set_rules('nip', 'NIP / PEG-ID','trim|required|callback_nip_check');
		}else{
			$val->set_rules('nip', 'NIP / PEG-ID','trim|required');
		}
		$val->set_rules('nama_lengkap', 'Nama Lengkap','trim|required');
		$val->set_rules('tmp_lahir', 'Tempat Lahir','trim|required');
		$val->set_rules('tgl_lahir', 'Tanggal Lahir','trim|required');
		$val->set_rules('ket', 'Keterangan Guru','trim|required');
		$val->set_rules('kode_guru', 'Kode Guru','trim|required|numeric|callback_kodeguru_check');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();		
	}

	Public function nip_check($input_nip){
		$hasil=$this->db->get_where('guru',array('nip' => $input_nip));
		if($hasil->num_rows()>0){
			$this->form_validation->set_message('nip_check', 'NIP/PEG-ID sudah ada!');
			return FALSE;
		}
		return TRUE;		
	}
	
	Public function kodeguru_check($input_kode_guru){
		$hasil=$this->db->get_where('guru',array('kode_guru' => $input_kode_guru));
		if($hasil->num_rows()>0){
			$nip=$hasil->row()->nip;
			if($nip!=$_POST['nip']){			
				$this->form_validation->set_message('kodeguru_check', 'Kode guru sudah ada!');
				return FALSE;
			}else{
				return TRUE;
			}				
		}
		return TRUE;		
	}	
	
	public function hapus($id){
		$id_guru=(int) $id;
		if($id_guru && $id_guru !=0 && ctype_digit((string) $id_guru)){
			$data=$this->m_guru->get_single_guru($id_guru);
			$foto="";
			if($data->num_rows()>0){
				$guru=$data->row();
				$foto=$guru->foto;
			}
			$hasil = $this->m_curd->hapus(array('id' => $id_guru),'guru');
			if($hasil){
				$this->vars['type']='alert-success';
				$this->vars['message']='Berhasil Menghapus';
				// HAPUS FOTO JIKA ADA
				if($foto!=""){
					$file=FCPATH."images/photo/".$foto;
					if(file_exists($file)){
						if (!unlink($file)) {
						  $this->vars['message'] .= " Error deleting $file";
						} else {
						   $this->vars['message'] .= " Deleted $file";
						}					
					}
				}
			}else{
				$this->vars['type']='alert-danger';
				$this->vars['message']='Gagal Menghapus';				
			}			
			$this->vars['title']="Data Guru";
			$this->vars['master']=$this->vars['guru']=TRUE;
			$this->vars['data']=$this->m_guru->get_guru();
			$this->vars['content']='master/guru';
			$this->load->view('backend/index',$this->vars);				
		}else{
			redirect('master/kelas');
		}
	}
	
	private function set_upload_options($file_path,$filename){   
		//  upload an image options
		$config = array();
		$config['file_name'] =$filename;
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;
		$config['encrypt_name'] = FALSE;
		return $config;
	}	
	
	Public function upload_foto(){
		$id=$_POST['id'];
		$this->upload->initialize($this->set_upload_options('./images/photo',$id));
		if ( ! $this->upload->do_upload('userfile'))
		{
				$error = array('error' => $this->upload->display_errors());
				$this->vars['type'] = 'alert-danger';
				$this->vars['message'] = $this->upload->display_errors();
		}
		else
		{
				$data = array('upload_data' => $this->upload->data());
				$filename = $this->upload->data('file_name');
				//$this->load->view('upload_success', $data);
				$hasil=$this->m_curd->update(array('id' => $id),'guru',array('foto' => $filename));
				if($hasil > 0){
					$this->vars['type'] = 'alert-success';
					$this->vars['message'] = 'Berhasil Upload Foto';	
				}else{
					$this->vars['type'] = 'alert-danger';
					$this->vars['message'] = "Foto Gagal Tersimpan Dalam Database!";			
				}				
		}
		$this->vars['title']="Data Guru";
		$this->vars['master']=$this->vars['guru']=TRUE;
		$this->vars['data']=$this->m_guru->get_guru();
		$this->vars['content']='master/guru';
		$this->load->view('backend/index',$this->vars);	
	}

	public function load_import(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->vars['modal_title']='Import Guru';
			return $this->load->view('master/modal_import_excel',$this->vars);
		}else{
			redirect('master/guru');
		}
	}

	function import(){
		if(isset($_FILES["file"]["name"])){
			$this->upload->initialize($this->set_upload_options_excel('./uploads'));
			
			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				$this->vars['type']="alert-danger";
				$this->vars['message'] = $this->upload->display_errors();
			}else{
				$data = array('upload_data' => $this->upload->data());
				$filename = $this->upload->data('file_name');
				$path = './uploads/'.$filename;	
				
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($path);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);	

                // array Count
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                $createArray = array('No', 'NIP', 'Nama', 'tmp_lahir', 'tgl_lahir', 'ket', 'Kode');
                $makeArray = array('No' => 'No', 'NIP' => 'NIP', 'Nama' => 'Nama', 'tmp_lahir' => 'tmp_lahir', 'tgl_lahir' => 'tgl_lahir', 'ket' => 'ket', 'Kode' => 'Kode');
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
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $no = $SheetDataKey['No'];
                        $nip = $SheetDataKey['NIP'];
                        $nama = $SheetDataKey['Nama'];
						$tmp_lahir=$SheetDataKey['tmp_lahir'];
						$tgl_lahir=$SheetDataKey['tgl_lahir'];
						$ket=$SheetDataKey['ket'];
                        $kode = $SheetDataKey['Kode'];
 
                        $no = filter_var(trim($allDataInSheet[$i][$no]), FILTER_SANITIZE_STRING);
                        $nip = filter_var(trim($allDataInSheet[$i][$nip]), FILTER_SANITIZE_STRING);
                        $nama = filter_var(trim($allDataInSheet[$i][$nama]), FILTER_SANITIZE_STRING);
						$tmp_lahir = filter_var(trim($allDataInSheet[$i][$tmp_lahir]), FILTER_SANITIZE_STRING);
						$tgl_lahir = filter_var(trim($allDataInSheet[$i][$tgl_lahir]), FILTER_SANITIZE_STRING);
						$ket = filter_var(trim($allDataInSheet[$i][$ket]), FILTER_SANITIZE_STRING);
                        $kode = filter_var(trim($allDataInSheet[$i][$kode]), FILTER_SANITIZE_NUMBER_INT);
						
						//cek dulu sudah ada atau belum berdasarkan NIP dan Kode Guru
						if($this->m_guru->is_present($nip,$kode)){
							//sudah ada
							$info ="NIP/Kode Guru Sudah Ada!";
						}else{
							$query=$this->m_curd->add_new('guru',array('nip' => $nip,'nama_lengkap' => $nama, 'tmp_lahir' => $tmp_lahir, 'tgl_lahir' => $tgl_lahir, 'ket' => $ket, 'kode_guru' => $kode));
							if($query){
								$info ="Tersimpan";
							}					
						}						
						
                        $fetchData[] = array('no' => $no, 'nip' => $nip, 'nama' => $nama, 'tmp_lahir' => $tmp_lahir, 'tgl_lahir' => $tgl_lahir, 'ket' => $ket, 'kode' => $kode, 'info' => $info);
                    }
					$this->vars['type']="alert-success";
					$this->vars['message']="Import Finish";
                    $this->vars['dataInfo'] = $fetchData;
                } else {
					$this->vars['type']="alert-danger";
					$this->vars['message']="Please import correct file, did not match excel sheet column";					
                }
				$this->vars['title']="Data Guru";
				$this->vars['master']=$this->vars['guru']=TRUE;
				$this->vars['data']=$this->m_guru->get_guru();
				$this->vars['content']='master/guru';
				$this->load->view('backend/index',$this->vars);	
			}
		}else{
			redirect('master/guru');
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
