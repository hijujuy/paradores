<?php

// Devuelve el id del usuario autenticado
function userID(){
    return auth()->user()->id;
}

// Devolver numero en formato moneda
function money($number){
    return '$'.number_format($number,2,',','.');
}

// Convertir numeros a letras
function numeroLetras($number){
    return App\Models\NumerosEnLetras::convertir($number,'Pesos',true,'Centavos');
}

// Devuelve el id del usuario autenticado
function isAdmin(){
    return auth()->user()->admin;
}

/**
 * Convierte numero a letras
 *
 * @param float $valor
 * Valor numerico a convertir
 *
 * @param string $desc_moneda
 * nombre de la moneda usada
 * 
 * @param string $sep
 * conjuncion entre parte entera y decimal
 * 
 * @param string $desc_decimal
 * nombre de la parte decimal
 *
 * @return string texto en letras del valor 
 *
 * */
function toWords($valor, $desc_moneda = "pesos", $sep = "con", $desc_decimal = "centavos") 
{
    $arr = explode(".", $valor);
    $entero = $arr[0];
    if (isset($arr[1])) {
        $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
    }

    $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
    if (is_array($arr)) {
        $num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} de $desc_moneda" : "{$fmt->format($entero)} $desc_moneda";
        if (isset($decimos) && $decimos > 0) {
            $num_word .= " $sep  {$fmt->format($decimos)} $desc_decimal";
        }
    }
    return $num_word;
}
