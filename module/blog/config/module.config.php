<?php
return [
    'controllers' => [
        'factories' => [],
    ],
    'router' => [
        'routes' => [
            'blog.rest.posts' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/posts[/:posts_id]',
                    'defaults' => [
                        'controller' => 'blog\\V1\\Rest\\Posts\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'blog.rest.posts',
        ],
    ],
    'api-tools-rpc' => [],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'blog\\V1\\Rest\\Posts\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'blog\\V1\\Rest\\Posts\\Controller' => [
                0 => 'application/vnd.blog.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'blog\\V1\\Rest\\Posts\\Controller' => [
                0 => 'application/vnd.blog.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'blog\\V1\\Rest\\Posts\\Controller' => [
            'input_filter' => 'blog\\V1\\Rest\\Posts\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'blog\\V1\\Rpc\\Posts\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '10',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [
                            'charlist' => '',
                        ],
                    ],
                ],
                'name' => 'name',
                'description' => 'default name field for our rpc service',
                'error_message' => 'name fild is required field',
            ],
        ],
        'blog\\V1\\Rest\\Posts\\Validator' => [
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
                'description' => 'a status message. It must be non-empty, and no more than 140 characters.',
                'error_message' => 'a status message. It must be non-empty, and no more than 140 characters.',
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
                'description' => 'The user submitting the status message',
                'error_message' => 'You must provide a valid user',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [
                            'breakchainonfailure' => true,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'timstamp',
                'description' => 'The timestamp when the status message was last modified',
                'error_message' => 'You must provide a timestamp',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \blog\V1\Rest\Posts\PostsResource::class => \blog\V1\Rest\Posts\PostsResourceFactory::class,
        ],
    ],
    'api-tools-rest' => [
        'blog\\V1\\Rest\\Posts\\Controller' => [
            'listener' => \blog\V1\Rest\Posts\PostsResource::class,
            'route_name' => 'blog.rest.posts',
            'route_identifier_name' => 'posts_id',
            'collection_name' => 'posts',
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
            'entity_class' => \blog\V1\Rest\Posts\PostsEntity::class,
            'collection_class' => \blog\V1\Rest\Posts\PostsCollection::class,
            'service_name' => 'posts',
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \blog\V1\Rest\Posts\PostsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'blog.rest.posts',
                'route_identifier_name' => 'posts_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \blog\V1\Rest\Posts\PostsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'blog.rest.posts',
                'route_identifier_name' => 'posts_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'blog\\V1\\Rest\\Posts\\Controller' => [
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
