<?php

namespace OpenverseClient\Enums\Image;

use OpenverseClient\Traits\EnumTrait;

enum Size: string
{
    use EnumTrait;
    case LARGE = "large";
    case MEDIUM = "medium";
    case SMALL = "small";
}
