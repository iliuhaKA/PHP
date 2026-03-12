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
?>
<table border="1">
<thead>
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Amount</td>
        <td>Description</td>
        <td>Merchant</td>
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
        </tr>
    <?php endforeach; ?>
</tbody>

</table>