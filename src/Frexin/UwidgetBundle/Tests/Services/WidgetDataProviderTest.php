<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 22.06.15
 * Time: 7:08
 */

namespace Frexin\UwidgetBundle\Tests\Services;

use Frexin\UwidgetBundle\FrexinUwidgetBundle;
use Frexin\UwidgetBundle\Services\WidgetDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WidgetDataProviderTest extends KernelTestCase
{

    private $validator;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->validator = static::$kernel->getContainer()->get('validator');
    }

    public function testValidationSuccess()
    {
        $widget = new WidgetDataProvider;
        $widget->setBackgroundColor('000000');
        $widget->setTextColor('000000');
        $widget->setWidth(100);
        $widget->setHeight(100);
        $widget->setUserHash('abc');

        $result = $this->validator->validate($widget);

        $this->assertCount(0, $result);
    }

    public function testValidationFail()
    {
        $widget = new WidgetDataProvider;
        $widget->setBackgroundColor('invalid');
        $widget->setTextColor('000000');
        $widget->setWidth(50);
        $widget->setHeight(1000);

        $result = $this->validator->validate($widget);

        $this->assertNotCount(0, $result);
    }

} 