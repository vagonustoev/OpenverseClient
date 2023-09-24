<?php

namespace OpenverseClient\Enums\Image;

use OpenverseClient\Traits\EnumTrait;

enum AspectRatio: string
{
    use EnumTrait;
    case SQUARE = "square";
    case TALL = "tall";
    case WIDE = "wide";
}
