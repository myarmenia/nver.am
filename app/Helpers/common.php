<?php

if (!function_exists('getProductProcent')) {
  function getProductProcent($actualPrice, $cashback)
  {
    if($actualPrice && $cashback){
        return ($actualPrice - round(($actualPrice * $cashback ) / 100));
    }

    return false;
  }

}