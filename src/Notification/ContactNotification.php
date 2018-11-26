<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 25/11/2018
 * Time: 15:04
 */

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

/**
 * Class ContactNotification
 * @package App\Notification
 */
class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    /**
     * ContactNotification constructor.
     * @param \Swift_Mailer $mailer
     */
    public  function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    /**
     * @param Contact $poContact
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function notify(Contact $poContact){
        $loMessage = (new \Swift_Message('agence'. $poContact->getProperty()->getTitle()))
            ->setFrom('brahhim.mess@gmail.com')
            ->setTo('brahhim.mess@gmail.com')
            ->setBody(
                $this->environment->render(
                'templates/emails/notification.html.twig',
                    array('name' => 'gsdfgsd')
                ),
                'text/html'
            );
        $this->mailer->send($loMessage);
    }

}