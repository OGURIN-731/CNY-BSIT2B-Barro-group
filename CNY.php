<?php

// Chinese New Year PHP Activity
// Back-End Processing Only

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Randomized Ang Pao (500 - 3000 pesos each)
    $angpao1 = rand(500, 3000);
    $angpao2 = rand(500, 3000);
    $angpao3 = rand(500, 3000);

    $foodExpenses = $_POST['foodExpenses'];
    $luckyNumber = $_POST['luckyNumber'];
    $transportExpense = $_POST['transportExpense'];

    $isDragonYear = isset($_POST['isDragonYear']); 

    // Arithmetic Operators
    $totalAngPao = $angpao1 + $angpao2 + $angpao3;
    $remainingMoney = $totalAngPao - $foodExpenses;

    if ($isDragonYear) {
        $remainingMoney = $remainingMoney * 2;
    }

    // Assignment Operators
    $remainingMoney += 500;
    $remainingMoney -= $transportExpense;

    // Comparison Operators
    $isRich = $remainingMoney > 5000;
    $isLuckyNumberEight = $luckyNumber == 8;
    $expensesHigher = $foodExpenses > $totalAngPao;

    // Logical Operators
    $superLucky = ($remainingMoney > 5000) && ($luckyNumber == 8);
    $luckyCondition = ($remainingMoney > 5000) || ($isDragonYear);
    $notDragonYear = !$isDragonYear;

    // Increment / Decrement
    $luckyNumber++;
    $foodExpenses--;

    // Display Results
    echo "<h2>🎉 Happy Chinese New Year! 🎉</h2><br>";

    echo "Ang Pao 1: ₱$angpao1<br>";
    echo "Ang Pao 2: ₱$angpao2<br>";
    echo "Ang Pao 3: ₱$angpao3<br><br>";

    echo "Total Ang Pao: ₱$totalAngPao<br>";
    echo "Remaining After Expenses: ₱$remainingMoney<br>";

    if ($isDragonYear) {
        echo "🐉 Dragon Bonus Applied!<br>";
    } else {
        echo "No Dragon Bonus This Year.<br>";
    }

    if ($superLucky) {
        echo "You are SUPER Lucky this Year!<br>";
    } elseif ($luckyCondition) {
        echo "You are Lucky this Year!<br>";
    } else {
        echo "Maybe Next Year Will Be Luckier!<br>";
    }

    if ($expensesHigher) {
        echo "Warning: Your expenses are higher than your Ang Pao!<br>";
    }

    echo "<br>Updated Lucky Number: $luckyNumber<br>";
    echo "Updated Food Expenses: ₱$foodExpenses<br>";

    echo "<br><strong>Final Computation: ₱$remainingMoney</strong><br>";

    // Random Fortune Generator
    $fortunes = array(
        "Great wealth is coming your way!",
        "A new opportunity will bring prosperity.",
        "Happiness and success will follow you.",
        "This year will double your blessings!",
        "Unexpected money is on its way!"
    );

    $randomIndex = array_rand($fortunes);

    echo "<br>Your Lucky Fortune: " . $fortunes[$randomIndex] . "<br>";
}
?>
