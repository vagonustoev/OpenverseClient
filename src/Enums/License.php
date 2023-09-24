<?php

namespace OpenverseClient\Enums;

use OpenverseClient\Traits\EnumTrait;

enum License: string
{
    use EnumTrait;
    case BY = "by";
    case BY_NC = "by-nc";
    case BY_NC_ND = "by-nc-nd";
    case BY_NC_SA = "by-nc-sa";
    case BY_ND = "by-nd";
    case BY_SA = "by-sa";
    case CC0 = "cc0";
    case NC_SAMPLING = "nc-sampling+";
    case PDM = "pdm";
    case SAMPLING = "sampling+";


}
