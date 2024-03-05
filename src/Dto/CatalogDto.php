<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

#[JMS\XmlRoot("catalog")]
class CatalogDto
{
   /** @var ItemDto[] */
   #[JMS\XmlList(inline: true, entry: "item")]
   #[JMS\Type("array<App\Dto\ItemDto>")]
   private array $items = [];

   public function getItems(): array
   {
       return $this->items;
   }

   public function setItems(array $items)
   {
       $this->items = $items;
   }
}
