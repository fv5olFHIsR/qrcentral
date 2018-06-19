<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 */
class Campaign
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $campaign_name;

    public function getId()
    {
        return $this->id;
    }

    public function getCampaignName(): ?string
    {
        return $this->campaign_name;
    }

    public function setCampaignName(?string $campaign_name): self
    {
        $this->campaign_name = $campaign_name;

        return $this;
    }
}
