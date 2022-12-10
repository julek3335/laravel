<?php
namespace App\Enums;

enum ServiceEventStatusEnum:string
{
    case WAITING = 'waiting';
    case FINISHED ='finished';
}
