

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user','msr');
	}

	public function index()
	{
		$data['judul']="Login";
		$this->load->view('login');
	}

	public function login(){
		if($this->msr->login()->num_rows()>0){
			$user = $this->msr->login()->row();
			$array = array(
				'id_user' => $user->id_user,
				'nama_user' => $user->nama_user,
				'username' => $user->username,
				'password' => $user->password,
				'level' => $user->level,);

			$this->session->set_userdata( $array );
			redirect(base_url('index.php/Dashboard'),'refresh');
		}
    else{
			redirect('Login','refresh');
		}
	}

	public function logout(){
			$this->session->sess_destroy();
			redirect('Login','refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
?>
