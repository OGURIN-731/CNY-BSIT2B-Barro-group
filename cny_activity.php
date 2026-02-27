<?php
/* Group Members
John Mcnesse F. Bañganan
Gerald Clarence Barro
Nick Andrei Butuhan */

$resultOutput = "";
$fortuneMessage = "";

/* get user inputs safely */
$foodExpenses = intval($_POST['foodExpenses'] ?? 0);
$transportExpenses = intval($_POST['transportExpenses'] ?? 0);
$luckyNumber = intval($_POST['luckyNumber'] ?? 0);

$isDragonYear = isset($_POST['dragonYear']);

/* run only when reveal button is pressed */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* generate random angpao values */
    $angpao1 = rand(500,3000);
    $angpao2 = rand(500,3000);
    $angpao3 = rand(500,3000);

    /* arithmetic */
    $totalAngPao = $angpao1 + $angpao2 + $angpao3;
    $remainingMoney = $totalAngPao - $foodExpenses - $transportExpenses;

    /* dragon bonus */
    if ($isDragonYear) {
        $remainingMoney *= 2;
        $dragonMsg = "🐉 Dragon Bonus Applied!";
    } else {
        $dragonMsg = "No Dragon Bonus.";
    }

    /* assignment */
    $remainingMoney += 500;
    $remainingMoney -= 200;

    /* comparison */
    $isRich = ($remainingMoney > 5000);
    $isLuckyEight = ($luckyNumber == 8);
    $expensesTooHigh = ($foodExpenses + $transportExpenses > $totalAngPao);

    /* logical */
    $superLucky = ($isRich && $isLuckyEight);
    $festivalLucky = ($isRich || $isDragonYear);

    /* increment / decrement */
    $luckyNumber++;
    $foodExpenses--;

    /* random fortune */
    $fortunes = [
        "✨ Prosperity follows your hard work.",
        "🐉 Fortune favors the brave this year.",
        "💰 Wealth energy detected!",
        "🌟 Opportunities are approaching fast.",
        "🧧 Your luck stat increased +10!"
    ];

    $fortuneMessage = $fortunes[array_rand($fortunes)];

    /* build output */
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

    $resultOutput .= "Updated Lucky Number: $luckyNumber<br>";
    $resultOutput .= "Adjusted Food Expense: ₱$foodExpenses<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>🐉 CNY Activity</title>

<style>

/* original design */

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
box-shadow:
0 0 30px rgba(255,215,0,.7),
inset 0 0 20px rgba(255,120,0,.3);
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

/* dragon background */

.dragon-silhouette{
position:fixed;
inset:0;
pointer-events:none;
z-index:-1;
background:url("dragon_silhouette.png") center/contain no-repeat;
opacity:0;
transition:opacity .6s ease;
filter:brightness(0) drop-shadow(0 0 30px rgba(255,0,0,.6));
}

/* confetti */

.confetti{
position:fixed;
width:8px;
height:8px;
top:-10px;
animation:fall linear forwards;
}

@keyframes fall{
to{transform:translateY(110vh) rotate(720deg);}
}

</style>
</head>

<body>

<div class="particles" id="particles"></div>

<script>

/* floating particles */

const container = document.getElementById("particles");

for(let i=0;i<40;i++){
let p=document.createElement("span");
p.style.left=Math.random()*100+"vw";
p.style.animationDuration=(6+Math.random()*6)+"s";
p.style.animationDelay=Math.random()*5+"s";
container.appendChild(p);
}

</script>

<div id="dragonSilhouette" class="dragon-silhouette"></div>

<div class="container">

<h2>2026 Fire Horse Lucky Calculator</h2>

<form method="POST" id="fortuneForm">

<input type="number" name="foodExpenses" placeholder="🥟 Food Expenses" required>
<input type="number" name="transportExpenses" placeholder="🚕 Transport Expenses" required>
<input type="number" name="luckyNumber" placeholder="🎯 Lucky Number" required>

<br>

<label>
🐉 Activate Dragon Bonus Mode
<input type="checkbox" name="dragonYear">
</label>

<button type="submit">🎆 Reveal My Fortune</button>
<br>

<!-- reset no longer submits -->
<button type="button" id="resetBtn">🔄 Reset All</button>

</form>

<?php if($resultOutput!=""): ?>
<div class="result" id="resultBox">
<hr>
<?php
echo $resultOutput;
echo "<br><strong>$fortuneMessage</strong>";
?>
<hr>
</div>
<?php endif; ?>

</div>

<script>

/* dragon toggle */

const dragonCheckbox = document.querySelector("input[name='dragonYear']");
const dragonSilhouette = document.getElementById("dragonSilhouette");

dragonCheckbox.addEventListener("change", () => {
dragonSilhouette.style.opacity = dragonCheckbox.checked ? "0.35" : "0";
});

<?php if($isDragonYear && $resultOutput!=""): ?>
dragonSilhouette.style.opacity="0.5";
<?php endif; ?>


/* confetti when result appears */

<?php if($resultOutput!=""): ?>

for(let i=0;i<120;i++){

let confetti=document.createElement("div");
confetti.className="confetti";

confetti.style.left=Math.random()*100+"vw";
confetti.style.backgroundColor=["gold","orange","red","yellow"][Math.floor(Math.random()*4)];
confetti.style.animationDuration=(3+Math.random()*3)+"s";

document.body.appendChild(confetti);

setTimeout(()=>confetti.remove(),6000);

}

<?php endif; ?>


/* reset button logic */

document.getElementById("resetBtn").addEventListener("click",function(){

document.getElementById("fortuneForm").reset();

dragonSilhouette.style.opacity=0;

/* remove result box */
let result=document.getElementById("resultBox");
if(result) result.remove();

/* remove confetti */
document.querySelectorAll(".confetti").forEach(c=>c.remove());

});

</script>

</body>
</html>