<?php
namespace app\models;

class PedidosWorkflow implements \raoul2000\workflow\source\file\IWorkflowDefinitionProvider
{
    public function getDefinition() {
        return [
            'initialStatusId' => 'iniciado',
            'status' => [
                'iniciado' => [
                    'transition' => ['aprobado','cancelado']
                ],
                'reiniciado' => [
                    'transition' => ['aprobado','cancelado']
                ],
                'aprobado' => [
                    'transition' => ['cancelado','pagado']
                ],
                'pagado' => [
                    'transition' => ['cancelado','finalizado']
                ],
                'entregado' => [
                    'transition' => ['finalizado','cancelado']
                ],
                'finalizado' => [
                    'transition' => ['archivado']
                ],
                'cancelado' => [
                    'transition' => ['reiniciado']
                ],
                'archivado'
            ]
        ];
    }
}