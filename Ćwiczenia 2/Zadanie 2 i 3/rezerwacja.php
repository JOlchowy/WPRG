<?php
function filtruj($dane) {
    return htmlspecialchars(trim($dane));
}

echo "<h2>Podsumowanie rezerwacji</h2>";
echo "Liczba osób: " . filtruj($_POST['osoby']) . "<br>";
echo "Imię: " . filtruj($_POST['imie']) . "<br>";
echo "Nazwisko: " . filtruj($_POST['nazwisko']) . "<br>";
echo "Adres: " . filtruj($_POST['adres']) . "<br>";
echo "E-mail: " . filtruj($_POST['email']) . "<br>";
echo "Karta kredytowa: " . filtruj($_POST['karta']) . "<br>";
echo "Data pobytu (początek): " . filtruj($_POST['data']) . "<br>";
echo "Godzina przyjazdu: " . filtruj($_POST['godzina']) . "<br>";
echo "Łóżko dla dziecka: " . (isset($_POST['lozko_dziecko']) ? "Tak" : "Nie") . "<br>";
echo "Udogodnienia: " . filtruj($_POST['udogodnienia']) . "<br><br>";

$liczba_osob = (int) $_POST['osoby'];

echo "<h3>Dane osób w rezerwacji:</h3>";
for ($i = 1; $i <= $liczba_osob; $i++) {
    $imie = filtruj($_POST["imie_osoba$i"]);
    $nazwisko = filtruj($_POST["nazwisko_osoba$i"]);
    echo "Osoba $i: $imie $nazwisko<br>";
}
?>
