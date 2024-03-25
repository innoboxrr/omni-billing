<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface PriceInterface
{
    /**
     * Crea un precio/plan en la pasarela de pago.
     *
     * @param array $priceData Información del precio/plan como nombre, precio, etc.
     * @return mixed
     */
    public function createPrice(array $priceData);

    /**
     * Actualiza un precio/plan en la pasarela de pago.
     *
     * @param string $priceId El identificador del precio/plan que se actualizará.
     * @param array $priceData Información del precio/plan.
     * @return mixed
     */
    public function updatePrice($priceId, array $priceData);

    /**
     * Elimina un precio/plan de la pasarela de pago.
     *
     * @param string $priceId El identificador del precio/plan que se eliminará.
     * @return mixed
     */
    public function deletePrice($priceId);

    /**
     * Obtiene un precio/plan de la pasarela de pago.
     *
     * @param string $priceId El identificador del precio/plan que se obtendrá.
     * @return mixed
     */
    public function getPrice($priceId);
}