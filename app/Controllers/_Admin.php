<?php

namespace App\Controllers;

use App\Models\Mdata;
use App\Libraries\Kunci;
use App\Libraries\RouterosApi;

class Admin extends BaseController
{
	public function __construct()
	{
		$this->_log_admin();
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
		$csales = $this->mdata->cc(array('sales_id' => $da), 'tb_sales');
		$cservice = $this->mdata->cc(array('services_id' => $da), 'tb_services');
		$wa = $this->mdata->cc(array('wa_id' => $da), 'tb_wa');
		$ba = $this->mdata->cc(array('bank_id' => $da), 'tb_bank');
		$api = $this->mdata->cc(array('id_api' => $da), 'api_tb');
		if ($csales) {
			$reg = $this->mdata->cc(array('reg_sales' => $da), 'tb_reg');
			if ($reg) {
				$this->mdata->dc(array('bil_reg' => $reg[0]->reg_id), 'tb_bill');
			}
			$this->mdata->dc(array('sales_id' => $da), 'tb_sales');
			$this->mdata->dc(array('service_sales' => $da), 'tb_service_sales');
			$this->mdata->dc(array('prof_id' => $da), 'tb_prof');
			$this->mdata->dc(array('account_id' => $da), 'tb_account');
			$this->mdata->dc(array('client_sales' => $da), 'tb_client');
			$this->mdata->dc(array('reg_sales' => $da), 'tb_reg');

			$this->_notif('delete sales');
		} else if ($cservice) {
			$service = $this->mdata->dc(array('services_id' => $da), 'tb_services');

			$this->_notif('delete layanan paket');
		} else if ($wa) {
			$this->mdata->dc(array('wa_id' => $da), 'tb_wa');

			$this->_notif('delete notif wa');
		} else if ($ba) {
			$this->mdata->dc(array('bank_id' => $da), 'tb_bank');
			$this->_notif('delete bank');
		} else if ($api) {
			$this->mdata->dc(array('id_api' => $da), 'api_tb');
			$this->_notif('delete api');
		} else {
			echo view('404');
		}
	}



	// data
	public function data()
	{
		$seg3 = $this->uri->getSegment(3);
		switch ($seg3) {
			case 'sales':
				$this->_sales();
				break;
			case 'client':
				$this->_client();
				break;
			case 'paket';
				$this->_paket();
				break;
			case 'mikrotik':
				$this->_mikro();
				break;
			default:
				return view('404');
				break;
		}
	}

