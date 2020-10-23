<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Auth {

    /**
     * The CodeIgniter super object
     *
     * @var object
     * @access public
     */
    public $CI;

    /**
     * Class constructor
     */
    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->model(['m_users']);
    }

    /**
     * logged_in()
     * @access  public
     * @param   string
     * @param   string
     * @return  bool
     */
    public function logged_in($user_name, $user_password, $ip_address) {
            $query = $this->CI->m_users->logged_in($user_name, $user_password);
            if ($query->num_rows() === 1) {
                $data = $query->row();
                if (password_verify($user_password, $data->password)) {
                    $session_data = [];
                    $session_data['id'] = $data->id;
                    $session_data['username'] = $data->username;
                    $session_data['fullname'] = $data->fullname;
                    $session_data['email'] = $data->email;
                    $session_data['user_type'] = $data->user_type;
					$session_data['foto']=$data->foto;
                    $session_data['is_logged_in'] = true;
                    //$session_data['user_privileges'] = $this->CI->m_user_privileges->module_by_user_group_id($data->user_group_id, $data->user_type);
                    $this->CI->session->set_userdata($session_data);
                    $this->last_logged_in($data->id);
					$this->define_user($data->user_type);
                    return true;
                }
                return false;
            }
            return false;
    }

    /**
     * get_user_id
     * @access  public
     * @return integer
     **/
    public function get_user_id() {
        $id = $this->session->userdata('id');
        return !empty($id) ? $id : null;
    }

    /**
     * last_logged_in
     * Fungsi untuk mengupdate data login terakhir
     * @access   public
     * @return   void
     */
    private function last_logged_in($id) {
        $this->CI->m_users->last_logged_in($id);
    }

    /**
     * is_logged_in
     * Fungsi untuk mengecek apakah data session user id kosong / tidak
     * @access   public
     * @return   bool
     */
    public function is_logged_in() {
        return $this->CI->session->userdata('is_logged_in');
    }

    /**
     * restrict
     * Fungsi untuk memvalidasi status login
     * @access   public
     * @return   bool
     */
    public function restrict() {
        if (!$this->is_logged_in()) {
            redirect('home');
        }
    }
	
	private function define_user($user_type){
		switch ($user_type) {
			case 1:
				$jenis="Administrator";
				$url='admin/profile';
				break;
			case 2:
				$jenis="Users";
				$url='user/profile';
				break;						
			default:
		} 		
		
		$session_user = [];
		$session_user['jenis_str']=$jenis;
		$session_user['url_profile']=$url;
		$this->CI->session->set_userdata($session_user);
	}	
}