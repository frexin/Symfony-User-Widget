<?php

namespace Frexin\UwidgetBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Frexin\UwidgetBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WidgetController extends Controller
{
    /**
     * @var EntityRepository
     */
    private $usersRepository;

    public function userAction($hash, $width, $height, $bgcolor, $textcolor)
    {
        $this->usersRepository = $this->getDoctrine()->getManager()->getRepository('FrexinUwidgetBundle:User');
        $user = $this->usersRepository->findOneBy(['hash' => $hash, 'status' => User::USER_ACTIVE]);

        if (!$user) {
            throw new NotFoundHttpException('User not found or inactive');
        }

        $dataProvider = $this->get('widget.dataProvider');
        $dataProvider->setWidth($width)->setHeight($height)->setBackgroundColor($bgcolor)->setTextColor($textcolor);
        $dataProvider->setUserHash($hash);

        $errors = $this->get('validator')->validate($dataProvider);

        if (count($errors)) {
            throw new BadRequestHttpException('Invalid widget parameters');
        }

        $userRating = $this->usersRepository->getAverageRating($user->getId());
        $dataProvider->setText($userRating . "%");

        $widgetGenerator = $this->get('widget.generator');
        $widgetGenerator->setDataProvider($dataProvider);

        if (!$widgetGenerator->create()) {
            throw new HttpException(504, 'Unable to create widget file');
        }

        $path = $widgetGenerator->getWidgetPath();
        $response = new BinaryFileResponse($path);

        return $response;
    }
}