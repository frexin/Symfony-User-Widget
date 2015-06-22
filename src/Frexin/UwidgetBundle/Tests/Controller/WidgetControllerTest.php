<?php

namespace Frexin\UwidgetBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WidgetControllerTest extends WebTestCase
{

    public function setUp()
    {
        $client = static::createClient();
        $manager = $client->getContainer()->get('h4cc_alice_fixtures.manager');
        $set = $manager->createFixtureSet();
        $set->addFile(__DIR__ . '/../../Fixtures/test.yml', 'yaml');
        $manager->load($set);
    }

    public function testUserNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/user/000000/width/12345/height/500/bgcolor/C94C08/textcolor/E3CF3B');
        $code = $client->getResponse()->getStatusCode();

        $this->assertEquals(404, $code);
    }

    public function testInvalidParams()
    {
        $client = static::createClient();

        $client->request('GET', '/user/testhash/width/wrong/height/fdsf/bgcolor/C94C08/textcolor/E3CF3B');
        $code = $client->getResponse()->getStatusCode();

        $this->assertEquals(400, $code);
    }

    public function testSuccess()
    {
        $client = static::createClient();

        $client->request('GET', '/user/testhash/width/100/height/100/bgcolor/C94C08/textcolor/E3CF3B');
        $code = $client->getResponse()->getStatusCode();

        $this->assertEquals(200, $code);
    }
}
