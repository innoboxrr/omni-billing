<?php

namespace Innoboxrr\OmniBilling\Contracts;

interface SubscriptionInterface
{
    /**
     * Crea una nueva suscripción para un cliente con un plan específico.
     *
     * @param mixed $customer Identificador o información del cliente.
     * @param mixed $plan Identificador o información del plan de suscripción.
     * @return mixed
     */
    public function createSubscription($customer, $plan);

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