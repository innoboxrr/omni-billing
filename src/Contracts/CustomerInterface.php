<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface CustomerInterface
{
    /**
     * Crea un cliente o pagador en la pasarela de pago.
     *
     * @param array $customerData Información del cliente como nombre, correo electrónico, etc.
     * @return mixed
     */
    public function createCustomer(array $customerData);

    /**
     * Añade un método de pago al cliente.
     *
     * @param string $customerId El identificador del cliente al que se añadirá el método de pago.
     * @param array $paymentMethod Información del método de pago.
     * @return mixed
     */
    public function addPaymentMethodToCustomer($customerId, array $paymentMethod);
}