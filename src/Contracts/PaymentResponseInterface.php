<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface PaymentResponseInterface
{

    /**
     * Recuperar Data
     * 
     * @return array
     */
    public function getData(): array;

    /**
     * URL de redirección de pago
     * 
     * @return string
     */
    public function getRedirectUrl(): string;

    /**
     * Recuperar estado
     * 
     * @return string
     */
    public function getStatus(): string;

}