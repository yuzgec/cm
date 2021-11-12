<?php 


function menu_is_active($url, $durum = 'active')
{
    return request()->is($url) ? $durum : null;
}


function money($deger){
    return number_format((float)$deger, 2, ',', '');
}


