<?php
declare(strict_types=1);

namespace Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{

    public function addAdminMenuItem(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu
            ->getChild('configuration')
                ->addChild('smt-smartarget-whatsapp-contact-us', ['route' => 'smartarget_smartarget_whatsapp_contact_us_admin_message_index'])
                    ->setLabel('smartarget_smartarget_whatsapp_contact_us.ui.messages')
                    ->setLabelAttribute('icon', 'podcast')
        ;

    }

}
