<?php

use App\Models\Mdata;

function app($d)
{
    $mdata = new Mdata;
    return $app = $mdata->view($d);
}
