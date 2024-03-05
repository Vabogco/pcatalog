<?php

namespace App\Exception;

use RuntimeException;

class CollectionException extends RuntimeException implements CollectionExceptionInterface
{
    protected array $errors;

    /**
     * CollectionException constructor.
     */
    public function __construct(string $message, array $errors = [])
    {
        parent::__construct($message);

        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(bool $deep = false)
    {
        return $this->errors;
    }
}
