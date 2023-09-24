<?php

namespace OpenverseClient\Enums\Audio;

use OpenverseClient\Traits\EnumTrait;

enum Category: string
{
    use EnumTrait;
    case AUDIOBOOK = "audiobook";
    case MUSIC = "music";
    case NEWS = "news";
    case PODCAST = "podcast";
    case PRONUNCIATION = "pronunciation";
    case SOUND_EFFECT = "sound_effect";
}
