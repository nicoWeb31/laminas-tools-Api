<?php
return [
    'controllers' => [
        'factories' => [
            'StatusTest\\V1\\Rpc\\Ping\\Controller' => \StatusTest\V1\Rpc\Ping\PingControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'status-test.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'StatusTest\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'status-test.rest.status' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/status[/:status_id]',
                    'defaults' => [
                        'controller' => 'StatusTest\\V1\\Rest\\Status\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'status-test.rpc.ping',
            1 => 'status-test.rest.status',
        ],
    ],
    'api-tools-rpc' => [
        'StatusTest\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'status-test.rpc.ping',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'StatusTest\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'StatusTest\\V1\\Rest\\Status\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'StatusTest\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.status-test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'StatusTest\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status-test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'StatusTest\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.status-test.v1+json',
                1 => 'application/json',
            ],
            'StatusTest\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status-test.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'StatusTest\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'StatusTest\\V1\\Rpc\\Ping\\Validator',
        ],
        'StatusTest\\V1\\Rest\\Status\\Controller' => [
            'input_filter' => 'StatusTest\\V1\\Rest\\Status\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'StatusTest\\V1\\Rpc\\Ping\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ack',
                'description' => 'Acknowledge the request with a timestamp',
            ],
        ],
        'StatusTest\\V1\\Rest\\Status\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '140',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'message',
                'error_message' => 'A status message must be contain between 1 and 140 caractéres',
                'description' => 'It must be non-empty, and no more than 140 characters.',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^(mwop|andi|zeev)$/',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'user',
                'description' => 'the user providing the status message
The user submitting the status message.',
                'error_message' => 'It must be non-empty, and fulfill a regular expression.
You must provide a valid user.',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'description' => 'an integer timestamp,
The timestamp when the status message was last modified.',
                'error_message' => 'It does not need to be submitted, but if it is, must consist of only digits. It will always be returned in representations.
You must provide a timestamp.',
                'name' => 'timpstamp',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \StatusTest\V1\Rest\Status\StatusResource::class => \StatusTest\V1\Rest\Status\StatusResourceFactory::class,
        ],
    ],
    'api-tools-rest' => [
        'StatusTest\\V1\\Rest\\Status\\Controller' => [
            'listener' => \StatusTest\V1\Rest\Status\StatusResource::class,
            'route_name' => 'status-test.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \StatusTest\V1\Rest\Status\StatusEntity::class,
            'collection_class' => \StatusTest\V1\Rest\Status\StatusCollection::class,
            'service_name' => 'Status',
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \StatusTest\V1\Rest\Status\StatusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status-test.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \StatusTest\V1\Rest\Status\StatusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status-test.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'StatusTest\\V1\\Rest\\Status\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
