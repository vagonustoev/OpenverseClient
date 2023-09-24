<?php

namespace OpenverseClient\Enums\Image;

use OpenverseClient\Traits\EnumTrait;

enum Category: string
{
    use EnumTrait;
    case ARTWORK = "digitized_artwork";
    case ILLUSTRATION = "illustration";
    case PHOTOGRAPH = "photograph";
}
