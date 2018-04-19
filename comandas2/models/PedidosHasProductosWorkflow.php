<?php
namespace app\models;

class PedidosHasProductosWorkflow implements \raoul2000\workflow\source\file\IWorkflowDefinitionProvider
{
    public function getDefinition() {
        return [
            'initialStatusId' => 'iniciado',
            'status' => [
                'iniciado' => [
                    'transition' => ['cocina','cancelado']
                ],
                'cocina' => [],
                're-iniciado' => [
                    'transition' => ['aprobado','cancelado']
                ],
                'aprobado' => [
                    'transition' => ['cancelado','pagado','finalizado']
                ],
                'pagado' => [
                    'transition' => ['cancelado','finalizado']
                ],
                'entregado' => [
                    'transition' => ['finalizado']
                ],
                'finalizado' => [
                    'transition' => []
                ],
                'cancelado' => [
                    'transition' => ['re-iniciado']
                ]
            ]
        ];
    }
}