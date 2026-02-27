<?php

// Chinese New Year PHP Activity
// Back-End Processing Only

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Variables to store user input
    $angpao1 = $_POST['angpao1'];
    $angpao2 = $_POST['angpao2'];
    $angpao3 = $_POST['angpao3'];
    $foodExpenses = $_POST['foodExpenses'];
    $luckyNumber = $_POST['luckyNumber'];
    $transportExpense = $_POST['transportExpense'];

    // Checkbox returns value only if checked
    $isDragonYear = isset($_POST['isDragonYear']); 

    // ARITHMETIC OPERATORS


    // (Addition) → Compute total Ang Pao
    $totalAngPao = $angpao1 + $angpao2 + $angpao3;

    // (Subtraction) → Subtract food expenses
    $remainingMoney = $totalAngPao - $foodExpenses;

    // (Multiplication) → Double money if Dragon Year
    if ($isDragonYear) {
        $remainingMoney = $remainingMoney * 2;
    }

    // B. ASSIGNMENT OPERATORS

    // += (Add and assign) → Add bonus 500
    $remainingMoney += 500;

    // -= (Subtract and assign) → Deduct transportation expense
    $remainingMoney -= $transportExpense;

    
    // C. COMPARISON OPERATORS
    

    // > (Greater than) → Check if money is greater than 5000
    $isRich = $remainingMoney > 5000;

    // == (Equal to) → Check if lucky number equals 8
    $isLuckyNumberEight = $luckyNumber == 8;

    // > (Compare expenses and total Ang Pao)
    $expensesHigher = $foodExpenses > $totalAngPao;

    
    // D. LOGICAL OPERATORS
    

    // AND (&&) → Money > 5000 AND Lucky number is 8
    $superLucky = ($remainingMoney > 5000) && ($luckyNumber == 8);

    // OR (||) → Money > 5000 OR Dragon Year
    $luckyCondition = ($remainingMoney > 5000) || ($isDragonYear);

    // NOT (!) → Check if NOT Dragon Year
    $notDragonYear = !$isDragonYear;

    
    // E. INCREMENT / DECREMENT
    

    // ++ (Increment) → Increase lucky number
    $luckyNumber++;

    // -- (Decrement) → Reduce food expenses
    $foodExpenses--;

    
    // DISPLAY RESULTS
    

    echo "<h2>🎉 Happy Chinese New Year! 🎉</h2><br>";

    echo "Total Ang Pao: ₱" . $totalAngPao . "<br>";
    echo "Remaining After Expenses: ₱" . $remainingMoney . "<br>";

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

    echo "<br>Updated Lucky Number (after increment): " . $luckyNumber . "<br>";
    echo "Updated Food Expenses (after decrement): ₱" . $foodExpenses . "<br>";

    echo "<br><strong>Final Computation: ₱" . $remainingMoney . "</strong><br>";

    
    // Random Fortune Generator
    

    $fortunes = array(
        "Great wealth is coming your way!",
        "A new opportunity will bring prosperity.",
        "Happiness and success will follow you.",
        "This year will double your blessings!",
        "Unexpected money is on its way!"
    );

    // array_rand() → Picks random index
    $randomIndex = array_rand($fortunes);

    echo "<br>Your Lucky Fortune: " . $fortunes[$randomIndex] . "<br>";

}
?>
