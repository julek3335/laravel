<?php

namespace App\Enums;

enum JobStatusEnum:string
{
    case IN_PROGRESS = 'in_progress';
    case FINISHED ='finished';
}
