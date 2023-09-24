<?php

namespace OpenverseClient\Actions;

use OpenverseClient\OpenverseRequest;

interface ActionInterface
{
    public function __construct(OpenverseRequest $request);
}
