<?php

declare(strict_types=1);

$transactions = [
    [
        "id" => 1,
        "date" => "2019-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2020-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
];


/**
 * Calculate the total amount of all transactions.
 *
 * @param array $transactions Array of transaction records, each containing an 'amount' key.
 * @return float Sum of amounts in the transactions list.
 */
function calculateTotalAmount(array $transactions): float {
    $sum = 0.0;
    foreach ($transactions as $transaction) {
        $sum += $transaction['amount'];
    }
    return $sum;
}

/**
 * Search transactions for the first entry whose description contains the given substring.
 *
 * @param string $descriptionPart Part of the description to search for (case-insensitive).
 * @return array|null Matching transaction record or null if none found.
 */
function findTransactionByDescription(string $descriptionPart) {
    foreach ($transactions as $transaction) {
        if(stripos($transaction["description"], $descriptionPart))
            return $transaction;
    }
    return NULL;
}

/**
 * Retrieve a transaction by its numeric identifier.
 *
 * @param int $id Transaction ID to look for.
 * @return array|null Transaction record if found, otherwise null.
 */
function findTransactionById(int $id) {
    foreach ($transactions as $transaction) {
        if($transaction["id"] == $id)
            return $transaction;
    }
    return NULL;
}

/**
 * Filter transactions for those matching the given ID (returns an array of matches).
 *
 * @param int $id Transaction ID to filter by.
 * @return array Array of transactions with the matching ID (possibly empty).
 */
function findTransactionByIdHigh(int $id) {
    return array_filter($transactions, function($transaction) { return $transaction["id"] == $id; });
}

/**
 * Compute the number of days elapsed since the given transaction date.
 *
 * @param string $date Date string parseable by DateTime (e.g. "YYYY-MM-DD").
 * @return int Days between the provided date and today.
 */
function daysSinceTransaction(string $date): int {
    $date_obj = new DateTime($date);
    $now = new DateTime();

    return $date_obj->diff($now)->days;
}

/**
 * Append a new transaction to the given transactions array.
 *
 * This function modifies the array passed by reference.
 *
 * @param array &$trs Reference to transactions array to append to.
 * @param int $id Identifier for the new transaction.
 * @param string $date Date of the transaction (YYYY-MM-DD).
 * @param float $amount Monetary amount involved.
 * @param string $description Description text.
 * @param string $merchant Merchant name.
 * @return void
 */
function addTransaction(array &$trs, int $id, string $date, float $amount, string $description, string $merchant): void {
    $trs[] = [
        'id' => $id, 
        'date'=> $date,
        'amount' => $amount,
        'description' => $description,
        'merchant' => $merchant
        ];
}

addTransaction($transactions, 3, "2020-01-01", 150.00, "Ale EbiDoebi", "Boggi Woggi");

usort($transactions, function($a, $b) {
    return $a['date'] <=> $b['date'];
});

usort($transactions, function($a, $b) {
    return $b['amount'] <=> $a['amount'];
});

?>
<table border="1">
<thead>
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Amount</td>
        <td>Description</td>
        <td>Merchant</td>
        <td>Days gone...</td>
    </tr>
</thead>
<tbody>
    <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?= $transaction['id'] ?></td>
            <td><?= $transaction['date'] ?></td>
            <td><?= $transaction['amount'] ?></td>
            <td><?= $transaction['description'] ?></td>
            <td><?= $transaction['merchant'] ?></td>
            <td><?= daysSinceTransaction($transaction['date']) ?> </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php
// Задаем путь к папке с изображениями
$dir = 'image/';
// Сканируем содержимое директории
// scandir — Получает список файлов и каталогов, расположенных по  указанному пути.
// Возвращает array, содержащий имена файлов и каталогов, расположенных по  пути, переданному в параметре
$files = scandir($dir);

// Если нет ошибок при сканировании
if ($files === false) {
   return;
}

for ($i = 0; $i < count($files); $i++) {
   // Пропускаем текущий каталог и родительский
   if (($files[$i] != ".") && ($files[$i] != "..")) {
       // Получаем путь к изображению
       $path = $dir . $files[$i]; ?>
       <img src="<?= $path ?>" alt="<?= $files[$i] ?>" style="width: 200px; margin: 10px;" />
   <?php
   };
} 
?>