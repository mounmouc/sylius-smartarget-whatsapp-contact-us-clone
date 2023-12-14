<?php
declare(strict_types=1);

namespace Smartarget\SyliusSmartargetWhatsappContactUsPlugin\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Timestampable;
use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="smt_smartarget_whatsapp_contact_us")
 */
class Message implements ResourceInterface, TimestampableInterface, ToggleableInterface, Timestampable
{
    use TimestampableTrait, ToggleableTrait;

    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": true})
     */
    protected $enabled = true;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    protected $phoneNumber;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $smartargetUserId;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\Sylius\Component\Channel\Model\Channel")
     * @ORM\JoinTable(
     *     name="smt_smartarget_whatsapp_contact_us_channels",
     *     joinColumns={@ORM\JoinColumn(name="message_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="channel_id", referencedColumnName="id")}
     * )
     */
    private $channels;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="created_at", type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->channels = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return sha1("sylius_whatsapp_" . gmdate("Y-m-d H"));
    }


    /**
     * @return string|null
     */
    public function getForceSettings(): ?string
    {
        return urlencode(json_encode(['phoneNumber' => $this -> phoneNumber]));
    }

    /**
     * @param string|null $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getSmartargetUserId(): ?string
    {
        return $this->smartargetUserId;
    }

    /**
     * @param string|null $smartargetUserId
     */
    public function setSmartargetUserId(?string $smartargetUserId): void
    {
        $this->smartargetUserId = $smartargetUserId;
    }

    /**
     * @return Collection
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    /**
     * @param Channel $channel
     */
    public function addChannel(Channel $channel): void
    {
        $this->channels->add($channel);
    }

    /**
     * @param Channel $channel
     */
    public function removeChannel(Channel $channel): void
    {
        $this->channels->removeElement($channel);
    }

}
