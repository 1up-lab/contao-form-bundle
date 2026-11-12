<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\NotificationCenter;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Terminal42\NotificationCenterBundle\NotificationCenter;
use Terminal42\NotificationCenterBundle\NotificationType\FormGeneratorNotificationType;

class NotificationFieldListener
{
    public function __construct(
        private readonly NotificationCenter $notificationCenter,
    ) {
    }

    #[AsCallback(table: 'tl_oneup_form', target: 'config.onload')]
    public function addToPalette(): void
    {
        $GLOBALS['TL_DCA']['tl_oneup_form']['palettes']['__selector__'][] = 'sendNotification';
        $GLOBALS['TL_DCA']['tl_oneup_form']['subpalettes']['sendNotification'] = 'notification';

        PaletteManipulator::create()
            ->addLegend('notification_legend', 'email_legend', PaletteManipulator::POSITION_AFTER)
            ->addField('sendNotification', 'notification_legend', PaletteManipulator::POSITION_APPEND)
            ->applyToPalette('default', 'tl_oneup_form')
        ;
    }

    #[AsCallback(table: 'tl_oneup_form', target: 'fields.notification.options')]
    public function getNotifications(): array
    {
        return $this->notificationCenter->getNotificationsForNotificationType(FormGeneratorNotificationType::NAME);
    }
}
