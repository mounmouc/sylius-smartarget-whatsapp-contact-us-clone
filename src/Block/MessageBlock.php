<?php
declare(strict_types=1);

namespace Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Block;

use Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Entity\Message;
use Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Repository\MessageRepositoryInterface;
use Sonata\BlockBundle\Model\Block;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;

final class MessageBlock extends Block
{
    /**
     * @var ChannelContextInterface
     */
    private $channelContext;

    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var CustomerContextInterface
     */
    private $customerContext;

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * MessageBlock constructor.
     *
     * @param ChannelContextInterface $channelContext
     * @param LocaleContextInterface $localeContext
     * @param CustomerContextInterface $customerContext
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        ChannelContextInterface $channelContext,
        LocaleContextInterface $localeContext,
        CustomerContextInterface $customerContext,
        MessageRepositoryInterface $messageRepository
    ) {
        parent::__construct();
        $this->channelContext = $channelContext;
        $this->localeContext = $localeContext;
        $this->customerContext = $customerContext;
        $this->messageRepository = $messageRepository;
    }

    public function getMessages(): array
    {
        return $this->messageRepository->getActiveMessagesForChannelAndLocale(
            $this->channelContext->getChannel(),
            $this->localeContext->getLocaleCode()
        );
    }

}
