<?php

namespace App\Http\Controllers;

use \App\Order;
use \App\Data;
use \Illuminate\Http\Request;
use \DB;

class ApiController extends Controller
    {

	/**
	 * Add data to queue
	 *
	 * @param Request $request Request data
	 *
	 * @return json response
	 */

	public function add(Request $request)
	    {
		$secretKey = env("API_KEY", false);
		if ($secretKey === $request->get("key"))
		    {
			$data          = $request->get("data");
			$containername = $request->get("container_name");

			$hash = md5(uniqid() . $containername);
			DB::beginTransaction();
			    $sdata       = new Data;
			    $sdata->data = $data;
			    $sdata->hash = $hash;
			    $sdata->save();

			    $order                          = new Order;
			    $order->hash                    = $hash;
			    $order->container_name          = md5($containername);
			    $order->readable_container_name = $containername;
			    $order->save();
			DB::commit();

			$response = [
			    "status"  => "ok",
			    "message" => "Added to queue",
			];

			return response()->json($response);
		    }
		else
		    {
			return response()->json(["status" => "fail", "message" => "Invalid request"]);
		    } //end if

	    } //end add()


	/**
	 * Remove data to queue
	 *
	 * @param Request $request Request data
	 *
	 * @return json response
	 */

	public function del(Request $request)
	    {
		$secretKey = env("API_KEY", false);
		if ($secretKey === $request->get("key"))
		    {
			$hash = $request->get("hash");
			DB::beginTransaction();
			    Data::where("hash", $hash)->delete();
			    Order::where("hash", $hash)->delete();
			DB::commit();

			$response = [
			    "status"  => "ok",
			    "message" => "Element '" . $hash . "' removed from queue",
			];

			return response()->json($response);
		    }
		else
		    {
			return response()->json(["status" => "fail", "message" => "Invalid request"]);
		    } //end if

	    } //end del()


	/**
	 * Get queue order
	 *
	 * @param Request $request Request data
	 *
	 * @return json response
	 */

	public function getOrder(Request $request)
	    {
		$secretKey = env("API_KEY", false);
		if ($secretKey === $request->get("key"))
		    {
			$order          = [];
			$containername  = md5($request->get("container_name"));

			$order = Order::where("container_name", $containername)->get(["container_name", "hash", "readable_container_name"]);

			if (count($order) > 0)
			    {
				foreach ($order as $item)
				    {
					$order[] = [
					    "hash"                    => $item->hash,
					    "container_name"          => $item->container_name,
					    "readable_container_name" => $item->readable_container_name,
					];
				    } //end foreach

			    } //end if

			return response()->json($order);
		    }
		else
		    {
			return response()->json(["status" => "fail", "message" => "Invalid request"]);
		    } //end if

	    } //end getOrder()


    } //end class

?>

