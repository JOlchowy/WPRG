<?php
$liczba = intval($_POST['liczba']);

function czyPierwsza($n, &$iteracje) {
    $iteracje = 0;
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        $iteracje++;
        if ($n % $i == 0) return false;
    }
    return true;
}

$iteracje = 0;
if (czyPierwsza($liczba, $iteracje)) {
    echo "$liczba jest liczbą pierwszą.<br>";
} else {
    echo "$liczba nie jest liczbą pierwszą.<br>";
}
echo "Liczba iteracji: $iteracje";
?>
