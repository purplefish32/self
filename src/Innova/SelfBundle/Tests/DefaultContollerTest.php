<?php

namespace Innova\selfBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultContollerTest extends WebTestCase
{
	public function testIndex()
	{
		$client = static::createClient();

		$client->request('GET', '/');

		$this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

		$client->request('GET', '/qsdkjsghqdjh');

		$this->assertEquals(
		    404,
		    $client->getResponse()->getStatusCode()
		);

		$client->request('GET', '/login');

		$this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

		$client->request('GET', '/register/');

		$this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);
	}
}
