<?php

namespace App\Console\Commands;

use \AM\Gnokii\PhpGnokii;
use \Illuminate\Console\Command;
use \App\Devices;
use \App\Sms;
use \AdService\Container;

class SmsRun extends Command
    {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */

	protected $signature = 'sms:run';

	/**
	 * The console command description.
	 *
	 * @var string
	 */

	protected $description = 'Starting sms sending';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */

	public function __construct()
	    {
		parent::__construct();
	    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */

	public function handle()
	    {
		$this->info("Run sms sender");
		$this->_get();
		$this->_send();
	    }


	/**
	 * Get new sms's
	 *
	 * @return void
	 */

	private function _get()
	    {
		$devices = Devices::all();

		foreach ($devices as $device)
		    {
			$memtypes = ["SM", "ME"];
			$gnokii   = new PhpGnokii(SMSC_NUMBER, "+7", $device->config);
			$sms      = [];
			foreach ($memtypes as $type)
			    {
				$new = $gnokii->getSms($type);
				$sms = array_merge($sms, $new);
			    } //end foreach

			foreach ($sms as $getted)
			    {
				$create = [
				    "sender" => preg_replace("/(\+|\s+)/ui", "", $getted->sender),
				    "phone"  => preg_replace("/\D/ui", "", $device->phone),
				    "text"   => $getted->text,
				    "api"    => "no",
				    "type"   => "inbound",
				];

				Sms::create($create);

				$gnokii->deleteSMS($getted);

			    } //end foreach

		    } //end foreach

	    } //end _get()


	/**
	 * Send new sms's
	 *
	 * @return void
	 */

	private function _send()
	    {
		$devices = Devices::all();

		foreach ($devices as $device)
		    {
			$container = new Container("sms_device_" . $device->id);
			if (count($container) > 0)
			    {
				$gnokii = new PhpGnokii(SMSC_NUMBER, "+7", $device->config);
				foreach ($container as $key => $element)
				    {
					$sms = json_decode($element["data"], true);
					if (preg_match("/^79[0-9]{9}$/ui", $sms["phone"]) > 0)
					    {
						if ($gnokii->send("+" . $sms["phone"], $sms["text"]) === true)
						    {
							$create = [
							"sender" => $sms["sender"],
							"phone"  => $sms["phone"],
							"text"   => $sms["text"],
							"api"    => "yes",
							"type"   => "outbound",
							];

							Sms::create($create);
							$container->remove($key);

							$this->info("SMS is send");
						    } //end if\

					    }
					else
					    {
						$container->remove($key);
					    } //end if

				    } //end foreach

			    } //end if

		    } //end foreach

	    } //end _send()


    } //end class

?>
