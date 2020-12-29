<?php

namespace App\Controllers;

use App\Models\Mdata;
use App\Libraries\Kunci;
use \Mpdf\Mpdf;


class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->_log_dash();
		$this->uri = service('uri');
		$this->mdata = new Mdata;
		$this->kunci = new Kunci;
	}

	public function index()
	{

		$data = [
			'title' => 'Dashboard Aplikasi',
			"notif" => $this->nf,
			'con' => 'content',
			'act' => 0,
			'in' => 1
		];
		echo view('template/layer', $data);
	}

	public function dcommon()
	{
		$da = $this->request->getPost('Id');
		$alc = $this->mdata->cc(array('al_id' => $da), 'tb_al');
		$ac = $this->mdata->cc(array('account_id' => $da), 'tb_account');
		$qc = $this->mdata->cc(array('q_id' => $da), 'tb_question');
		$lk = $this->mdata->cc(array('loker_id' => $da), 'tb_loker');
		$ps = $this->mdata->cc(array('pos_id' => $da), 'tb_pos');
		if ($alc) {
			$this->mdata->dc(array('al_id' => $da), 'tb_al');
			$this->_notif('delete alumni');
			echo 'delete Alumni ' . $alc[0]->al_name;
		} else if ($qc) {
			$this->mdata->dc(array('q_id' => $da), 'tb_question');
			echo 'delete question';
			$this->_notif('delete Question');
		} else if ($ac) {
			$this->mdata->dc(array('account_id' => $da), 'tb_account');
			$this->_notif('delete account');
			echo 'delete account ' . $ac[0]->account_name;
		} else if ($lk) {
			$this->mdata->dc(array('loker_id' => $da), 'tb_loker');
			echo 'delete Loker';
			unlink($lk[0]->loker_asset);
			$this->_notif('delete Loker');
		} else if ($ps) {
			$this->mdata->dc(array('pos_id' => $da), 'tb_pos');
			echo 'delete Pos';
			unlink($ps[0]->pos_asset);
			$this->_notif('delete Pos');
		}
	}

	public function up()
	{
		$da = $this->request->getPost('Id');
		$alc = $this->mdata->cc(array('al_id' => $da), 'tb_al');
		if ($alc) {
			// $this->mdata->ud(array('al_id' => $da), 'tb_al', array('al_stat' => 2));
			$di = random_string('numeric', 4);
			$ps = random_string('alnum', 5);
			$pas = $this->kunci->lockhash($ps);
			$da = array(
				'account_id' => $di,
				'account_name' => $alc[0]->al_nis,
				'account_pass' => $pas,
				'account_role' => 'alumni',
				'pas' => $ps
			);
			$this->mdata->safe($da, 'tb_account');
			// send email
			$this->_email($alc[0]->al_email, $alc[0]->al_nis, $ps);
			$this->_notif('update status & tambah account alumni');
			echo 'create account Alumni ' . $alc[0]->al_name;
		}
	}

	public function alumni($da)
	{
		$nm = str_replace('-', ' ', $da);

		// $tab  = array('tb_al', 'tb_work');
		// $sama   = array('aku', 'tb_al.al_nis=tb_work.work_al');
		// $fdata = $this->mdata->join_row($tab, $sama, array('al_name' => $nm));

		$cc = $this->mdata->crow(array('al_name' => $nm), 'tb_al');
		$data = [
			'title' => 'Data Alumni',
			'jan' => $cc,
			'da' => base_url('dashboard/data-work/' . $cc->al_nis),
			"notif" => $this->nf,
			'con' => 'profile',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_work($al)
	{
		$cc = $this->mdata->cv(array('work_al' => $al), 'tb_work');
		$data = array();
		$no = 1;
		$i = 0;

		foreach ($cc as $row) {
			$i++;

			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->work_name;
			if (!empty($row->work_pay)) {
				$sub_array[] = format_rp($row->work_pay);
			} else {
				$sub_array[] = '';
			}
			$sub_array[] = date_to_id($row->work_date);
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	// data
	public function data()
	{
		$seg3 = $this->uri->getSegment(3);
		$seg4 = $this->uri->getSegment(4);
		switch ($seg3) {
			case 'alumni':
				$this->_alumni();
				break;
			case 'loker':
				$this->_loker();
				break;
			case 'account':
				$this->_account();
				break;
			case 'question':
				$this->_question($seg4);
				break;
			case 'answer':
				$this->_answer();
				break;
			default:
				return view('404');
				break;
		}
	}

	public function _alumni()
	{
		$data = [
			'title' => 'Data Alumni',
			'da' => base_url('data-alumni'),
			"notif" => $this->nf,
			'con' => 'data/alumni',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_alumni()
	{
		$fetch_data = $this->mdata->view('tb_al');

		$data = array();
		$no = 1;
		$i = 0;

		foreach ($fetch_data as $row) {
			$i++;
			// $work = (array) $row->al_work;

			$cc = $this->mdata->cc(array('account_name' => $row->al_nis), 'tb_account');

			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->al_name;
			$sub_array[] = $row->al_nis;
			$sub_array[] = date_to_id($row->al_birth);
			$sub_array[] = $row->al_email . '<br>' . $row->al_hp;
			$sub_array[] = $row->al_addr;
			if ($cc) {
				$sub_array[] = '
				 <button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->al_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;							
				 <a href="' . base_url('dashboard/edit-alumni/' . $row->al_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
				 <a href="' . base_url('dashboard/alumni/' . url_title($row->al_name)) . '" class="btn btn-success btn-xs"><i class="fa fa-user"></i></a>';
			} else {
				$sub_array[] = '
				<button type="button" uri="' . base_url('dashboard/up') . '"  name="up" id="' . $row->al_id . '" class="btn btn-info btn-xs up"><i class="fa fa-info"></i></button>&nbsp;
				<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->al_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;							
				<a href="' . base_url('dashboard/edit-alumni/' . $row->al_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
				<a href="' . base_url('dashboard/alumni/' . url_title($row->al_name)) . '" class="btn btn-success btn-xs"><i class="fa fa-user"></i></a>';
			}

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_alumni()
	{
		$data = [
			'title' => 'Tambah Alumni',
			"notif" => $this->nf,
			'con' => 'add/alumni',
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_alumni()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('al_id' => $ac), 'tb_al');
		if ($cc) {
			$data = [
				'title' => 'Edit Client',
				"notif" => $this->nf,
				'con' => 'add/alumni',
				'act' => 0,
				'da' => $cc
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_alumni()
	{
		$n = strlen(date("Y"));
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('nis', 'NIS', 'required|is_unique[tb_al.al_nis,al_id,{id}]');
		$this->valid->setRule('email', 'Email', 'required|valid_email|is_unique[tb_al.al_email,al_id,{id}]');
		$this->valid->setRule('hp', 'HP', 'required');
		$this->valid->setRule('kelas', 'Kelas', 'required');
		$this->valid->setRule('birth', 'Tanggal', 'required');
		$this->valid->setRule('in', 'Tanggal Masuk', 'required|exact_length[' . $n . ']');
		$this->valid->setRule('al', 'Alamat', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('al_id' => $id), 'tb_al');

			if ($cc) {
				$da = array(
					'al_email' => trim($this->request->getPost('email')),
					'al_nis' => trim($this->request->getPost('nis')),
					'al_name' => trim($this->request->getPost('name')),
					'al_hp' => trim($this->request->getPost('hp')),
					'al_class' => trim($this->request->getPost('kelas')),
					'al_in' => trim($this->request->getPost('in')),
					'al_birth' => trim($this->request->getPost('birth')),
					'al_addr' => trim($this->request->getPost('al')),
				);
				$this->mdata->ud(array('al_id' => $id), 'tb_al', $da);
				$this->_notif('update alumni');
				$data['redirect'] = base_url('dashboard/data/alumni');
			} else {
				$da = array(
					'al_id' => 'al' . random_string('numeric', 3),
					'al_email' => trim($this->request->getPost('email')),
					'al_nis' => trim($this->request->getPost('nis')),
					'al_name' => trim($this->request->getPost('name')),
					'al_hp' => trim($this->request->getPost('hp')),
					'al_class' => trim($this->request->getPost('kelas')),
					'al_in' => trim($this->request->getPost('in')),
					'al_birth' => trim($this->request->getPost('birth')),
					'al_addr' => trim($this->request->getPost('al')),
				);
				$this->mdata->safe($da, 'tb_al');
				$this->_notif('tambah Alumni');
				$data['redirect'] = base_url('dashboard/data/alumni');
			}
		}

		echo json_encode($data);
	}


	public function _loker()
	{
		$data = [
			'title' => 'Data Loker',
			'da' => base_url('data-loker'),
			"notif" => $this->nf,
			'con' => 'data/loker',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_loker()
	{
		$fetch_data = $this->mdata->view('tb_loker');

		$data = array();
		$no = 1;

		foreach ($fetch_data as $row) {

			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->loker_name;
			$sub_array[] = date_to_id($row->loker_date);
			$sub_array[] = '<img  width="30%" src="' . base_url($row->loker_asset) . '">';
			$sub_array[] = '<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->loker_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;							
								<a href="' . base_url('dashboard/edit-loker/' . $row->loker_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_loker()
	{
		$data = [
			'title' => 'Tambah Loker',
			"notif" => $this->nf,
			'con' => 'add/loker',
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_loker()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('loker_id' => $ac), 'tb_loker');
		if ($cc) {
			$data = [
				'title' => 'Edit Loker',
				"notif" => $this->nf,
				'con' => 'add/loker',
				'act' => 0,
				'da' => $cc
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_loker()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('des', 'Deskripsi', 'required');
		$this->valid->setRule('date', 'Tanggal', 'required');
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
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('loker_id' => $id), 'tb_loker');


			if ($cc) {

				if (isset($_FILES['image']['name'])) {
					$file = $this->request->getFile('image');
					$pile = $this->_upimg($file);
					unlink($cc[0]->loker_asset);
				} else {
					$pile = $cc[0]->loker_asset;
				}

				$da = array(
					'loker_name' => trim($this->request->getPost('name')),
					'loker_con' => trim($this->request->getPost('des')),
					'loker_date' => trim($this->request->getPost('date')),
					'loker_asset' => $pile,
				);
				$this->mdata->ud(array('loker_id' => $id), 'tb_loker', $da);
				$this->_notif('update loker');
			} else {
				$file = $this->request->getFile('image');
				$pile = $this->_upimg($file);
				$da = array(
					'loker_id' => 'L' . random_string('numeric', 3),
					'loker_name' => trim($this->request->getPost('name')),
					'loker_con' => trim($this->request->getPost('des')),
					'loker_date' => trim($this->request->getPost('date')),
					'loker_asset' => $pile,
				);
				$this->mdata->safe($da, 'tb_loker');
				$this->_notif('tambah loker');
			}
			$data['redirect'] = base_url('dashboard/data/loker');
		}

		echo json_encode($data);
	}


	public function _account()
	{
		$data = [
			'title' => 'Data Account',
			'da' => base_url('data-account'),
			"notif" => $this->nf,
			'con' => 'data/account',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_account()
	{
		$fetch_data = $this->mdata->view('tb_account');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->account_name;
			$sub_array[] = $row->pas;
			$sub_array[] = $row->account_role;
			$sub_array[] = '<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->account_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;
							<button id="' . $row->account_id . '" class="btn btn-primary btn-xs edit"><i class="fa fa-edit"></i></button>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_account()
	{
		$data = [
			'title' => 'Tambah Account',
			"notif" => $this->nf,
			'con' => 'add/alumni',
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_account()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('al_id' => $ac), 'tb_al');
		if ($cc) {
			$data = [
				'title' => 'Edit Client',
				"notif" => $this->nf,
				'con' => 'add/alumni',
				'act' => 0,
				'da' => $cc
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_account()
	{
		$n = strlen(date("Y"));
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Username', 'required');
		$this->valid->setRule('pass', 'Password', 'required');
		$this->valid->setRule('tipe', 'Password', 'required');
		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$ps = trim($this->request->getPost('pass'));
			$cc = $this->mdata->cc(array('account_id' => $id), 'tb_account');
			$pas = $this->kunci->lockhash($ps);
			if ($cc) {
				$da = array(
					'account_name' => trim($this->request->getPost('name')),
					'account_pass' => $pas,
					'account_role' => trim($this->request->getPost('tipe')),
					'pas' => $ps
				);
				$this->mdata->ud(array('account_id' => $id), 'tb_account', $da);
				$this->_notif('update Account');
			} else {
				$di = random_string('numeric', 5);
				$da = array(
					'account_id' => $di,
					'account_name' => trim($this->request->getPost('name')),
					'account_pass' => $pas,
					'account_role' => trim($this->request->getPost('tipe')),
					'pas' => $ps
				);
				$this->mdata->safe($da, 'tb_account');
				$this->_notif('tambah Account');
			}
			$data['redirect'] = base_url('dashboard/data/account');
		}

		echo json_encode($data);
	}




	public function _question($da)
	{
		if (!empty($da)) {
			$this->_qna($da);
		} else {
			$data = [
				'title' => 'Data Question',
				'da' => base_url('data-ques'),
				"notif" => $this->nf,
				'con' => 'data/question',
				'act' => 1
			];
			echo view('template/layer', $data);
		}
	}

	public function _qna($da)
	{
		$cc = $this->mdata->cc(array('q_id' => $da), 'tb_question');
		if ($cc) {
			$data = [
				'title' => 'Data Question',
				'na' => $cc[0]->q_name,
				'da' => base_url('data-qna/' . $da),
				"notif" => $this->nf,
				'con' => 'data/qna',
				'act' => 1
			];
			echo view('template/layer', $data);
		}
	}

	public function data_qna($da)
	{
		$tab  = array('tb_al', 'tb_an');
		$sama   = array('aku', 'tb_al.al_nis=tb_an.an_al');
		$fetch_data = $this->mdata->join($tab, $sama, array('an_q' => $da));

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->al_name;
			$sub_array[] = $row->an_data;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function data_question()
	{
		$fetch_data = $this->mdata->view('tb_question');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->q_name;
			$sub_array[] = '<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->q_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;
								<a href="' . base_url('dashboard/edit-question/' . $row->q_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_question()
	{
		$data = [
			'title' => 'Add Question',
			"notif" => $this->nf,
			'con' => 'add/question',
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_question()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('q_id' => $ac), 'tb_question');
		if ($cc) {
			$data = [
				'title' => 'Edit Question',
				"notif" => $this->nf,
				'con' => 'add/question',
				'act' => 0,
				'da' => $cc
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_question()
	{
		$n = strlen(date("Y"));
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('ques', 'Question', 'required');
		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('q_id' => $id), 'tb_question');

			if ($cc) {
				$da = array(
					'q_name' => trim($this->request->getPost('ques'))
				);
				$this->mdata->ud(array('q_id' => $id), 'tb_question', $da);
				$this->_notif('update question');
				$data['redirect'] = base_url('dashboard/data/question');
			} else {
				$da = array(
					'q_id' => 'Q' . random_string('numeric', 3),
					'q_name' => trim($this->request->getPost('ques'))
				);
				$this->mdata->safe($da, 'tb_question');
				$this->_notif('tambah Question');
				$data['redirect'] = base_url('dashboard/data/question');
			}
		}

		echo json_encode($data);
	}


	public function _answer()
	{
		$data = [
			'title' => 'Data Answer',
			'da' => base_url('dashboard/data-answer'),
			"notif" => $this->nf,
			'con' => 'data/answer',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_answer()
	{
		$fetch_data = $this->mdata->view('tb_question');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {

			$an = $this->mdata->cc(array('an_q' => $row->q_id), 'tb_an');
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->q_name;
			$sub_array[] = '<a href="' . base_url('dashboard/data/question/' . $row->q_id) . '" class="btn btn-primary btn-xs">' . count($an) . '</a>';
			// $sub_array[] = '<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->q_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;
			// 					<a href="' . base_url('dashboard/edit-question/' . $row->q_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	// widget
	public function widget()
	{
		$seg3 = $this->uri->getSegment(3);
		switch ($seg3) {
			case 'cover':
				$this->_cover();
				break;
			case 'pos':
				$this->_pos();
				break;
			default:
				return view('404');
				break;
		}
	}

	public function _cover()
	{
		$cc = $this->mdata->view('tb_widget');

		$data = [
			'title' => 'Cover',
			"notif" => $this->nf,
			'con' => 'widget/cover',
			'act' => 2,
			'da' => $cc,
		];
		echo view('template/layer', $data);
	}


	public function act_cover()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
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
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('widget_id' => $id), 'tb_widget');

			if ($cc) {

				if (isset($_FILES['image']['name'])) {
					$file = $this->request->getFile('image');
					$pile = $this->_upcover($file);
					unlink($cc[0]->widget_cover);
				} else {
					$pile = $cc[0]->widget_cover;
				}

				$da = array(
					'widget_name' => trim($this->request->getPost('name')),
					'widget_date' => date('Y-m-d'),
					'widget_cover' => $pile,
				);
				$this->mdata->ud(array('widget_id' => $id), 'tb_widget', $da);
				$this->_notif('update widget cover');
			} else {
				$file = $this->request->getFile('image');
				$pile = $this->_upcover($file);
				$da = array(
					'widget_id' => 'C' . random_string('numeric', 3),
					'widget_name' => trim($this->request->getPost('name')),
					'widget_date' => date('Y-m-d'),
					'widget_cover' => $pile,
				);
				$this->mdata->safe($da, 'tb_widget');
				$this->_notif('tambah widget cover');
			}
			$data['redirect'] = base_url('dashboard/widget/cover');
			$this->session->setFlashdata(
				'info',
				"<div class='alert alert-info alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Berhasil</strong> Menyimpan data . </div>"
			);
		}

		echo json_encode($data);
	}

	public function _pos()
	{
		$data = [
			'title' => 'Data Pos',
			'da' => base_url('data-pos'),
			"notif" => $this->nf,
			'con' => 'data/loker',
			'act' => 2
		];
		echo view('template/layer', $data);
	}

	public function data_pos()
	{
		$fetch_data = $this->mdata->view('tb_pos');

		$data = array();
		$no = 1;

		foreach ($fetch_data as $row) {

			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->pos_name;
			$sub_array[] = date_to_id($row->pos_date);
			$sub_array[] = '<img  width="30%" src="' . base_url($row->pos_asset) . '">';
			$sub_array[] = '<button type="button" uri="' . base_url('dashboard/dcommon') . '"  name="delete" id="' . $row->pos_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;							
								<a href="' . base_url('dashboard/edit-pos/' . $row->pos_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_pos()
	{
		$data = [
			'title' => 'Tambah Pos',
			"notif" => $this->nf,
			'con' => 'add/pos',
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_pos()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('pos_id' => $ac), 'tb_pos');
		if ($cc) {
			$data = [
				'title' => 'Edit pos',
				"notif" => $this->nf,
				'con' => 'add/pos',
				'act' => 0,
				'da' => $cc
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_pos()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('des', 'Deskripsi', 'required');
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
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('pos_id' => $id), 'tb_pos');
			if ($cc) {
				if (isset($_FILES['image']['name'])) {
					$file = $this->request->getFile('image');
					$pile = $this->_upimg($file);
					unlink($cc[0]->pos_asset);
				} else {
					$pile = $cc[0]->pos_asset;
				}
				$da = array(
					'pos_name' => trim($this->request->getPost('name')),
					'pos_des' => trim($this->request->getPost('des')),
					'pos_date' => date('Y-m-d'),
					'pos_asset' => $pile,
				);
				$this->mdata->ud(array('pos_id' => $id), 'tb_pos', $da);
				$this->_notif('update pos');
			} else {
				$file = $this->request->getFile('image');
				$pile = $this->_upimg($file);
				$da = array(
					'pos_id' => 'P' . random_string('numeric', 3),
					'pos_name' => trim($this->request->getPost('name')),
					'pos_des' => trim($this->request->getPost('des')),
					'pos_date' => date('Y-m-d'),
					'pos_asset' => $pile,
				);
				$this->mdata->safe($da, 'tb_pos');
				$this->_notif('tambah pos');
			}
			$data['redirect'] = base_url('dashboard/widget/pos');
		}

		echo json_encode($data);
	}




	//laporan
	public function laporan()
	{
		$seg3 = $this->uri->getSegment(3);
		switch ($seg3) {
			case 'income':
				$this->_income();
				break;
			case 'bill':
				$this->_bill();
				break;
			case 'other':
				$this->_other();
				break;
			default:
				return view('404');
				break;
		}
	}

	public function _income()
	{
		$id = $this->session->id;
		$where = array('reg_sales' => $id, 'bil_stat' => 1);
		$tab  = array('tb_reg', 'tb_client', 'tb_sales', 'tb_service_sales', 'tb_bill');
		$sama   = array(
			'aku',
			'tb_reg.reg_client=tb_client.client_id',
			'tb_reg.reg_sales=tb_sales.sales_id',
			'tb_reg.reg_paket=tb_service_sales.service_id',
			'tb_reg.reg_id=tb_bill.bil_reg'
		);
		$sum = ['service_price', 'bil_uniq', 'reg_ppn'];
		$tot = $this->mdata->join_sum($tab, $sama, $where, $sum);


		$wh = array('prof_id' => $id);
		$ta  = array('tb_prof', 'tb_services');
		$sam   = array('aku', 'tb_prof.prof_paket=tb_services.services_id');
		$pak = $this->mdata->join($ta, $sam, $wh);

		$data = [
			'title' => 'Data Revenue',
			'da' => base_url('dashboard/data-income'),
			"notif" => $this->nf,
			'con' => 'laporan/income',
			'act' => 3,
			"pa" => $pak,
			'ot' => $tot
		];
		echo view('template/layer', $data);
	}

	public function _other()
	{
		$data = [
			'title' => 'Biaya Lain-lain',
			'da' => base_url('dashboard/data-other'),
			"notif" => $this->nf,
			'con' => 'laporan/other',
			'act' => 3,
		];
		echo view('template/layer', $data);
	}


	public function _bill()
	{
		$dt = $this->request->getPost("date") ? $this->request->getPost("date") : date("Y-m");
		$py = $this->request->getPost("pay") ? $this->request->getPost("pay") : 1;

		$id = $this->session->id;
		$where = array('reg_sales' => $id, 'bil_stat' => 0);
		$tab  = array('tb_reg', 'tb_client', 'tb_sales', 'tb_service_sales', 'tb_bill');
		$sama   = array(
			'aku',
			'tb_reg.reg_client=tb_client.client_id',
			'tb_reg.reg_sales=tb_sales.sales_id',
			'tb_reg.reg_paket=tb_service_sales.service_id',
			'tb_reg.reg_id=tb_bill.bil_reg'
		);
		$sum = ['service_price', 'bil_uniq'];
		$tot = $this->mdata->join_sum($tab, $sama, $where, $sum);

		$data = [
			'title' => 'Billing Data',
			'da' => base_url('dashboard/data-bil'),
			'uri' => base_url('dashboard/send'),
			"notif" => $this->nf,
			'con' => 'laporan/tagihan',
			'act' => 3,
			'ot' => $tot
		];
		echo view('template/layer', $data);
	}

	public function data_other()
	{

		$id = $this->session->id;
		$where = array('reg_sales' => $id);
		$tab  = array('tb_reg', 'tb_client');
		$sama   = array(
			'aku',
			'tb_reg.reg_client=tb_client.client_id'
		);
		$fetch_data = $this->mdata->join($tab, $sama, $where);


		$data = array();
		$ni = 1;
		foreach ($fetch_data as $row) {
			if (!empty($row->reg_cost)) {
				$sub_array = array();
				$sub_array[] = $ni++;
				$sub_array[] = $row->client_name;
				$sub_array[] = format_rp($row->reg_cost);
				$sub_array[] = $row->reg_date;

				$data[] = $sub_array;
			}
		}
		$output = array(
			"data" => $data
		);

		echo json_encode($output);
	}

	public function data_bil()
	{
		$id = $this->session->id;
		$where = array('reg_sales' => $id);
		$tab  = array('tb_reg', 'tb_client', 'tb_sales', 'tb_service_sales', 'tb_bill');
		$sama   = array(
			'aku',
			'tb_reg.reg_client=tb_client.client_id',
			'tb_reg.reg_sales=tb_sales.sales_id',
			'tb_reg.reg_paket=tb_service_sales.service_id',
			'tb_reg.reg_id=tb_bill.bil_reg'
		);
		$fetch_data = $this->mdata->join($tab, $sama, $where);


		$data = array();
		$ni = 1;
		foreach ($fetch_data as $row) {
			$nom = $row->service_price;
			$no = $row->service_price + $row->bil_uniq;
			$ppn = $nom * $row->reg_ppn / 100;
			$tot = $no + $ppn;

			$sub_array = array();
			$sub_array[] = $ni++;
			$sub_array[] = $row->bil_id;
			$sub_array[] = $row->client_name;
			$sub_array[] = format_rp($row->service_price + $row->bil_uniq);
			$sub_array[] = $row->bil_date;
			$sub_array[] = format_rp($ppn);
			$sub_array[] = format_rp($tot);
			$sub_array[] = paid($row->bil_stat);

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);

		echo json_encode($output);
	}

	public function data_income()
	{
		$id = $this->session->id;
		$where = array('reg_sales' => $id, 'bil_stat' => 1);
		$tab  = array('tb_reg', 'tb_client', 'tb_sales', 'tb_service_sales', 'tb_bill');
		$sama   = array(
			'aku',
			'tb_reg.reg_client=tb_client.client_id',
			'tb_reg.reg_sales=tb_sales.sales_id',
			'tb_reg.reg_paket=tb_service_sales.service_id',
			'tb_reg.reg_id=tb_bill.bil_reg'
		);
		$fetch_data = $this->mdata->join($tab, $sama, $where);


		$data = array();
		$ni = 1;
		foreach ($fetch_data as $row) {
			$nom = $row->service_price;
			$no = $row->service_price + $row->bil_uniq;
			$ppn = $nom * $row->reg_ppn / 100;
			$tot = $no + $ppn;

			$sub_array = array();
			$sub_array[] = $ni++;
			$sub_array[] = $row->client_name;
			$sub_array[] = format_rp($row->service_price + $row->bil_uniq);
			$sub_array[] = $row->bil_date;
			$sub_array[] = format_rp($ppn);
			$sub_array[] = format_rp($tot);

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);

		echo json_encode($output);
	}
	//end laporan

	//setting
	public function setting()
	{
		$seg3 = $this->uri->getSegment(3);
		switch ($seg3) {
			case 'app':
				$this->_app();
				break;
			default:
				return view('404');
				break;
		}
	}

	public function _app()
	{
		$cc = $this->mdata->view('tb_app');

		$data = [
			'title' => 'Aplikasi Data',
			"notif" => $this->nf,
			'con' => 'setting/app',
			'act' => 5,
			'da' => $cc,
		];
		echo view('template/layer', $data);
	}

	public function act_app()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('al', 'Alamat', 'required');
		$this->valid->setRule('hp', 'HP', 'required');
		$this->valid->setRule('des', 'Deskripsi', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('app_id' => $id), 'tb_app');

			if ($cc) {
				$da = array(
					'app_name' => $this->request->getPost('name'),
					'app_addr' => format_num($this->request->getPost('al')),
					'app_hp' => $this->request->getPost('hp'),
					'app_des' => $this->request->getPost('des'),
				);
				$this->mdata->ud(array('app_id' => $id), 'tb_app', $da);
				$this->_notif('update setting aplikasi');
			} else {
				$pas = $this->kunci->lockhash($this->request->getPost('pass'));
				$da = array(
					'app_id' => random_string('numeric', 5),
					'app_name' => $this->request->getPost('name'),
					'app_addr' => format_num($this->request->getPost('al')),
					'app_hp' => $this->request->getPost('hp'),
					'app_des' => $this->request->getPost('des'),
				);
				$this->mdata->safe($da, 'tb_app');
				$this->_notif('tambah setting aplikasi');
			}
			$data['redirect'] = base_url('dashboard/setting/app');

			$this->session->setFlashdata(
				'info',
				"<div class='alert alert-info alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Berhasil</strong> Menyimpan data . </div>"
			);
		}

		echo json_encode($data);
	}
	//end setting


	public function csv()
	{

		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('csv', 'CSV', 'uploaded[csv]|ext_in[csv,csv]');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {
			foreach ($_FILES as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			// $df = ['client_name', 'client_nis', 'client_addr', 'client_hp', 'client_email'];
			$df = ['al_name', 'al_nis', 'al_in', 'al_birth'];
			$length = count($df);
			$data['success'] = true;
			$id = 'al' . random_string('numeric', 4);
			$ff = $this->request->getFile('csv');
			$csf = array_map('str_getcsv', file($ff));
			$key = array_slice($csf, 0, 1);
			$n = count($key[0]);
			$dif = count(array_diff($df, $key[0]));



			if ($n == $length && $dif == 0) {
				$key = array_slice($csf, 0, 1);
				$da = array_slice($csf, 1);
				$name = array_column($da, 0);
				$al = array_column($da, 2);
				$hp = array_column($da, 3);

				if (in_array("", $hp, TRUE)) {
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-danger alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Gagal</strong> value import Nomor hp harus diisi  </div>"
					);
				} else if (in_array("", $al, TRUE)) {
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Gagal</strong> value import Alamat harus diisi  </div>"
					);
				} else if (in_array("", $name, TRUE)) {
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Gagal</strong> value import nama harus diisi  </div>"
					);
				} else {
					// $ci = ['client_id', 'client_sales'];
					$ci = ['al_id'];
					$keyf = array_merge($key[0], $ci);
					$n = count($da);
					for ($i = 0; $i < $n; $i++) {
						// $f[$i] = [5 => $id . $i, 6 => $this->session->id];
						$f[$i] = [5 => $id . $i];
						$dataf = array_replace_recursive($da, $f);
						$c[$i] = array_combine($keyf, $dataf[$i]);
					}

					// $data['da'] = $c;
					// print_r($c);
					$this->mdata->inbatch($c, 'tb_al');
					$this->_notif('import data csv');
					$this->session->setFlashdata(
						'info',
						"<div class='alert alert-success alert-dismissible' role='alert'>
			   <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			   <strong>Berhasil</strong> Import data </div>"
					);
				}
			} else {
				$this->session->setFlashdata(
					'info',
					"<div class='alert alert-danger alert-dismissible' role='alert'>
				   <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				   <strong>Gagal</strong> value import data tidak valid . </div>"
				);
			}


			$data['redirect'] = base_url('dashboard/data/alumni');
		}
		echo json_encode($data);
	}

	public function log()
	{
		$data = [
			'title' => 'Log Data',
			'da' => base_url('dashboard/data-log'),
			'notif' => $this->nf,
			'con' => 'laporan/log',
			'act' => 2
		];
		echo view('template/layer', $data);
	}

	public function data_log()
	{

		$fetch_data = $this->mdata->co(array('notif_user' => $this->session->id), 'tb_notif');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->notif;
			$sub_array[] = trans_date($row->notif_time);
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}











	//--------------------------------------------------------------------

}
