<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 22.06.15
 * Time: 7:53
 */

namespace Frexin\UwidgetBundle\Tests\Services;

use Frexin\UwidgetBundle\FrexinUwidgetBundle;
use Frexin\UwidgetBundle\Services\WidgetDataProvider;
use Frexin\UwidgetBundle\Services\WidgetGenerator;
use Imagine\Gd\Imagine;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Config\FileLocator;

class WidgetGeneratorTest extends KernelTestCase
{

    private $fileLocator;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->fileLocator = new FileLocator(self::$kernel);
    }

    public function testWidgetCreation()
    {
        $dp = new WidgetDataProvider;
        $dp->setBackgroundColor('000000');
        $dp->setTextColor('000000');
        $dp->setWidth(100);
        $dp->setHeight(100);
        $dp->setUserHash('abc');

        $widgetGenerator = new WidgetGenerator($this->fileLocator);
        $widgetGenerator->setDataProvider($dp);
        $widgetGenerator->imagine = new Imagine();

        $result = $widgetGenerator->create();
        $filename = $widgetGenerator->getWidgetPath();

        $this->assertTrue($result);
        $this->assertInternalType('string', $filename);
    }
}
 