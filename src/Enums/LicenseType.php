<?php

namespace OpenverseClient\Enums;

use OpenverseClient\Traits\EnumTrait;

enum LicenseType: string
{
    use EnumTrait;
    case ALL = "all";
    case ALL_CC = "all-cc";
    case COMMERCIAL = "commercial";
    case MODIFICATION = "modification";
}
