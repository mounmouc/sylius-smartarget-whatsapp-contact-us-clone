<?php
declare(strict_types=1);

namespace Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Model\ChannelInterface;

final class MessageRepository extends EntityRepository implements MessageRepositoryInterface
{

    /**
     * @param ChannelInterface $channel
     * @param string $localeCode
     *
     * @return mixed
     * @throws \Exception
     */
    public function getActiveMessagesForChannelAndLocale(ChannelInterface $channel, string $localeCode)
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->where('o.enabled = true')
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('channel', $channel)
        ;
        return $qb->getQuery()->getResult();
    }


}
