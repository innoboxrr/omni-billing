<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface ProductInterface
{
    /**
     * Crea un producto en la pasarela de pago.
     *
     * @param array $productData Información del producto como nombre, precio, etc.
     * @return mixed
     */
    public function createProduct(array $productData);

    /**
     * Actualiza un producto en la pasarela de pago.
     *
     * @param string $productId El identificador del producto que se actualizará.
     * @param array $productData Información del producto.
     * @return mixed
     */
    public function updateProduct($productId, array $productData);

    /**
     * Elimina un producto de la pasarela de pago.
     *
     * @param string $productId El identificador del producto que se eliminará.
     * @return mixed
     */
    public function deleteProduct($productId);

    /**
     * Obtiene un producto de la pasarela de pago.
     *
     * @param string $productId El identificador del producto que se obtendrá.
     * @return mixed
     */
    public function getProduct($productId);
}