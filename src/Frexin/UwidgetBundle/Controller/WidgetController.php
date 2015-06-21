<?php

namespace Frexin\UwidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WidgetController extends Controller
{
    public function userAction($hash, $width, $height, $bgcolor, $textcolor)
    {

        $dataProvider = $this->get('widget.dataProvider');
        $dataProvider->setWidth($width)->setHeight($height)->setBackgroundColor($bgcolor)->setTextColor($textcolor);

        $validator = $this->get('validator');
        $errors = $validator->validate($dataProvider);


        return $this->render('FrexinUwidgetBundle:Widget:user.html.twig', array(
            'errors' => $errors
        ));
    }

}
