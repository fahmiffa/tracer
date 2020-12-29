<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\Mdata;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'text', 'security', 'libdata', 'global', 'date', 'number'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:		
		$this->session = \Config\Services::session();
		$this->valid =  \Config\Services::validation();
		$this->encrypter = \Config\Services::encrypter();
	}

	public function _log_dash()
	{
		$this->mdata = new Mdata;
		$session = session();
		$nama = $session->nama;
		$id = $session->id;
		$user = ['account_id' => $id, 'account_name' => $nama, 'account_role' => 'admin'];
		$sales = $this->mdata->cc($user, 'tb_account');

		$this->ser = $this->mdata->view('tb_app');
		$where = ['notif_user' => $id];
		$this->nf = $this->mdata->cr($where, 'tb_notif');

		if (!$sales) {
			$session->destroy();
			return redirect('/');
		}
	}

	public function _log_front()
	{
		$this->mdata = new Mdata;
		$session = session();
		$nama = $session->nama;
		$id = $session->id;
		$user = ['account_id' => $id, 'account_name' => $nama, 'account_role' => 'alumni'];
		$this->ac = $this->mdata->cc($user, 'tb_account');
		$this->app = $this->mdata->view('tb_app');
	}


	public function _wa($no, $isi, $data)
	{
		$n = '62' . ltrim($no, '0');

		$tem = $this->mdata->view('tb_wa');
		$tmp = $tem[0]->wa;

		if ($isi == 'tagih') {
			$tem = $this->mdata->view('tb_wa');
			$tmp = $tem[0]->wa;
			// tagih
			$tag = ['{pelanggan}', '{billing}', '{jumlah}', '{tempo}', '{bca}', '{bri}', '{reseller}', '{hp}'];
			// $tg = ['pelanggan','billing','jumlah','tempo','bca','bri','reseller','hp'];	
			$tg = $data;

			$is = str_replace($tag, $tg, $tmp);
			$cn = urlencode($is);
		} else if ($isi == 'warning') {
			$tem = $this->mdata->view('tb_wa');
			$tmp = $tem[2]->wa;
			// warnning
			$tag = ['{pelanggan}', '{billing}', '{jumlah}', '{bca}', '{bri}', '{reseller}', '{hp}'];
			$tg = ['pelanggan', 'billing', 'jumlah', 'bca', 'bri', 'reseller', 'hp'];
			// $tg = $data;	
			$is = str_replace($tag, $tg, $tmp);
			$cn = urlencode($is);
		} else if ($isi == 'akun') {
			$tem = $this->mdata->view('tb_wa');
			$tmp = $tem[1]->wa;
			// akun sales
			$tag = ['{user}', '{pass}', '{uri}'];
			// $tg = ['user','pass','uri'];	
			$tg = $data;

			$is = str_replace($tag, $tg, $tmp);
			$cn = urlencode($is);
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://app.whatspie.com/api/messages",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "receiver=$n&device=085713079580&message=$cn&type=chat",
			CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/x-www-form-urlencoded",
				"Authorization: Bearer 7GY9n3mFxUKm7wzCllyy7G9RyubQygWpITo0dO4IfaC2zxlOEp"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		// echo $response;

	}

	public function _notif($da)
	{
		$session = session();
		$id = (!empty($session->id)) ? $this->session->id : '1001';
		$data = [
			'notif_id' => random_string('numeric', 5),
			'notif_user' => $id,
			'notif' => $da,
			'notif_time' => date("Y-m-d H:s:i"),
			'notif_stat' => 1
		];
		$this->mdata->safe($data, 'tb_notif');
	}

	public function _email($em, $nis, $pas)
	{
		$email = \Config\Services::email();

		$config['protocol'] = 'smtp';
		$config['SMTPHost'] = 'mail.fahmiffa.com';
		$config['SMTPUser'] = 'email@fahmiffa.com';
		$config['SMTPPass'] = 'jalansaja11';
		$config['SMTPPort'] = '587';
		$config['mailType'] = 'html';
		$config['SMTPCrypto'] = 'tls';
		$config['CRLF'] = '\r\n';
		$config['newline'] = '\r\n';
		$config['charset']  = 'utf-8';
		$config['wordWrap'] = true;
		$email->initialize($config);

		$msg = '<b>Selamat Akun anda sudah aktif</b>, sebagai berikut :<br>
				Username : ' . $nis . '<br>						
				Password : ' . $pas . '<br>
				Untuk Keamanan Silahkan di harapkan mengganti password anda setelah login di Dashboard Alumni			
				';

		$email->setFrom('ffa@fahmiffa.com', 'ffa');
		$email->setTo($em);
		$email->setSubject('Account Info');
		$email->setMessage($msg);
		$email->send();
	}

	function _upimg($file)
	{
		$path = 'public/asset/img/';
		$fname = $file->getRandomName();
		$file->move(ROOTPATH . $path, $fname);

		$pile = 'asset/img/' . $fname;

		$info = \Config\Services::image();
		$info->withFile($pile)->getFile()->getProperties(true);
		$info->withFile($pile)->fit(200, 300, 'center')->save('asset/loker/' . $fname);

		$thum = 'asset/loker/' . $fname;
		unlink($pile);
		return $thum;
	}

	function _upcover($file)
	{
		$path = 'public/asset/img/';
		$fname = $file->getRandomName();
		$file->move(ROOTPATH . $path, $fname);

		$pile = 'asset/img/' . $fname;

		$info = \Config\Services::image();
		$info->withFile($pile)->getFile()->getProperties(true);
		$info->withFile($pile)->fit(960, 600, 'center')->save('asset/cover/' . $fname);

		$thum = 'asset/cover/' . $fname;
		unlink($pile);
		return $thum;
	}

	function _porto($file)
	{
		$path = 'public/asset/img/';
		$fname = $file->getRandomName();
		$file->move(ROOTPATH . $path, $fname);

		$pile = 'asset/img/' . $fname;

		$info = \Config\Services::image();
		$info->withFile($pile)->getFile()->getProperties(true);
		$info->withFile($pile)->fit(960, 600, 'center')->save('asset/porto/' . $fname);

		$thum = 'asset/porto/' . $fname;
		unlink($pile);
		return $thum;
	}
}
