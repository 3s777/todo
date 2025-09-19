<?php

namespace App\Enums;

enum StatusEnum: string
{
    case New = 'new';
    case Closed = 'closed';
    case Work = 'work';
    case Suspended = 'suspended';
}
