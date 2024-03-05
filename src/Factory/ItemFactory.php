<?php

namespace App\Factory;

use App\Dto\ItemDto;
use App\Entity\Item;

class ItemFactory
{
    public static function createItemEntity(ItemDto $itemDto): Item
    {
        $itemEntity = new Item();

        $itemEntity->setCategoryName($itemDto->getCategoryName());
        $itemEntity->setEntityId($itemDto->getEntityId());
        $itemEntity->setSku($itemDto->getSku());
        $itemEntity->setName($itemDto->getName());
        $itemEntity->setDescription($itemDto->getDescription());
        $itemEntity->setImage($itemDto->getImage());
        $itemEntity->setShortdesc($itemDto->getShortdesc());
        $itemEntity->setBrand($itemDto->getBrand());
        $itemEntity->setPrice($itemDto->getPrice()); 
        $itemEntity->setRating($itemDto->getRating());
        $itemEntity->setCaffeineType($itemDto->getCaffeineType());
        $itemEntity->setCount($itemDto->getCount());
        $itemEntity->setLink($itemDto->getLink());
        $itemEntity->setFlavored($itemDto->getFlavored());
        $itemEntity->setSeasonal($itemDto->getSeasonal());
        $itemEntity->setInstock($itemDto->getInstock());
        $itemEntity->setFacebook($itemDto->getFacebook());
        $itemEntity->setIsKCup($itemDto->getIsKCup());

        return $itemEntity;
    }
}
