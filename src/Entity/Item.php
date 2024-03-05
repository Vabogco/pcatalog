<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Item 
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'category_name', type: 'string', length: 255, nullable: true)]
    private ?string $categoryName;

    #[ORM\Column(name: 'entity_id', type: 'integer', nullable: true)]
    private ?int $entityId;

    #[ORM\Column(name: 'sku', type: 'string')]
    private string $sku;

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: true)]
    private ?string $name;

    #[ORM\Column(name: 'description', type: 'string', length: 255, nullable: true)]
    private ?string $description;

    #[ORM\Column(name: 'link', type: 'string', length: 255, nullable: true)]
    private ?string $link;

    #[ORM\Column(name: 'image', type: 'string', length: 255, nullable: true)]
    private ?string $image;

    #[ORM\Column(name: 'shortdesc', type: 'text', nullable: true)]
    private ?string $shortdesc;

    #[ORM\Column(name: 'brand', type: 'string', length: 255, nullable: true)]
    private ?string $brand;

    #[ORM\Column(name: 'price', type: 'decimal', precision: 12, scale: 4, nullable: true)]
    private ?float $price;

    #[ORM\Column(name: 'rating', type: 'smallint', nullable: true)]
    private ?int $rating;

    #[ORM\Column(name: 'caffeine_type', type: 'string', length: 255, nullable: true)]
    private ?string $caffeineType;

    #[ORM\Column(name: 'count', type: 'integer', nullable: true)]
    private ?int $count;

    #[ORM\Column(name: 'flavored', type: 'boolean', nullable: true)]
    private ?bool $flavored;

    #[ORM\Column(name: 'seasonal', type: 'boolean', nullable: true)]
    private ?bool $seasonal;

    #[ORM\Column(name: 'in_stock', type: 'boolean',nullable: false)]
    private bool $instock;

    #[ORM\Column(name: 'facebook', type: 'boolean', nullable: false)]
    private bool $facebook;

    #[ORM\Column(name: 'is_kcup', type: 'boolean', nullable: false)]
    private bool $isKCup;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getCaffeineType(): string
    {
        return $this->caffeineType;
    }

    public function setCaffeineType(string $caffeineType): void
    {
        $this->caffeineType = $caffeineType;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
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

    public function getFlavored(): bool
    {
        return $this->flavored;
    }

    public function setFlavored(bool $flavored): void
    {
        $this->flavored = $flavored;
    }

    public function getSeasonal(): bool
    {
        return $this->seasonal;
    }

    public function setSeasonal(bool $seasonal): void
    {
        $this->seasonal = $seasonal;
    }

    public function getInstock(): bool
    {
        return $this->instock;
    }

    public function setInstock(bool $instock): void
    {
        $this->instock = $instock;
    }

    public function getFacebook(): bool
    {
        return $this->facebook;
    }

    public function setFacebook(bool $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getIsKCup(): bool
    {
        return $this->isKCup;
    }

    public function setIsKCup(bool $isKCup): void
    {
        $this->isKCup = $isKCup;
    }
}