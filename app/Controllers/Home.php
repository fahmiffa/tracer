<?php

namespace App\Controllers;

use App\Models\Mdata;
use App\Libraries\Kunci;
use \Mpdf\Mpdf;


class Home extends BaseController
{
	public function __construct()
	{
		$this->uri = service('uri');
		$this->mdata = new Mdata;
		$this->kunci = new Kunci;
		$this->_log_front();
	}


	public function index()
	{
		$lok = $this->mdata->view('tb_loker', 6);

		$data = [
			'title' => 'BKK',
			'lok' => $lok,
			'con' => 'frontend/home',
			'act' => 1
		];
		echo view('frontend/layer', $data);
	}


	public function dashboard()
	{
		$uri = $this->uri->getSegment(2);
		switch ($uri) {
			case  null:
			case false;
			case '':
				$this->_home();
				break;
			case 'alumni':
				$this->_data_alumni();
				break;
			case 'porto':
				$this->_data_porto();
				break;
			default:
				$this->_home();
				break;
		}
	}

	public function _home()
	{
		$cc = $this->mdata->cc(array('al_nis' => session()->nama), 'tb_al');
		$cr = $this->mdata->cc(array('porto_al' => session()->nama), 'tb_porto');
		$data = [
			'da' => $cc,
			'ac' => 0,
			'pr' => $cr,
			'title' => 'Dashboard Alumni',
			'con' => 'frontend/dash',
			'act' => 5
		];
		echo view('frontend/layer', $data);
	}

	public function _data_alumni()
	{
		$cc = $this->mdata->cc(array('al_nis' => session()->nama), 'tb_al');

		$tab  = array('tb_al', 'tb_work');
		$sama   = array('aku', 'tb_al.al_nis=tb_work.work_al');
		$fdata = $this->mdata->join_left($tab, $sama, array('al_nis' => session()->nis));

		$data = [
			'title' => 'Dashboard Data Alumni',
			'al' => $cc,
			'aw' => $fdata,
			'con' => 'frontend/al',
			'ac' => 11,
			'act' => 5
		];
		echo view('frontend/layer', $data);
	}


	public function _data_porto()
	{
		$cc = $this->mdata->cc(array('porto_al' => session()->nama), 'tb_porto');
		$data = [
			'title' => 'Dashboard Data Porto',
			'pr' => $cc,
			'con' => 'frontend/porto',
			'ac' => 22,
			'act' => 5
		];
		echo view('frontend/layer', $data);
	}

	public function act_porto()
	{

		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('des', 'Deskripsi', 'required');


		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;

			$gam = $this->request->getPost('gambar');

			$da = array(
				'porto_id' => random_string('numeric', 5),
				'porto_al' => session()->nama,
				'porto_des' => trim($this->request->getPost('des')),
				'porto_asset' => json_encode($gam),
				'porto_date' => date("Y-m-d"),
				'porto_stat' => 1
			);
			$this->mdata->safe($da, 'tb_porto');
		}
		$data['redirect'] = base_url('dash/porto');

