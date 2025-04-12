<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Data urodzenia</title>
</head>
<body>
<form method="GET" action="">
    <label for="birthdate">Wybierz datę urodzenia:</label>
    <input type="date" name="birthdate" required>
    <input type="submit" value="Sprawdź">
</form>

<?php
if (isset($_GET['birthdate'])) {
    $birthdate = new DateTime($_GET['birthdate']);
    $today = new DateTime();

    $dayOfWeek = $birthdate->format('l');

    $age = $today->diff($birthdate)->y;

    $nextBirthday = new DateTime(date('Y') . '-' . $birthdate->format('m-d'));
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }
    $daysUntil = $today->diff($nextBirthday)->days;

    echo "<p>Urodziłeś się w: <strong>$dayOfWeek</strong></p>";
    echo "<p>Masz: <strong>$age</strong> lat/a</p>";
    echo "<p>Do Twoich następnych urodzin zostało: <strong>$daysUntil</strong> dni</p>";
}
?>
</body>
</html>
