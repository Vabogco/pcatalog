<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

class ItemDto
{
    #[JMS\SerializedName('entity_id')]
    #[JMS\Type("integer")]
    #[Assert\NotNull(message: "The entity id should not be null.")]
    private int $entityId;

    #[JMS\SerializedName('CategoryName')]
    #[Assert\NotBlank(message: "The CategoryName should not be blank.")]
    private string $categoryName;

    #[Assert\NotBlank(message: "The sku should not be blank.")] 
    private string $sku;

    private ?string $name;

    private ?string $description;

    private ?string $shortdesc;

    private ?float $price;

    #[Assert\NotBlank(message: "The link should not be blank.")] 
    private string $link;

    #[Assert\NotBlank(message: "The image should not be blank.")] 
    private string $image;

    #[JMS\SerializedName('Brand')]
    private ?string $brand;

    #[JMS\SerializedName('Flavored')]
    #[JMS\Type('yes_no_boolean')]
    private ?bool $flavored;

    #[JMS\SerializedName('Seasonal')]
    #[JMS\Type('yes_no_boolean')]
    private ?bool $seasonal;

    #[JMS\SerializedName('Instock')]
    #[JMS\Type('yes_no_boolean')]
    #[Assert\NotNull(message: "The instock should not be null.")]
    private bool $instock;

    #[JMS\SerializedName('Facebook')]
    #[Assert\NotNull(message: "The facebook should not be null.")]
    private bool $facebook;

    #[JMS\SerializedName('IsKCup')]
    #[Assert\NotNull(message: "The isKCup should not be null.")]
    private bool $isKCup;

    #[JMS\SerializedName('Rating')]
    private ?int $rating;

    #[JMS\SerializedName('CaffeineType')]
    private ?string $caffeineType;

    #[JMS\SerializedName('Count')]
    private ?int $count = null;

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function getCaffeineType(): ?string
    {
        return $this->caffeineType;
    }

    public function setCaffeineType(?string $caffeineType): void
    {
        $this->caffeineType = $caffeineType;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

    public function getIsKCup(): bool
    {
        return $this->isKCup;
    }

    public function setIsKCup(bool $isKCup): void
    {
        $this->isKCup = $isKCup;
    }

    public function getFacebook(): bool
    {
        return $this->facebook;
    }

    public function setFacebook(bool $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getInstock(): bool
    {
        return $this->instock;
    }

    public function setInstock(bool $instock): void
    {
        $this->instock = $instock;
    }

    public function getSeasonal(): ?bool
    {
        return $this->seasonal;
    }

    public function setSeasonal(?bool $seasonal): void
    {
        $this->seasonal = $seasonal;
    }

    public function getFlavored(): ?bool
    {
        return $this->flavored;
    }

    public function setFlavored(?bool $flavored): void
    {
        $this->flavored = $flavored;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(?int $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getShortdesc(): ?string
    {
        return $this->shortdesc;
    }

    public function setShortdesc(?string $shortdesc): void
    {
        $this->shortdesc = $shortdesc;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }
}
