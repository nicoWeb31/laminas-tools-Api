<?php

namespace blog\V1\Rest\Posts;

use StatusLib\Mapper;

class PostsResourceFactory
{
    public function __invoke($services)
    {
        return new PostsResource($services->get(Mapper::class));
    }
}
