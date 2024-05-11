<?php

namespace Innoboxrr\OmniBilling\Contracts;

use Innoboxrr\OmniBilling\Common\Responses\BasePaymentResponse;

interface PaymentInterface
{
    /**
     * Realiza un cargo a una tarjeta de crédito o débito o medio de pago alternativo.
     *
     * @param array $data Información necesaria para realizar el cargo, como el monto, moneda, y detalles del pagador.
     * @return mixed
     */
    public function charge(array $data) : BasePaymentResponse;

    /**
     * Verificar el estado de un cargo 
     * 
     * @param string $transactionId El identificador de la transacción a verificar.
     * @return mixed
     */
    public function verify($transaction) : bool;

    /**
     * Procesa un reembolso a un cargo previamente realizado.
     *
     * @param string $transactionId El identificador de la transacción a reembolsar.
     * @param float|null $amount El monto a reembolsar. Si es null, se asume el monto total del cargo original.
     * @return mixed
     */
    public function refund($transactionId, $amount = null);

    /**
     * Autoriza un cargo que será completado (capturado) posteriormente.
     *
     * @param array $data Información necesaria para autorizar el cargo.
     * @return mixed
     */
    public function authorize(array $data);

    /**
     * Completa (captura) un cargo previamente autorizado.
     *
     * @param string $authorizationId El identificador de la autorización a capturar.
     * @param float|null $amount El monto a capturar. Si es null, se asume el monto total autorizado.
     * @return mixed
     */
    public function capture($authorizationId, $amount = null);

    /**
     * Cancela una autorización de pago que aún no ha sido capturada.
     *
     * @param string $authorizationId El identificador de la autorización a cancelar.
     * @return mixed
     */
    public function void($authorizationId);
}