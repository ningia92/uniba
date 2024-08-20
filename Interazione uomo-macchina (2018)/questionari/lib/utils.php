<?php
// Funzione per calcolare il quadrato di un valore - media
function sd_square($x, $mean) { return pow($x - $mean,2); }

// Funzione per calcolare la deviazione standard (utilizza sd_square) 
// input: un array su cui si desidera calcolare la deviazione standard

//Funzione per calcolare la deviazione standard
function stddev($array) {
    // radice quadrata della somma dei quadrati diviso per N - 1
    return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
}

function calcolaUmux($r1,$r2) {
    $result = 0.65 * (($r1+$r2-2) * (100/12) + 22.9);
    return $result;
}							   
?>