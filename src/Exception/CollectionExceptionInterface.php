<?php

namespace App\Exception;

interface CollectionExceptionInterface
{
    /**
     * Returns error messages.
     *
     * @return array
     */
    public function getErrors(bool $deep = false);
}
