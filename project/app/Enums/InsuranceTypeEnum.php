<?php

namespace App\Enums;

enum InsuranceTypeEnum:string
{
    case AC = 'ac';
    case OC ='oc';
    case OC_AC ='oc + ac';
    case NNW ='nnw';
    case ASSISTANCE ='assistance';
}
