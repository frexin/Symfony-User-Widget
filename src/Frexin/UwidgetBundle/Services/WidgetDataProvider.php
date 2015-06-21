<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 21.06.15
 * Time: 22:36
 */

namespace Frexin\UwidgetBundle\Services;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

class WidgetDataProvider
{

    protected $width = 100;
    protected $height = 100;
    protected $backgroundColor = 0x000000;
    protected $textColor = 0xffffff;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
    }

    public function setWidth($width)
    {
        print $width;
    }

    /**
     * @param int $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
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
     */
    public function setHeight($height)
    {
        $this->height = $height;
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
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return int
     */
    public function getTextColor()
    {
        return $this->textColor;
    }


} 