		echo json_encode($data);
	}

	public function upload()
	{
		$file = $this->request->getFile('userfile');
		echo $pile = $this->_porto($file);
	}

	function remove()
	{
		$token = $this->request->getPost('token');
		unlink($token);
	}

	public function alumni()
	{
		$data = [
			'title' => 'Tracer Alumni SMK N 1 Gebang',
			'con' => 'frontend/alumni',
			'act' => 4
		];
		echo view('frontend/layer', $data);
	}

	public function info($d = null)
	{
		$uri = str_replace('-', ' ', $d);
		$cc = $this->mdata->cc(array('pos_name' => $uri), 'tb_pos');

		if ($cc) {
			$data = [
				'title' => 'Info ' . $uri,
				'con' => 'frontend/info',
				'inf' => $cc,
				'act' => 2
			];
			echo view('frontend/layer', $data);
		} else {
			$fetch_data = $this->mdata->view('tb_pos');
			$data = [
				'title' => 'Info',
				'con' => 'frontend/info',
				'inf' => $fetch_data,
				'act' => 2
			];
			echo view('frontend/layer', $data);
		}
	}

	public function loker($d = null)
	{
		$uri = str_replace('-', ' ', $d);

		$cc = $this->mdata->cc(array('loker_name' => $uri), 'tb_loker');

		if ($cc) {
			$data = [
				'title' => 'Lowongan Pekerjaan',
				'con' => 'frontend/page',
				'lok' => $cc,
				'act' => 3
			];
			echo view('frontend/layer', $data);
		} else {
			$fetch_data = $this->mdata->view('tb_loker');
			$data = [
				'title' => 'Lowongan Pekerjaan',
				'con' => 'frontend/loker',
				'lok' => $fetch_data,
				'act' => 3
			];
			echo view('frontend/layer', $data);
		}
	}


	public function root()
	{
		$data = [
			'title' => 'Login Aplikasi',
			'con' => 'login',
		];
		echo view('template/layer', $data);
	}

	public function regis()
	{
		$data = [
			'title' => 'Registrasi Data',
			'con' => 'regis',
		];
		echo view('template/layer', $data);
	}


	public function alumni_1()
	{
		//cek nis 
		$cc = $this->mdata->cc(array('an_al' => session()->nis), 'tb_an');
		$al = $this->mdata->cc(array('al_nis' => session()->nis, 'al_works' => 0), 'tb_al');
		$cr = $this->mdata->cby(array('work_al' => session()->nis), 'tb_work');
		$als = $this->mdata->cc(array('al_nis' => session()->nis, 'al_works' => 1), 'tb_al');

		if (session()->nis) {

			//done
			if ($cc && $al) {
				$data = [
					'title' => 'Konfirmasi Status Pekerjaan',
					'con' => 'frontend/done',
					'load' => 'onload="nomor()"',
					'act' => 4
				];
				echo view('frontend/layer', $data);
				//yet
			} else if ($cr && $als && $cc) {

				$data = [
					'cr' => $cr,
					'title' => 'Konfirmasi Status Pekerjaan',
					'con' => 'frontend/work',
					'load' => 'onload="nomor()"',
					'act' => 4
				];
				echo view('frontend/layer', $data);
			} else {
				$fetch_data = $this->mdata->view('tb_question');
				$data = [
					'title' => 'Data Question',
					'qa' => $fetch_data,
					'con' => 'frontend/question',
					'act' => 4
				];
				echo view('frontend/layer', $data);
			}
		} else {
			return redirect('alumni');
		}
	}

	public function work()
	{
	}

	public function alumni_2()
	{
		if (session()->nis) {

			$data = [
				'title' => 'Data Diri',
				'con' => 'frontend/self',
				'load' => 'onload="nomor()"',
				'act' => 3
			];
			echo view('frontend/layer', $data);
		} else {
			return redirect('alumni');
		}
	}

	public function step_2()
	{
		if (session()->nis) {

			//cek nis 
			$cc = $this->mdata->cc(array('an_al' => session()->nis), 'tb_an');
			$al = $this->mdata->cc(array('al_nis' => session()->nis), 'tb_al');

			if ($cc && $al) {

				$fetch_data = $this->mdata->view('tb_question');
				$data = [
					'title' => 'Step 3',
					'qa' => $fetch_data,
					'con' => 'step3',
				];
				echo view('template/layer', $data);
			} else {

				$fetch_data = $this->mdata->view('tb_question');
				$data = [
					'title' => 'Data Diri',
					'qa' => $fetch_data,
					'con' => 'step2',
				];
				echo view('template/layer', $data);
			}
		} else {
			return redirect('registrasi');
		}
	}


	public function step_work()
	{
		if (session()->nis) {

			//cek nis 
			$cc = $this->mdata->cc(array('an_al' => session()->nis), 'tb_an');
			$al = $this->mdata->cc(array('al_nis' => session()->nis), 'tb_al');

			if ($cc && $al) {

				$fetch_data = $this->mdata->view('tb_question');
				$data = [
					'title' => 'Step 3',
					'qa' => $fetch_data,
					'con' => 'step3',
				];
				echo view('template/layer', $data);
			} else {

				$fetch_data = $this->mdata->view('tb_question');
				$data = [
					'title' => 'Data Diri',
					'qa' => $fetch_data,
					'con' => 'step2',
				];
				echo view('template/layer', $data);
			}
		} else {
			return redirect('registrasi');
		}
	}


	public function act_step1()
	{
		$data = array('success' => false, 'messages' => array());
		$fdata = $this->mdata->view('tb_question');
		$n = count($fdata);

		for ($i = 0; $i < $n; $i++) {
			$this->valid->setRule('qa' . $i, 'Question', 'required');
		}

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$da = [];
			$wh = ['an_al' => session()->nis];
			$cc = $this->mdata->cc($wh, 'tb_an');

			if ($cc) {

				for ($i = 0; $i < $n; $i++) {
					$da  = [
						'an_date' => date("Y-m-d"),
						'an_data' => $this->request->getPost('qa' . $i)
					];
					$wh  = [
						'an_q' => $this->request->getPost('id' . $i),
						'an_al' => session()->nis
					];
					$this->mdata->ud($wh, 'tb_an', $da);
				}
			} else {
				for ($i = 0; $i < $n; $i++) {
					$da[]  = [
						'an_id' => random_string('numeric', 3) . $i,
						'an_q' => $this->request->getPost('id' . $i),
						'an_al' => session()->nis,
						'an_date' => date("Y-m-d"),
						'an_data' => $this->request->getPost('qa' . $i)
					];
				}
				$this->mdata->inbatch($da, 'tb_an');
			}

			$data['redirect'] = base_url('alumni/step-2');
		}
		echo json_encode($data);
	}

	public function act_step2()
	{
		$nis = $this->request->getPost('nis');

		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('email', 'Email', 'required|valid_email|is_unique[tb_al.al_email,al_nis,{nis}]');
		$this->valid->setRule('hp', 'HP', 'required');
		$this->valid->setRule('al', 'Alamat', 'required');
		$this->valid->setRule('work', 'Deskripsi', 'required');
		$this->valid->setRule('works', 'Status', 'required');
		$this->valid->setRule('image', 'Gambar', 'uploaded[image]|ext_in[image,png,jpg,jpeg]|mime_in[image,image/png,image/jpg,image/jpeg]|max_size[image,1024]');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
			foreach ($_FILES as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;

			$file = $this->request->getFile('image');
			$pile = $this->_upimg($file);
			$nis = session()->nis;

			$da = array(
				'al_email' => trim($this->request->getPost('email')),
				'al_hp' => trim($this->request->getPost('hp')),
				'al_addr' => trim($this->request->getPost('al')),
				'al_works' => trim($this->request->getPost('works')),
				'al_asset' => $pile,
				'al_stat' => 1,
				'al_date' => date("Y-m-d")
			);
			$this->mdata->ud(array('al_nis' => session()->nis), 'tb_al', $da);

			$ad = [
				'work_id' => 'W' . random_string('numeric', 5),
				'work_al' => $nis,
				'work_name' => trim($this->request->getPost('workn')),
				'work_des' => trim($this->request->getPost('works')),
				'work_pay' => format_num($this->request->getPost('price')),
				'work_date' => date('Y-m-d')
			];
			$this->mdata->safe($ad, 'tb_work');



			session()->remove('nis');
			$data['msg'] = '<p class="mb-0">Terima Kasih atas Partisipasi Anda mendukung program Tracer Alumni di SMK N 1 GEBANG </p>
							<p>Untuk Selanjutnya menunggu verifikasi admin untuk mendapatakan Account</p>
							<div class="d-flex justify-content-center">
								<div class="p-2">
									<a href="' . base_url('alumni') . '" class="btn btn-primary"><i class="fa fa-caret-right"></i>&nbsp;Isi Ulang Tracer</a>
								</div>
								<div class="p-2">
									<a target="_blank" href="' . base_url('pdf/' . $nis) . '" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;Cetak Bukti Pengisian Tracer</a>
								</div>
								<div class="p-2">
								<a href="' . base_url() . '" class="btn btn-danger">Close</a>
								</div>
							</div>
							';
		}

		echo json_encode($data);
	}


	public function act_al()
	{
		$nis = $this->request->getPost('nis');

		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('email', 'Email', 'required|valid_email|is_unique[tb_al.al_email,al_nis,{nis}]');
		$this->valid->setRule('hp', 'HP', 'required');
		$this->valid->setRule('al', 'Alamat', 'required');
		// $this->valid->setRule('work', 'Deskripsi', 'required');
		$this->valid->setRule('works', 'Status', 'required');
		// $this->valid->setRule('image', 'Gambar', 'uploaded[image]|ext_in[image,png,jpg,jpeg]|mime_in[image,image/png,image/jpg,image/jpeg]|max_size[image,1024]');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
			foreach ($_FILES as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$cc = $this->mdata->cc(array('al_nis' => $nis), 'tb_al');

			if (!empty($_FILES['image']['name'])) {
				$file = $this->request->getFile('image');
				$pile = $this->_upimg($file);
				unlink($cc[0]->al_asset);
			} else {
				$pile = $cc[0]->al_asset;
			}

			$da = array(
				'al_email' => trim($this->request->getPost('email')),
				'al_name' => trim($this->request->getPost('nam')),
				'al_hp' => trim($this->request->getPost('hp')),
				'al_addr' => trim($this->request->getPost('al')),
				'al_works' => trim($this->request->getPost('works')),
				'al_asset' => $pile,
				'al_stat' => 2,
				'al_date' => date("Y-m-d")
			);
			$this->mdata->ud(array('al_nis' => $nis), 'tb_al', $da);

			$this->session->setFlashdata(
				'info',
				"<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Success, </strong> Berhasil update data. </div>"
			);
		}
		$data['redirect'] = base_url('dash/alumni');

		echo json_encode($data);
	}


	function _upimg($file)
	{
		$path = 'public/asset/img/';
		$fname = $file->getRandomName();
		$file->move(ROOTPATH . $path, $fname);

		$pile = 'asset/img/' . $fname;

		$info = \Config\Services::image();
		$info->withFile($pile)->getFile()->getProperties(true);
		$info->withFile($pile)->fit(500, 500, 'center')->save('asset/thumb/' . $fname);

		$thum = 'asset/thumb/' . $fname;
		unlink($pile);
		return $thum;
	}


	function logout()
	{
		$this->session->destroy();
		return redirect('/');
	}

	public function action()
	{
		$this->valid->setRule('uname', 'Username', 'required');
		$this->valid->setRule('password', 'Password', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			$this->session->setFlashdata(
				'info',
				"<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Gagal!</strong> username or password invalid. </div>"
			);
			return redirect('login');
		} else {

			$pass = trim($this->request->getPost('password'));
			$user = array(
				'account_name' => trim($this->request->getPost('uname'))
			);
			$ff = $this->mdata->cc($user, 'tb_account');
			if ($ff) {
				$pas = $this->kunci->openhash($pass, $ff[0]->account_pass);

				if ($pas) {
					$newdata = [
						'id' => $ff[0]->account_id,
						'role' => $ff[0]->account_role,
						'nama'  => $ff[0]->account_name,
						'waktu' => date("Y-m-d H:i:s"),
						'logged_in' => TRUE
					];
					$this->session->set($newdata);

					$this->_notif('login');

					if ($ff[0]->account_role == 'admin') {
						return redirect('dashboard');
					} else {
						return redirect('/');
					}
				} else {
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Gagal!</strong> Username or Password salah. </div>"
					);
					return redirect('root');
				}
			} else {
				$this->session->setFlashdata(
					'info',
					"<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Gagal!</strong> Akun tidak di temukan. </div>"
				);
				return redirect('root');
			}
		}
	}

	public function login()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('uname', 'NIS', 'required');
		$this->valid->setRule('password', 'Password', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {

			$data['success'] = true;
			$pass = trim($this->request->getPost('password'));
			$user = array(
				'account_name' => trim($this->request->getPost('uname'))
			);
			$ff = $this->mdata->cc($user, 'tb_account');
			if ($ff) {
				$pas = $this->kunci->openhash($pass, $ff[0]->account_pass);

				if ($pas) {
					$newdata = [
						'id' => $ff[0]->account_id,
						'role' => $ff[0]->account_role,
						'nama'  => $ff[0]->account_name,
						'waktu' => date("Y-m-d H:i:s"),
						'logged_in' => TRUE
					];
					$this->session->set($newdata);

					$this->_notif('login');
					if ($ff[0]->account_role != 'alumni') {
						$this->session->setFlashdata(
							'info',
							"<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<strong>Failed!</strong> Username or Password Wrong. </div>"
						);
					}
				} else {
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Failed!</strong> Username or Password Wrong. </div>"
					);
				}
			} else {
				$this->session->setFlashdata(
					'info',
					"<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Failed!</strong> Account not found. </div>"
				);
			}
			$data['redirect'] = base_url();
		}
		echo json_encode($data);
	}

	public function reg()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('key', 'Field', 'required');
		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$key = trim($this->request->getPost('key'));

			$wh = ['al_nis' => $key];
			$or = ['al_name' => $key, 'al_in' => $key, 'al_hp' => $key];
			$da = 	$this->mdata->finds($wh, 'tb_al', $or);

			$d = array();

			foreach ($da as $row) {
				$sub_array = array();
				$sub_array[] = '<div class="card bg-light text-dark mb-3 open" data-toggle="modal" data-target="#myModal" id="' . $row->al_nis . '"><div class="card-body">NIS : ' . $row->al_nis . '&nbsp;|&nbsp;&nbsp;Nama : ' . $row->al_name .
					'&nbsp;|&nbsp;&nbsp;Kelas : ' . $row->al_class . '&nbsp;|&nbsp;&nbsp;Tahun Lulus : ' . $row->al_in . ' </div></div>';
				$d[] = $sub_array;
			}

			$data['al'] = $d;
		}
		echo json_encode($data);
	}

	//gate
	public function act()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('date', 'Tanggal', 'cek');
		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$nis = trim($this->request->getPost('nis'));
			$newdata = [
				'nis' => $nis,
			];
			$this->session->set($newdata);

			$al = $this->mdata->cc(array('al_nis' => session()->nis, 'al_stat' => 1), 'tb_al');
			$date = $this->request->getPost('date');
			$dt1 = date('Y-m-d', strtotime($date));
			$wh = ['al_nis' => $nis, 'al_birth' => $dt1];
			$cc = $this->mdata->cc($wh, 'tb_al');


			if ($al) {
				$data['redirect'] = base_url('alumni/step-1');
			} else {
				$data['siswa'] = '						
				<p>Data Anda adala berikut :</p>
				<table class="table table-borderless">				
					<tbody>
					<tr>
						<td>Nama</td>
						<td>' . $cc[0]->al_name . '</td>									
					</tr>	
					<tr>
						<td>Tanggal Lahir</td>
						<td>' . date_to_id($cc[0]->al_birth) . '</td>									
					</tr>	
					<tr>
						<td>Kelas</td>
						<td>' . $cc[0]->al_class . '</td>									
					</tr>	
					<tr>
						<td>Tahun Masuk</td>
						<td>' . $cc[0]->al_in . '</td>									
					</tr>		
					</tbody>
				</table>						
				<p>Jika Benar Silahkan lanjutkan</p>
				<a href="' . base_url('alumni/step-1') . '" class="btn btn-primary">Next</a>
				<a href="' . base_url('alumni') . '" class="btn btn-danger">Close</a>';
			}
		}

		echo json_encode($data);
	}

	public function act_yet()
	{

		$data = array('success' => false, 'messages' => array());

		$this->valid->setRule('price', 'Pendapatan', 'required_with[as]');
		$this->valid->setRule('workn', 'Bekerja', 'required_with[as]');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;

			$wr = $this->request->getPost('as');
			$nis = session()->nis;

			if ($wr == 1) {
				$da = array(
					'al_works' => $wr,
					'al_stat' => 1,
					'al_date' => date("Y-m-d")
				);
				$this->mdata->ud(array('al_nis' => session()->nis), 'tb_al', $da);

				$ad = [
					'work_id' => 'W' . random_string('numeric', 5),
					'work_al' => $nis,
					'work_name' => trim($this->request->getPost('workn')),
					'work_des' => trim($this->request->getPost('works')),
					'work_pay' => format_num($this->request->getPost('price')),
					'work_date' => date('Y-m-d H:i:s')
				];
				$this->mdata->safe($ad, 'tb_work');
			}

			session()->remove('nis');
			$data['msg'] = '<p class="mb-0">Terima Kasih atas Partisipasi Anda mendukung program Tracer Alumni di SMK N 1 GEBANG </p>
							<p>Untuk Selanjutnya menunggu verifikasi admin untuk mendapatakan Account</p>
							<div class="d-flex justify-content-center">
								<div class="p-2">
									<a href="' . base_url('alumni') . '" class="btn btn-primary"><i class="fa fa-caret-right"></i>&nbsp;Isi Ulang Tracer</a>
								</div>
								<div class="p-2">
									<a target="_blank" href="' . base_url('pdf/' . $nis) . '" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;Cetak Bukti Pengisian Tracer</a>
								</div>
								<div class="p-2">
								<a href="' . base_url() . '" class="btn btn-danger">Close</a>
								</div>
							</div>
							';
		}

		echo json_encode($data);
	}

	public function act_done()
	{

		$data = array('success' => false, 'messages' => array());

		$this->valid->setRule('price', 'Pendapatan', 'required_with[as]');
		$this->valid->setRule('workn', 'Bekerja', 'required_with[as]');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() != TRUE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;

			echo $wr = $this->request->getPost('as');
			$nis = session()->nis;

			if ($wr == 1) {
				$da = array(
					'al_works' => $wr,
					'al_stat' => 1,
					'al_date' => date("Y-m-d")
				);
				$this->mdata->ud(array('al_nis' => session()->nis), 'tb_al', $da);

				$ad = [
					'work_id' => 'W' . random_string('numeric', 5),
					'work_al' => $nis,
					'work_name' => trim($this->request->getPost('workn')),
					'work_des' => trim($this->request->getPost('works')),
					'work_pay' => format_num($this->request->getPost('price')),
					'work_date' => date('Y-m-d H:i:s')
				];
				$this->mdata->safe($ad, 'tb_work');
			}

			session()->remove('nis');
			$data['msg'] = '<p class="mb-0">Terima Kasih atas Partisipasi Anda mendukung program Tracer Alumni di SMK N 1 GEBANG </p>
							<p>Untuk Selanjutnya menunggu verifikasi admin untuk mendapatakan Account</p>
							<div class="d-flex justify-content-center">
								<div class="p-2">
									<a href="' . base_url('alumni') . '" class="btn btn-primary"><i class="fa fa-caret-right"></i>&nbsp;Isi Ulang Tracer</a>
								</div>
								<div class="p-2">
									<a target="_blank" href="' . base_url('pdf/' . $nis) . '" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;Cetak Bukti Pengisian Tracer</a>
								</div>
								<div class="p-2">
								<a href="' . base_url() . '" class="btn btn-danger">Close</a>
								</div>
							</div>
							';
		}

		echo json_encode($data);
	}


	public function pdf($da)
	{

		$nis = $da;

		$al = $this->mdata->cc(array('al_nis' => $nis), 'tb_al');

		if ($al) {
			$mpdf = new Mpdf(['mode' => 'utf-8']);

			$where = array('al_nis' => $nis);
			$tab  = array('tb_al', 'tb_work');
			$sama   = array(
				'aku',
				'tb_al.al_nis=tb_work.work_al'
			);
			$data['al'] = $this->mdata->join($tab, $sama, $where);

			$html = view('pdf', $data);
			$mpdf->allow_charset_conversion = true;
			$mpdf->charset_in = 'UTF-8';

			$mpdf->autoLangToFont = true;
			$mpdf->autoPageBreak = true;

			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($da . '.pdf', 'I'));
		} else {
			echo view('404');
		}
	}

	public function email()
	{
		echo $this->_email();
	}
}
