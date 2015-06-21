<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 21.06.15
 * Time: 22:36
 */

namespace Frexin\UwidgetBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Tests\Extension\Validator\EventListener\ValidationListenerTest;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator;

class WidgetDataProvider
{
    protected $width = 100;
    protected $height = 100;
    protected $backgroundColor = 0x000000;
    protected $textColor = 0xffffff;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('width', new Range(['min' => 100, 'max' => 500]));
        $metadata->addPropertyConstraint('height', new Range(['min' => 100, 'max' => 500]));
        $metadata->addPropertyConstraint('backgroundColor', new Regex(['pattern' => '/^[0-9A-F]{6}$/i']));
        $metadata->addPropertyConstraint('textColor', new Regex(['pattern' => '/^[0-9A-F]{6}$/i']));
    }

    /**
     * @param int $width
     * @return WidgetDataProvider
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param int $backgroundColor
     * @return WidgetDataProvider
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * @return int
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param int $height
     * @return WidgetDataProvider
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $textColor
     * @return WidgetDataProvider
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * @return int
     */
    public function getTextColor()
    {
        return $this->textColor;
    }
}