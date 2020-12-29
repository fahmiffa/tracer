<?php namespace Config;

use App\Models\Mdata;
use CodeIgniter\I18n\Time;
use CodeIgniter\Config\BaseConfig;

class Pariable extends BaseConfig
{

	public function par()
	{
		$ye = date("Y"); $bl = date("m"); $h = date("H"); $mt = 15;		

		$mdata = new Mdata();
		$wa = $mdata->cv(array('wa_name'=>"Tagihan"),'tb_wa');
		$wan = $mdata->cv(array('wa_name'=>"warning"),'tb_wa');
		$da = $mdata->view('api_tb');
		$ba = $mdata->view('tb_bank');
		$tm = $wa[0]->temp;
		$wn = $wan[0]->temp;

		$dat = new Time();
		$dat->setDate($ye, $bl, $tm);
		$dat->format('Y-m-d');
		$dat = new Time($dat);
		$dat->setTime($h,$mt,10);
		$temp = $dat->format('Y-m-d H:i:s'); // jatuh tempo

		// set warning
		$wan = new Time();
		$wan->setDate($ye, $bl, $wn);
		$wan->format('Y-m-d');
		$wan = new Time($wan);
		$wan->setTime($h,$mt,10);
		$warning = $wan->format('Y-m-d H:i:s');	// warning 

		return  ['api'=>$da[0]->api, 
			     'bank'=>$ba[0]->bank_rek, 
				 'tempo'=>$temp,
				 'warning'=>$warning,
				 'tang'=>$tm
	   			];
				 
	}


}
