<?php

namespace OpenverseClient\Traits;

trait EnumTrait
{
    public function toString(): string
    {
        return $this->value;
    }
}
