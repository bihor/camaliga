<?php
return [
    'camaliga' => [
        'parent' => 'web',
        'position' => ['after' => '*'],
        'access' => 'user',
        'workspaces' => 'live',
        'iconIdentifier' => 'extension-camaliga-module',
        'path' => '/module/page/camaliga',
        'labels' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf',
        'extensionName' => 'Camaliga',
        'controllerActions' => [
            \Quizpalme\Camaliga\Controller\BackendController::class => 'thumb'
        ],
    ],
];