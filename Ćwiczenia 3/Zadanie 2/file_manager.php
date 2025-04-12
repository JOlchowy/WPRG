<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Struktura plików</title>
</head>
<body>
<h2>Operacje na katalogach</h2>
<form method="GET" action="">
    <label>Ścieżka (bez końcowego "/"):</label><br>
    <input type="text" name="path" required><br><br>

    <label>Nazwa katalogu:</label><br>
    <input type="text" name="dirname" required><br><br>

    <label>Operacja:</label><br>
    <select name="operation">
        <option value="read">Odczytaj</option>
        <option value="create">Utwórz</option>
        <option value="delete">Usuń</option>
    </select><br><br>

    <input type="submit" value="Wykonaj">
</form>

<?php
function manageDirectory($path, $dirname, $operation = 'read') {
    $fullPath = rtrim($path, '/') . '/' . $dirname;

    if (!in_array($operation, ['read', 'create', 'delete'])) {
        echo "<p>Błędna operacja</p>";
        return;
    }

    if ($operation === 'read') {
        if (is_dir($fullPath)) {
            $contents = scandir($fullPath);
            echo "<p>Zawartość katalogu <strong>$fullPath</strong>:</p><ul>";
            foreach ($contents as $item) {
                if ($item !== '.' && $item !== '..') {
                    echo "<li>$item</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p>Katalog <strong>$fullPath</strong> nie istnieje.</p>";
        }
    }

    elseif ($operation === 'create') {
        if (is_dir($fullPath)) {
            echo "<p>Katalog już istnieje: <strong>$fullPath</strong></p>";
        } else {
            if (mkdir($fullPath, 0777, true)) {
                echo "<p>Utworzono katalog: <strong>$fullPath</strong></p>";
            } else {
                echo "<p>Błąd podczas tworzenia katalogu: <strong>$fullPath</strong></p>";
            }
        }
    }

    elseif ($operation === 'delete') {
        if (!is_dir($fullPath)) {
            echo "<p>Katalog nie istnieje: <strong>$fullPath</strong></p>";
        } else {
            $items = array_diff(scandir($fullPath), ['.', '..']);
            if (count($items) > 0) {
                echo "<p>Katalog <strong>$fullPath</strong> nie jest pusty. Nie można usunąć.</p>";
            } else {
                if (rmdir($fullPath)) {
                    echo "<p>Usunięto pusty katalog: <strong>$fullPath</strong></p>";
                } else {
                    echo "<p>Błąd podczas usuwania katalogu: <strong>$fullPath</strong></p>";
                }
            }
        }
    }
}

if (isset($_GET['path']) && isset($_GET['dirname'])) {
    $path = $_GET['path'];
    $dirname = $_GET['dirname'];
    $operation = isset($_GET['operation']) ? $_GET['operation'] : 'read';

    manageDirectory($path, $dirname, $operation);
}
?>
</body>
</html>
