<?php
/* John Mcnesse F. Bañganan
   Gerald Clarence Barro
   Nick Andrei Butuhan */

$resultOutput = "";
$fortuneMessage = "";

$foodExpenses = intval($_POST['foodExpenses'] ?? 0);
$transportExpenses = intval($_POST['transportExpenses'] ?? 0);

$isDragonYear = isset($_POST['dragonYear']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // RANDOMLY GENERATE ANGPAO VALUES
    $angpao1 = rand(500,3000);
    $angpao2 = rand(500,3000);
    $angpao3 = rand(500,3000);

    // RANDOM LUCKY NUMBER
    $luckyNumber = rand(1,10);

    // ARITHMETIC OPERATORS
    $totalAngPao = $angpao1 + $angpao2 + $angpao3;

    $remainingMoney = $totalAngPao - $foodExpenses - $transportExpenses;

    // Dragon year multiplier
    if ($isDragonYear) {
        $remainingMoney *= 2;
        $dragonMsg = "🐉 Dragon Bonus Applied!";
    } else {
        $dragonMsg = "No Dragon Bonus.";
    }

    // ASSIGNMENT OPERATORS
    $remainingMoney += 500;
    $remainingMoney -= 200;

    // COMPARISON OPERATORS
    $isRich = ($remainingMoney > 5000);
    $isLuckyEight = ($luckyNumber == 8);
    $expensesTooHigh = ($foodExpenses + $transportExpenses > $totalAngPao);

    // LOGICAL OPERATORS
    $superLucky = ($isRich && $isLuckyEight);
    $festivalLucky = ($isRich || $isDragonYear);

    // INCREMENT / DECREMENT
    $luckyNumber++;
    $foodExpenses--;

    // RANDOM FORTUNE ARRAY
    $fortunes = [
        "✨ Prosperity follows your hard work.",
        "🐉 Fortune favors the brave this year.",
        "💰 Wealth energy detected!",
        "🌟 Opportunities are approaching fast.",
        "🧧 Your luck stat increased +10!"
    ];

    $fortuneMessage = $fortunes[array_rand($fortunes)];

    // OUTPUT
    $resultOutput .= "🎉 Happy Chinese New Year!<br>";

    $resultOutput .= "Generated Ang Pao 1: ₱$angpao1<br>";
    $resultOutput .= "Generated Ang Pao 2: ₱$angpao2<br>";
    $resultOutput .= "Generated Ang Pao 3: ₱$angpao3<br>";

    $resultOutput .= "Total Ang Pao: ₱$totalAngPao<br>";

    $resultOutput .= "Food Expenses: ₱$foodExpenses<br>";
    $resultOutput .= "Transport Expenses: ₱$transportExpenses<br>";

    $resultOutput .= "Remaining Money: ₱$remainingMoney<br>";
    $resultOutput .= "$dragonMsg<br>";

    if ($superLucky)
        $resultOutput .= "🔥 SUPER LUCKY STATUS ACHIEVED!<br>";
    elseif ($festivalLucky)
        $resultOutput .= "✨ You are Lucky this Year!<br>";
    else
        $resultOutput .= "🙂 Luck is building slowly.<br>";

    if ($expensesTooHigh)
        $resultOutput .= "⚠ Expenses exceeded earnings.<br>";

    if(isset($_POST['reset'])){
        $_POST = [];
        $resultOutput = "";
    }

    $resultOutput .= "Updated Lucky Number: $luckyNumber<br>";
    $resultOutput .= "Adjusted Food Expense: ₱$foodExpenses<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>🐉 CNY Activity</title>

<style>
/* DESIGN UNCHANGED */

body{
margin:0;
font-family:'Segoe UI',sans-serif;
color:white;
text-align:center;
overflow-x:hidden;
background:#2b0000;
}

body::before{
content:"";
position:fixed;
inset:0;
background:linear-gradient(120deg,#5a0000,#b30000,#7a0000,#3b0000);
background-size:400% 400%;
animation:silkFlow 18s ease infinite;
z-index:-3;
}

@keyframes silkFlow{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

body::after{
content:"";
position:fixed;
inset:0;
background:
radial-gradient(circle at 30% 40%, rgba(255,140,0,.25), transparent 40%),
radial-gradient(circle at 70% 60%, rgba(255,215,0,.18), transparent 45%);
animation:firePulse 6s ease-in-out infinite alternate;
z-index:-2;
}

@keyframes firePulse{
from{opacity:.5;}
to{opacity:.9;}
}

.particles{
position:fixed;
inset:0;
pointer-events:none;
z-index:-1;
}

.particles span{
position:absolute;
width:4px;
height:4px;
background:gold;
border-radius:50%;
animation:floatUp linear infinite;
opacity:.8;
}

@keyframes floatUp{
from{transform:translateY(100vh);opacity:0;}
20%{opacity:1;}
to{transform:translateY(-10vh);opacity:0;}
}

.container{
width:460px;
margin:60px auto;
padding:30px;
border-radius:20px;
background:rgba(0,0,0,.55);
backdrop-filter:blur(14px);
box-shadow:0 0 30px rgba(255,215,0,.7), inset 0 0 20px rgba(255,120,0,.3);
}

h2{
text-shadow:0 0 10px gold,0 0 25px orange;
}

input{
width:85%;
padding:10px;
margin:8px auto;
display:block;
border-radius:8px;
border:none;
text-align:center;
}

button{
margin-top:15px;
padding:13px 22px;
border:none;
border-radius:10px;
font-weight:bold;
cursor:pointer;
background:linear-gradient(45deg,#ffd700,#ffae00);
color:#7a0000;
transition:.35s;
}

button:hover{
transform:scale(1.08);
box-shadow:0 0 25px gold;
}

.result{
margin-top:22px;
padding:18px;
background:rgba(20,0,0,.85);
border:2px solid gold;
border-radius:10px;
line-height:1.8;
}

.result strong{
color:gold;
font-size:18px;
}
</style>
</head>

<body>

<div class="particles" id="particles"></div>

<script>
const container = document.getElementById("particles");

for(let i=0;i<40;i++){
let p=document.createElement("span");
p.style.left=Math.random()*100+"vw";
p.style.animationDuration=(6+Math.random()*6)+"s";
p.style.animationDelay=Math.random()*5+"s";
container.appendChild(p);
}
</script>

<div class="container">

<h2>2026 Fire Horse Lucky Calculator</h2>

<form method="POST">

<input type="number" name="foodExpenses" placeholder="🥟 Food Expenses" required>
<input type="number" name="transportExpenses" placeholder="🚕 Transport Expenses" required>

<br>
<label>
🐉 Activate Dragon Bonus Mode
<input type="checkbox" name="dragonYear">
</label>

<button type="submit">🎆 Reveal My Fortune</button>
<br>
<button type="submit" name="reset">🔄 Reset All</button>

</form>

<?php if($resultOutput!=""): ?>
<div class="result">
<hr>
<?php
echo $resultOutput;
echo "<br><strong>$fortuneMessage</strong>";
?>
<hr>
</div>
<?php endif; ?>

</div>

</body>
</html>