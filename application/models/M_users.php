<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'users';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	public function get_profile(){
		$query = $this->db->select('*')
				->from(self::$table)
				->where('id',$this->session->id)
				->limit(1)
				->get();
		return $query;
	}
	/**
     * logged_in()
     * @access  public
     * @param   string
     * @return  bool
     */
	public function logged_in($username) {
		return $this->db->select('*')
		->from(self::$table)
         ->where('username', $username)
         ->where('is_active', 1)
         ->limit(1)
         ->get();
	}

	/**
     * last_logged_in()
     * @access  public
     * @param   int
     * @return  void
     */
	public function last_logged_in($id) {
		$fields = [
			'last_logged_in' => date('Y-m-d H:i:s'),
			'ip_address' => get_ip_address()
		];
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, $fields);
	}

	/**
     * reset_logged_in
     * set is_logged_in to false
     * @access  public
     * @param   int
     * @return  void
     */
	public function reset_logged_in($id) {
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, ['is_logged_in' => 0]);
	}


	/**
     * is_user_exist
     * @param 	string
     * @access  public
     * @return  query
     */
	public function is_exist($field, $value) {
		return $this->db
			->where($field, $value)
			->count_all_results(self::$table);
	}

}