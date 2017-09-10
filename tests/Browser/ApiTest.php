<?php

namespace Tests\Browser;

use \Tests\BrowserKitTestCase;
use \Illuminate\Foundation\Testing\TestResponse;
use \App\Order;
use \App\Data;

class ApiTest extends BrowserKitTestCase
    {

	/**
	 * Prepare data for testing
	 *
	 * @return void
	 */

	public function setUp()
	    {
		parent::setUp();
	    } //end setUp()


	/**
	 * Tear down test data
	 *
	 * @return void
	 */

	public function tearDown()
	    {
		parent::tearDown();
	    } //end tearDown()


	/**
	 * Site should add element to queue by api
	 *
	 * @return void
	 */

	public function testSiteShouldAddElementToQueueByApi()
	    {
		$readablename  = "any_name_of_container";
		$containername = md5($readablename);
		$datas         = [];

		for ($i = 1; $i <= 10; $i++)
		    {
			$datas[] = [
			    "data"           => "text - any text here" . $i,
			    "container_name" => $readablename,
			    "hash"           => "hash",
			];
		    } //end for

		foreach ($datas as $data)
		    {
			$response = $this->call(
			    "POST", "/api/queue/add.json", [
				"key"            => "test_api_key",
				"data"           => $data["data"],
				"container_name" => $data["container_name"],
			], [], []);

			$test = new TestResponse($response);

			$expected = [
			    "status"  => "ok",
			    "message" => "Added to queue",
			];

			$test->assertJson($expected);
		    } //end foreach

		$i = 0;
		$order = Order::all();
		foreach ($order as $item)
		    {
			$datas[$i]["hash"] = $item->hash;
			$this->assertEquals($containername, $item->container_name);
			$this->assertEquals($readablename, $item->readable_container_name);
			$this->assertRegExp("/[0-9a-zA-Z]{32}/ui", $item->hash);
			$this->assertRegExp("/[0-9a-zA-Z]{32}/ui", $item->container_name);
			$i++;
		    } //end foreach

		$i = 0;
		$data  = Data::all();
		foreach ($data as $item)
		    {
			$this->assertEquals($datas[$i]["data"], $item->data);
			$this->assertEquals($datas[$i]["hash"], $item->hash);
			$i++;
		    } //end foreach

	    } //end testSiteShouldAddElementToQueueByApi()


	/**
	 * Site should remove element from queue by api
	 *
	 * @return void
	 */

	public function testSiteShouldRemoveElementFromQueueByApi()
	    {
		$readablename  = "any_name_of_container";
		$containername = md5($readablename);
		$datas         = [];

		for ($i = 1; $i <= 10; $i++)
		    {
			$datas[] = [
			    "data"           => "text - any text here" . $i,
			    "container_name" => $readablename,
			    "hash"           => "hash",
			];
		    } //end for

		foreach ($datas as $data)
		    {
			$response = $this->call(
			    "POST", "/api/queue/add.json", [
				"key"            => "test_api_key",
				"data"           => $data["data"],
				"container_name" => $data["container_name"],
			], [], []);

			$test = new TestResponse($response);

			$expected = [
			    "status"  => "ok",
			    "message" => "Added to queue",
			];

			$test->assertJson($expected);
		    } //end foreach

		$i = 0;
		$order = Order::all();
		foreach ($order as $item)
		    {
			$datas[$i]["hash"] = $item->hash;
			$this->assertEquals($containername, $item->container_name);
			$this->assertEquals($readablename, $item->readable_container_name);
			$this->assertRegExp("/[0-9a-zA-Z]{32}/ui", $item->hash);
			$this->assertRegExp("/[0-9a-zA-Z]{32}/ui", $item->container_name);
			$i++;
		    } //end foreach

		$i = 0;
		$data  = Data::all();
		foreach ($data as $item)
		    {
			$this->assertEquals($datas[$i]["data"], $item->data);
			$this->assertEquals($datas[$i]["hash"], $item->hash);
			$i++;
		    } //end foreach

		foreach ($order as $item)
		    {
			$response = $this->call(
			    "POST", "/api/queue/del.json", [
				"key"            => "test_api_key",
				"hash"           => $item->hash,
			], [], []);

			$test = new TestResponse($response);

			$expected = [
			    "status"  => "ok",
			    "message" => "Element '" . $item->hash . "' removed from queue",
			];

			$test->assertJson($expected);
		    } //end foreach

		$order = Order::all();
		$this->assertEquals(0, count($order));
	    } //end testSiteShouldRemoveElementFromQueueByApi()


	/**
	 * Site should allow to get elements order list by container name by API
	 *
	 * @return void
	 */

	public function testSiteShouldAllowToGetElementsOrderListByContainerNameByApi()
	    {
		$readablename  = "any_name_of_container";
		$containername = md5($readablename);
		$datas         = [];

		for ($i = 1; $i <= 10; $i++)
		    {
			$datas[] = [
			    "data"           => "text - any text here" . $i,
			    "container_name" => $readablename,
			    "hash"           => "hash",
			];
		    } //end for

		foreach ($datas as $data)
		    {
			$response = $this->call(
			    "POST", "/api/queue/add.json", [
				"key"            => "test_api_key",
				"data"           => $data["data"],
				"container_name" => $data["container_name"],
			], [], []);

			$test = new TestResponse($response);

			$expected = [
			    "status"  => "ok",
			    "message" => "Added to queue",
			];

			$test->assertJson($expected);
		    } //end foreach

		$expected = [];
		$order    = Order::all();
		foreach ($order as $item)
		    {
			$expected[] = [
			    "hash"                    => $item->hash,
			    "container_name"          => $item->container_name,
			    "readable_container_name" => $item->readable_container_name,
			];
		    } //end foreach

		$response = $this->call(
		    "POST", "/api/queue/order/get.json", [
			"key"            => "test_api_key",
			"container_name" => $readablename,
		], [], []);

		$test = new TestResponse($response);

		$test->assertJson($expected);
	    } //end testSiteShouldAllowToGetElementsOrderListByContainerNameByApi()


    } //end class

?>
