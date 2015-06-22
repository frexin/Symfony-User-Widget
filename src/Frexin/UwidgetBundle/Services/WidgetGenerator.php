<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 21.06.15
 * Time: 22:34
 */

namespace Frexin\UwidgetBundle\Services;

use Imagine\Gd\Font;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Color;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point\Center;
use Symfony\Component\HttpKernel\Config\FileLocator;

class WidgetGenerator
{

    /**
     * @var FileLocator
     */
    private $fileLocator;

    /**
     * @var Imagine
     */
    public $imagine;

    /**
     * @var WidgetDataProvider
     */
    protected $dp;

    /**
     * @var ImageInterface
     */
    protected $imageResource;

    /**
     * @var Box
     */
    protected $imageBox;

    protected $savePath;
    protected $filename;

    public function __construct(FileLocator $fileLocator)
    {
        $this->fileLocator = $fileLocator;
        $this->savePath = $fileLocator->locate('@FrexinUwidgetBundle/Resources/public/images/widgets');
    }

    public function setDataProvider(WidgetDataProvider $widgetDataProvider)
    {
        $this->dp = $widgetDataProvider;
    }

    public function create()
    {
        $result = true;

        $this->filename = $this->savePath . DIRECTORY_SEPARATOR . $this->_generateWidgetName();

        if (!$this->_isFileExistsInCache($this->filename)) {
            $this->imageBox = new Box($this->dp->getWidth(), $this->dp->getHeight());
            $this->imageResource = $this->imagine->create($this->imageBox, new Color($this->dp->getBackgroundColor()));
            $this->_addText();
            $result = $this->_saveImageFile($this->filename);
        }

        return $result;
    }

    public function getWidgetPath()
    {
        return $this->filename;
    }

    private function _isFileExistsInCache($filename)
    {
        return file_exists($filename);
    }

    private function _saveImageFile($filename)
    {
        $result = false;

        try {
            $this->imageResource->save($filename);
            $result = file_exists($filename);
        } catch (\Exception $e) {
        }

        return $result;
    }

    private function _addText()
    {
        $string = $this->dp->getText();
        $fontFile = $this->fileLocator->locate('@FrexinUwidgetBundle/Resources/public/fonts/verdanab.ttf');

        $font     = new Font($fontFile, 16, new Color($this->dp->getTextColor()));
        $position = new Center($this->imageBox);
        $this->imageResource->draw()->text($string, $font, $position);
    }

    private function _generateWidgetName($extension = 'png') {
        $dp = $this->dp;
        $string = $dp->getWidth() . $dp->getHeight() . $dp->getTextColor() . $dp->getBackgroundColor()
            . $dp->getText() . $dp->getUserHash();
        $name = substr(md5($string), 0, 14) . '.' . $extension;

        return $name;
    }
} 