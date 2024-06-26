<?php

namespace Innoboxrr\OmniBilling\Contracts;

use Innoboxrr\OmniBilling\Common\Responses\BaseSubscriptionResponse;

interface SubscriptionInterface
{
    /**
     * Crea una nueva suscripción para un cliente con un plan específico.
     *
     * @param array $data Información necesaria para realizar el cargo, como el monto, moneda, y detalles del pagador.
     * @return BaseSubscriptionResponse
     */
    public function createSubscription(array $data): BaseSubscriptionResponse;

    /**
     * Cancela una suscripción existente.
     *
     * @param string $subscriptionId Identificador de la suscripción a cancelar.
     * @return mixed
     */
    public function cancelSubscription($subscriptionId);

    /**
     * Pausa una suscripción activa.
     *
     * @param string $subscriptionId Identificador de la suscripción a pausar.
     * @return mixed
     */
    public function pauseSubscription($subscriptionId);

    /**
     * Reanuda una suscripción pausada.
     *
     * @param string $subscriptionId Identificador de la suscripción a reanudar.
     * @return mixed
     */
    public function resumeSubscription($subscriptionId);

    /**
     * Actualiza el plan de una suscripción.
     *
     * @param string $subscriptionId Identificador de la suscripción a actualizar.
     * @param mixed $newPlan Identificador o información del nuevo plan de suscripción.
     * @return mixed
     */
    public function updateSubscriptionPlan($subscriptionId, $newPlan);

    /**
     * Obtiene los detalles de una suscripción específica.
     *
     * @param string $subscriptionId Identificador de la suscripción.
     * @return mixed
     */
    public function getSubscriptionDetails($subscriptionId);
}