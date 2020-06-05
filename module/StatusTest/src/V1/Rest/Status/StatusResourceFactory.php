<?php
namespace StatusTest\V1\Rest\Status;

use StatusTest\V1\Rest\Status\StatusResource;

class StatusResourceFactory
{
    public function __invoke($services)
    {
        return new StatusResource($services->get(Mapper::class));
    }
}
