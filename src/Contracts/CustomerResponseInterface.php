<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface CustomerResponseInterface
{

    /**
     * Recuperar Data
     * 
     * @return array
     */
    public function getData(): array;

    /**
     * Customer ID
     * 
     * @return string
     */
    public function getId(): string;

}