	public function _mikro()
	{
		$miko = $this->mdata->view('tb_api');
		$API = new RouterosAPI();
		if ($API->connect($miko[0]->api_uri, $miko[0]->api_name, $miko[0]->api_pass)) {
			$API->write('/ip/hotspot/user/print');
			$read = $API->read();
			$API->disconnect();
		}
		$r = (!empty($read)) ? $read : 0;
		$data = [
			'title' => 'Mikrotik Data',
			'notif' => $this->nf,
			'con' => 'user/mikrotik',
			'uri' => base_url('admin/up-mikotik'),
			'data' => $r,
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function up_mikotik()
	{
		$miko = $this->mdata->view('tb_api');
		$username = $this->request->getPost('Id');
		$API = new RouterosAPI();
		if ($API->connect($miko[0]->api_uri, $miko[0]->api_name, $miko[0]->api_pass)) {
			$API->write('/ip/hotspot/user/print');
			$active = $API->read();
			foreach ($active as $row)
				if ($row['name'] == $username) $id_active = $row['.id'];
			$API->write('/ip/hotspot/user/disable', false);
			$API->write('=.id=' . $id_active);
			$READ = $API->read();
			$API->disconnect();
		}

		$this->_notif('disable user mikrotik');
	}

	public function _sales()
	{
		$data = [
			'title' => 'Sales Data',
			'da' => base_url('admin/data-sales'),
			'notif' => $this->nf,
			'con' => 'user/sales',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_sales()
	{

		$fetch_data = $this->mdata->view('tb_sales');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->sales_id;
			$sub_array[] = $row->sales_name;
			$sub_array[] = $row->sales_email;
			$sub_array[] = $row->sales_hp;
			$sub_array[] = status($row->sales_stat, $row->sales_id);
			$sub_array[] = '<button type="button" name="delete" uri="' . base_url('admin/dcommon') . '" id="' . $row->sales_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;								
								<a href="' . base_url('admin/edit-sales/' . $row->sales_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_sales()
	{
		$pc = $this->mdata->view('tb_services');
		$data = [
			'title' => 'Tambah Sales',
			'notif' => $this->nf,
			'con' => 'add/sales',
			'ad' => $pc,
			'act' => 0
		];
		echo view('template/layer', $data);
	}

	public function edit_sales()
	{
		$ac = $this->uri->getSegment(3);
		$wh = ['sales_id' => $ac];
		$tab = ['tb_sales', 'tb_prof'];
		$sama = ['aku', 'tb_sales.sales_id=tb_prof.prof_id'];
		$cc = $this->mdata->join($tab, $sama, $wh);
		$pc = $this->mdata->view('tb_services');
		if ($cc) {
			$data = [
				'title' => 'Edit Sales',
				'notif' => $this->nf,
				'con' => 'add/sales',
				'act' => 0,
				'da' => $cc,
				'ad' => $pc,
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_sales()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('email', 'Email', 'required|valid_email|is_unique[tb_sales.sales_email,sales_id,{id}]');
		$this->valid->setRule('pass', 'Password', 'required|max_length[8]');
		$this->valid->setRule('hp', 'HP', 'required');
		$this->valid->setRule('ser', 'Layanan', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('sales_id' => $id), 'tb_sales');
			$hp = trim($this->request->getPost('hp'));
			$pa = trim($this->request->getPost('pass'));
			$a = trim($this->request->getPost('name'));

			if ($cc) {
				$pas = $this->kunci->lockhash(trim($this->request->getPost('pass')));
				$da = array(
					'sales_email' => trim($this->request->getPost('email')),
					'sales_name' => trim($this->request->getPost('name')),
					'sales_hp' => trim($this->request->getPost('hp')),
				);
				$this->mdata->ud(array('sales_id' => $id), 'tb_sales', $da);

				$ad = array(
					'account_name' => trim($this->request->getPost('name')),
					'account_pass' => $pas
				);
				$this->mdata->ud(array('account_id' => $id), 'tb_account', $ad);


				$sa = array(
					'prof_paket' => $this->request->getPost('ser')
				);
				$this->mdata->ud(array('prof_id' => $id), 'tb_prof', $sa);
				$this->_notif('update data sales');
			} else {
				$di = 'S' . random_string('numeric', 5);
				$pas = $this->kunci->lockhash(trim($this->request->getPost('pass')));
				$da = array(
					'sales_id' => $di,
					'sales_email' => trim($this->request->getPost('email')),
					'sales_name' => trim($this->request->getPost('name')),
					'sales_hp' => trim($this->request->getPost('hp')),
					'sales_stat' => '11'
				);
				$this->mdata->safe($da, 'tb_sales');

				$ad = array(
					'account_id' => $di,
					'account_name' => trim($this->request->getPost('name')),
					'account_pass' => $pas,
					'account_role' => 'sales'
				);
				$this->mdata->safe($ad, 'tb_account');

				$sa = array(
					'prof_id' => $di,
					'prof_bank' => '',
					'prof_bank_name' => '',
					'prof_temp' => '',
					'prof_paket' => $this->request->getPost('ser')
				);
				$this->mdata->safe($sa, 'tb_prof');

				$this->_notif('tambah data sales');

				$uri = base_url();
				$nam = trim($this->request->getPost('name'));
				$ps = trim($this->request->getPost('pass'));

				$tg = [$nam, $ps, $uri];
				$this->_wa($hp, 'akun', $tg);
			}
			$data['redirect'] = base_url('admin/data/sales');
		}

		echo json_encode($data);
	}

	public function _client()
	{
		$data = [
			'title' => 'Client Data',
			'da' => base_url('admin/data-client'),
			'notif' => $this->nf,
			'con' => 'user/client',
			'act' => 1
		];
		echo view('template/layer', $data);
	}

	public function data_client()
	{

		$tab  = array('tb_client', 'tb_sales');
		$sama   = array('aku', 'tb_client.client_sales=tb_sales.sales_id');
		$fetch_data = $this->mdata->join($tab, $sama, 0);

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->client_name;
			$sub_array[] = $row->sales_name;
			$sub_array[] = $row->client_nik;
			$sub_array[] = $row->client_email . '<br>' . $row->client_hp;
			$sub_array[] = $row->client_addr;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function _paket()
	{
		$data = [
			'title' => 'Paket Data',
			'da' => base_url('admin/data-paket'),
			'notif' => $this->nf,
			'con' => 'layanan/paket',
			'act' => 2
		];
		echo view('template/layer', $data);
	}

	public function data_paket()
	{

		$fetch_data = $this->mdata->cv(0, 'tb_services');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->services_name;
			$sub_array[] = format_rp($row->services_price);
			$sub_array[] = $row->services_speed;
			$sub_array[] = $row->services_time;
			$sub_array[] = '<button type="button" uri="' . base_url('admin/dcommon') . '" name="delete" id="' . $row->services_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;
								<a href="' . base_url('admin/edit-paket/' . $row->services_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_paket()
	{
		$data = [
			'title' => 'Tambah Paket',
			'con' => 'add/paket',
			'notif' => $this->nf,
			'act' => 0,
			'load' => 'onload="nomor()"'
		];
		echo view('template/layer', $data);
	}

	public function edit_paket()
	{
		$ac = $this->uri->getSegment(3);
		$cc = $this->mdata->cc(array('services_id' => $ac), 'tb_services');
		if ($cc) {
			$data = [
				'title' => 'Edit Paket',
				'con' => 'add/paket',
				'notif' => $this->nf,
				'act' => 0,
				'da' => $cc,
				'load' => 'onload="nomor()"'
			];
			echo view('template/layer', $data);
		} else {
			return view('404');
		}
	}

	public function act_paket()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('price', 'Harga', 'required');
		$this->valid->setRule('speed', 'Speed', 'required');
		$this->valid->setRule('time', 'Time', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('services_id' => $id), 'tb_services');

			if ($cc) {
				$da = array(
					'services_name' => trim($this->request->getPost('name')),
					'services_price' => format_num($this->request->getPost('price')),
					'services_time' => trim($this->request->getPost('time')),
					'services_speed' => trim($this->request->getPost('speed'))
				);
				$this->mdata->ud(array('services_id' => $id), 'tb_services', $da);

				$this->_notif('update layanan paket');
			} else {
				$pas = $this->kunci->lockhash($this->request->getPost('pass'));
				$da = array(
					'services_id' => random_string('numeric', 4),
					'services_name' => trim($this->request->getPost('name')),
					'services_price' => format_num($this->request->getPost('price')),
					'services_time' => trim($this->request->getPost('time')),
					'services_speed' => trim($this->request->getPost('speed'))
				);
				$this->mdata->safe($da, 'tb_services');
				$this->_notif('tambah layanan paket');
			}
			$data['redirect'] = base_url('admin/data/paket');
		}

		echo json_encode($data);
	}

	//end data


	//laporan
	public function laporan()
	{
		$seg3 = $this->uri->getSegment(3);
		switch ($seg3) {
			case 'income':
				$this->_income();
				break;
			default:
				return view('404');
				break;
		}
	}



	public function _income()
	{

		$data = [
			'title' => 'Income Data Paid',
			'da' => base_url('admin/data-inc'),
			'notif' => $this->nf,
			'con' => 'laporan/inc',
			'act' => 3,
		];
		echo view('template/layer', $data);
	}


	public function data_inc()
	{

		$where = array('bil_stat' => 1);
		$tab  = array('tb_reg', 'tb_sales', 'tb_service_sales', 'tb_bill', 'tb_prof', 'tb_services');
		$sama   = array(
			'aku', 'tb_sales.sales_id=tb_reg.reg_sales',
			'tb_reg.reg_paket=tb_service_sales.service_id',
			'tb_reg.reg_id=tb_bill.bil_reg',
			'tb_sales.sales_id=tb_prof.prof_id',
			'tb_prof.prof_paket=tb_services.services_id'
		);
		$sum = ['service_price', 'bil_uniq', 'reg_ppn'];
		$fetch_data = $this->mdata->join_sum($tab, $sama, $where, $sum);

		$data = array();
		$ni = 1;
		$f = 0;
		foreach ($fetch_data as $row) {
			$n = $row->service_price;
			$ppn = $n * $row->reg_ppn / 100;
			$nom = $row->service_price + $row->bil_uniq + $ppn;
			$bhp = $n * 11.75 / 100;

			$sub_array = array();
			$sub_array[] = $ni++;
			$sub_array[] = $row->sales_name;
			$sub_array[] = format_rp($nom);
			$sub_array[] = format_rp($bhp);
			$sub_array[] = format_rp($row->services_price);
			$sub_array[] = format_rp(($nom - $row->services_price) - $bhp);



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
		$seg4 = $this->uri->getSegment(4);
		switch ($seg3) {
			case 'mikrotik':
				$this->_mikrotik();
				break;
			case 'aplikasi':
				$this->_aplikasi();
				break;
			case 'notif':
				$this->_notifi();
				break;
				break;
			case 'enotif':
				$this->_enotif($seg4);
				break;
			case 'bank':
				$this->_bank();
				break;
			case 'ebank':
				$this->_ebank($seg4);
				break;
			case 'api':
				$this->_api();
				break;
			case 'eapi':
				$this->_eapi($seg4);
				break;
			default:
				return view('404');
				break;
		}
	}


	public function _ebank($g)
	{
		$ni = $this->mdata->cv(array('bank_id' => $g), 'tb_bank');
		$data = [
			'title' => 'Tambah Data Bank',
			"wa" => $ni,
			"notif" => $this->nf,
			'con' => 'setting/ebank',
			'act' => 5
		];
		echo view('template/layer', $data);
	}
	public function _bank()
	{
		$n = $this->mdata->view('tb_wa');
		$data = [
			'title' => 'Data Bank',
			'da' => base_url('admin/data-bank'),
			"wa" => $n,
			"notif" => $this->nf,
			'con' => 'setting/bank',
			'act' => 4
		];
		echo view('template/layer', $data);
	}
	public function data_bank()
	{
		$fetch_data = $this->mdata->view('tb_bank');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->bank_name;
			$sub_array[] = $row->bank_rek;
			$sub_array[] = '<button type="button" uri="' . base_url('admin/dcommon') . '"  name="delete" id="' . $row->bank_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
								<a href="' . base_url('/admin/setting/ebank/' . $row->bank_id) . '"  class="btn btn-primary btn-xs ekat"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function act_bank()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('bank', 'Bank', 'required');
		$this->valid->setRule('rek', 'Rekening', 'required|numeric');


		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('bank_id' => $id), 'tb_bank');
			if (!$cc) {
				$da = [
					'bank_id' => "B" . random_string('numeric', 3),
					'bank_name' => trim($this->request->getPost('bank')),
					'bank_rek' => trim($this->request->getPost('rek')),
				];
				$this->mdata->safe($da, 'tb_bank');
				$this->_notif('insert bank');
			} else {

				$da = [
					'bank_name' => trim($this->request->getPost('bank')),
					'bank_rek' => trim($this->request->getPost('rek')),
				];

				$this->mdata->ud(array('bank_id' => $id), 'tb_bank', $da);
				$this->_notif('update bank');
			}
			$data['redirect'] = base_url('admin/setting/bank');
		}

		echo json_encode($data);
	}

	public function _eapi($g)
	{
		$ni = $this->mdata->cv(array('id_api' => $g), 'api_tb');
		$data = [
			'title' => 'Tambah Data API',
			"wa" => $ni,
			"notif" => $this->nf,
			'con' => 'setting/eapi',
			'act' => 5
		];
		echo view('template/layer', $data);
	}
	public function _api()
	{
		$n = $this->mdata->view('tb_wa');
		$data = [
			'title' => 'Data API',
			'da' => base_url('admin/data-api'),
			"wa" => $n,
			"notif" => $this->nf,
			'con' => 'setting/api',
			'act' => 4
		];
		echo view('template/layer', $data);
	}
	public function data_api()
	{
		$fetch_data = $this->mdata->view('api_tb');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->name_api;
			$sub_array[] = $row->api;
			$sub_array[] = '<button type="button" uri="' . base_url('admin/dcommon') . '"  name="delete" id="' . $row->id_api . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
								<a href="' . base_url('/admin/setting/eapi/' . $row->id_api) . '"  class="btn btn-primary btn-xs ekat"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function act_api()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('token', 'Token', 'required');


		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('id_api' => $id), 'api_tb');
			if (!$cc) {
				$da = [
					'id_api' => "P" . random_string('numeric', 3),
					'name_api' => trim($this->request->getPost('name')),
					'api' => trim($this->request->getPost('token')),
				];
				$this->mdata->safe($da, 'api_tb');
				$this->_notif('insert api');
			} else {

				$da = [
					'api' => trim($this->request->getPost('token')),
				];

				$this->mdata->ud(array('id_api' => $id), 'api_tb', $da);
				$this->_notif('update api');
			}
			$data['redirect'] = base_url('admin/setting/api');
		}

		echo json_encode($data);
	}






	public function _enotif($g)
	{
		$ni = $this->mdata->cv(array('wa_id' => $g), 'tb_wa');
		$data = [
			'title' => 'Data Notifikasi Whatsapp',
			"wa" => $ni,
			"notif" => $this->nf,
			'con' => 'setting/ewa',
			'act' => 5
		];
		echo view('template/layer', $data);
	}
	public function _notifi()
	{
		$n = $this->mdata->view('tb_wa');
		$data = [
			'title' => 'Data Notifikasi Whatsapp',
			'da' => base_url('admin/data-notif'),
			"wa" => $n,
			"notif" => $this->nf,
			'con' => 'setting/wa',
			'act' => 4
		];
		echo view('template/layer', $data);
	}
	public function data_notif()
	{
		$fetch_data = $this->mdata->view('tb_wa');

		$data = array();
		$no = 1;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $no++;
			$sub_array[] = $row->wa_name;
			$sub_array[] = $row->wa;
			$sub_array[] = $row->temp;
			$sub_array[] = '<button type="button" uri="' . base_url('admin/dcommon') . '"  name="delete" id="' . $row->wa_id . '" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
								<a href="' . base_url('/admin/setting/enotif/' . $row->wa_id) . '"  class="btn btn-primary btn-xs ekat"><i class="fa fa-edit"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function act_notif()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('msg', 'Pesan', 'required');
		$this->valid->setRule('wa', 'Nama', 'required');


		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('wa_id' => $id), 'tb_wa');
			if (!$cc) {
				$da = [
					'wa_id' => "W" . random_string('numeric', 6),
					'wa' => $this->request->getPost('msg'),
					'wa_name' => $this->request->getPost('wa'),
					"temp" => $this->request->getPost("temp")
				];
				$this->mdata->safe($da, 'tb_wa');
				$this->_notif('insert notif');
			} else {
				$da = [
					'wa' => $this->request->getPost('msg'),
					'wa_name' => $this->request->getPost('wa'),
					"temp" => $this->request->getPost("temp")
				];
				$this->mdata->ud(array('wa_id' => $id), 'tb_wa', $da);
				$this->_notif('update notif');
			}
			$data['redirect'] = base_url('admin/setting/notif');
		}

		echo json_encode($data);
	}

	public function _mikrotik()
	{
		$cc = $this->mdata->view('tb_api');
		$data = [
			'title' => 'Mikrotik Setting',
			'notif' => $this->nf,
			'con' => 'setting/mikro',
			'act' => 4,
			'da' => $cc,
		];
		echo view('template/layer', $data);
	}

	public function _aplikasi()
	{
		$cc = $this->mdata->view('tb_app');
		$data = [
			'title' => 'Aplikasi Data',
			'notif' => $this->nf,
			'con' => 'setting/app',
			'act' => 4,
			'da' => $cc,
		];
		echo view('template/layer', $data);
	}

	public function act_mikro()
	{
		$data = array('success' => false, 'messages' => array());
		$this->valid->setRule('name', 'Nama', 'required');
		$this->valid->setRule('ip', 'IP', 'required');
		$this->valid->setRule('pass', 'Password', 'required');

		$val = $this->valid->withRequest($this->request);
		if ($val->run() == FALSE) {

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = $this->valid->showError($key, 'errtemp');
			}
		} else {
			$data['success'] = true;
			$id = $this->request->getPost('id');
			$cc = $this->mdata->cc(array('api_id' => $id), 'tb_api');

			if ($cc) {
				$da = array(
					'api_name' => trim($this->request->getPost('name')),
					'api_uri' => trim($this->request->getPost('ip')),
					'api_pass' => trim($this->request->getPost('pass'))
				);
				$this->mdata->ud(array('api_id' => $id), 'tb_api', $da);

				$this->_notif('update konfigurasi mikrotik');
			} else {
				$da = array(
					'api_id' => 'M' . random_string('numeric', 3),
					'api_name' => trim($this->request->getPost('name')),
					'api_uri' => trim($this->request->getPost('ip')),
					'api_pass' => trim($this->request->getPost('pass'))
				);
				$this->mdata->safe($da, 'tb_api');
				$this->_notif('tambah konfigurasi mikrotik');
			}

			$data['redirect'] = base_url('admin/setting/mikrotik');

			$this->session->setFlashdata(
				'info',
				"<div class='alert alert-info alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Berhasil</strong> Menyimpan data . </div>"
			);
		}

		echo json_encode($data);
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
				$data['redirect'] = base_url('admin/setting/aplikasi');
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
				$data['redirect'] = base_url('admin/setting/aplikasi');
			}

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


	public function log()
	{
		$data = [
			'title' => 'log Data',
			'da' => base_url('admin/data-log'),
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
}
