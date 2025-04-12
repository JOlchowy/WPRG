<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Porównanie algorytmów</title>
</head>
<body>
<h2>Porównaj algorytmy</h2>
<form method="GET" action="">
    <label for="n">Podaj liczbę:</label>
    <input type="number" name="n" min="0" required>

    <label for="type">Wybierz algorytm:</label>
    <select name="type" required>
        <option value="silnia">Silnia</option>
        <option value="fibonacci">Fibonacci</option>
    </select>

    <input type="submit" value="Porównaj">
</form>

<?php
function silniaRekurencyjna($n) {
    if ($n <= 1) return 1;
    return $n * silniaRekurencyjna($n - 1);
}

function silniaIteracyjna($n) {
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

function fibonacciRekurencyjny($n) {
    if ($n <= 1) return $n;
    return fibonacciRekurencyjny($n - 1) + fibonacciRekurencyjny($n - 2);
}

function fibonacciIteracyjny($n) {
    if ($n <= 1) return $n;
    $a = 0;
    $b = 1;
    for ($i = 2; $i <= $n; $i++) {
        $temp = $a + $b;
        $a = $b;
        $b = $temp;
    }
    return $b;
}

// --- Główna logika ---
if (isset($_GET['n']) && isset($_GET['type'])) {
    $n = (int) $_GET['n'];
    $type = $_GET['type'];

    echo "<h3>Wyniki dla $type($n):</h3>";

    if ($type === 'silnia') {
        $start1 = microtime(true);
        $rek = silniaRekurencyjna($n);
        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $iter = silniaIteracyjna($n);
        $time2 = microtime(true) - $start2;
    } elseif ($type === 'fibonacci') {
        $start1 = microtime(true);
        $rek = fibonacciRekurencyjny($n);
        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $iter = fibonacciIteracyjny($n);
        $time2 = microtime(true) - $start2;
    } else {
        echo "<p>Nieznany typ algorytmu.</p>";
        exit;
    }

    echo "<p>Rekurencyjnie: wynik = <strong>$rek</strong>, czas = <strong>" . round($time1, 6) . " s</strong></p>";
    echo "<p>Iteracyjnie: wynik = <strong>$iter</strong>, czas = <strong>" . round($time2, 6) . " s</strong></p>";
    echo "<p><strong>Szybsza metoda: " . ($time1 < $time2 ? 'rekurencyjna' : 'iteracyjna') . "</strong></p>";
}

/*$n = 20;
$type = 'fibonacci'; // lub 'silnia'
compare_algorithms($n, $type);*/
?>
</body>
</html>
