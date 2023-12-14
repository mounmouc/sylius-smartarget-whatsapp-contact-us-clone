<?php
declare(strict_types=1);

namespace Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Form\Type;

use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class MessageType extends AbstractResourceType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'smartarget_smartarget_whatsapp_contact_us.ui.form.enabled',
            ])
            ->add('channels', ChannelChoiceType::class, [
                'required' => false,
                'label' => 'smartarget_smartarget_whatsapp_contact_us.ui.form.channels',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('smartargetUserId', TextType::class, [
                'required' => false,
                'help_html' => true,
                'help' => 'Fill in this field to enable Free Plus plan. Whatsapp icon <span style="color: green">visible on all pages</span>, get <span style="color: green">FREE</span> access to <span style="color: green">more apps</span>. <a target="_blank" href="https://smartarget.online/">You can get Smartarget User ID here.</a>',
                'label' => 'smartarget_smartarget_whatsapp_contact_us.ui.form.smartargetUserId'
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'help_html' => true,
                'help' => 'Fill in this field to enable Free plan. <span style="color: red">Whatsapp icon visible on homepage only, you can change only app phone number.</span>',
                'label' => 'smartarget_smartarget_whatsapp_contact_us.ui.form.phoneNumber',
            ])
        ;
    }
}
