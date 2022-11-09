<?php

namespace App\Enums;

enum VehicleStatusEnum:string
{
    case READY = 'ready';
    case IN_USE ='in_use';
    case RESERVED ='reserved';
    case MAINTENANCE ='maintenance';
}
