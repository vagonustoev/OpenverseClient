<?php

namespace OpenverseClient\Enums\Audio;

use OpenverseClient\Traits\EnumTrait;

enum Length: string
{
    use EnumTrait;

    case LONG = "long";
    case MEDIUM = "medium";
    case SHORT = "short";
    case SHORTEST = "shortest";
}
