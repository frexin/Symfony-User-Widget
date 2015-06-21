<?php

namespace Frexin\UwidgetBundle\Controller;

use Imagine\Gd\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\ConstraintViolationList;

class WidgetController extends Controller
{
    public function userAction($hash, $width, $height, $bgcolor, $textcolor)
    {
        $dataProvider = $this->get('widget.dataProvider');
        $dataProvider->setWidth($width)->setHeight($height)->setBackgroundColor($bgcolor)->setTextColor($textcolor);
        $dataProvider->setUserHash($hash);

        $validator = $this->get('validator');
        /**
         * @var ConstraintViolationList
         */
        $errors = $validator->validate($dataProvider);

        if (!count($errors)) {
            $widgetGenerator = $this->get('widget.generator');
            $widgetGenerator->setDataProvider($dataProvider);

            if ($widgetGenerator->create()) {
                $path = $widgetGenerator->getWidgetPath();
                print $path;
            }
        }

        return $this->render('FrexinUwidgetBundle:Widget:user.html.twig', array(
            'errors' => $errors
        ));
    }

}
