<?php

/**
 * N1
 * იპოვეთ შეცდომა და ჩაასწორეთ
 * <?php
 * print 'How are you?';
 * print 'I'm fine.';
 * ?>
 */
print 'How are you?';
print "I'm fine.";


print "</br>";


/**
 * N2
 * ბიჭი მაკდონალდში უკვეთავს:
 * ბიგ მაკი 2 ცალი(ერთის ფასიე 7ლ)
 * კოკა-კოლა 3 ცალი(ერთის ფასი 2.45ლ)
 * კარტოფილი ფრი 2 ცალი (ერთის ფასი 1.75ლ)
 * ამ შენაძენზე მოქმედებს 7%-იანი ფასდაკლება.
 * დაწერეთ კოდი, რომელიც დაიანგარიშებს გადასახდელ თანხას.
 */

/**
 * გამოთვალეთ და დაბეჭდეთ მთლიანი ფასი ფასდაკლებით
 */
function totalPrice($bigMacQuantity, $CocaColaQuantity, $friesQuantity)
{
    $bigMacPrice            = 7;
    $CocaColaPrice          = 2.45;
    $friesPrice             = 1.75;
    $totalPrice             = ($bigMacQuantity * $bigMacPrice) + ($CocaColaQuantity * $CocaColaPrice) + ($friesQuantity * $friesPrice);
    $discount               = $totalPrice * 0.07;
    $totalPriceWithDiscount = $totalPrice - $discount;

    print "ფასი(ფასდაკლებით): " . number_format($totalPriceWithDiscount, 2, ',', '');
}
// რაოდენობა
$bigMacQuantity   = 2;
$CocaColaQuantity = 3;
$friesQuantity    = 2;
// გამშვები კოდი 
totalPrice($bigMacQuantity, $CocaColaQuantity, $friesQuantity);

print "</br>";

/**
 * N3
 * დაწერეთ კოდი, რომელიც ჩაანაცვლებს ‘{class}’ მნიშვნელობას “dinner” მნიშვნელობით 
 * სტრინგში რომელიც მოცემულია ცვლადში:
 * $html = '<span class="{class}">fried fish</span><span class="{class}">fried chicken</span>';
 */

$html = '<span class="{class}">fried fish</span><span class="{class}">fried chicken</span>';
print str_replace('{class}', 'dinner', $html);


print "</br>";

/**
 * N4
 * სწორად შემოსაზღვრეთ არითმეტიკული ოპერატორები, 
 * ისე რომ მოცემული გამოსახულების მნიშვნელობა უნდა იყოს 6:
 * <?php
 * print 2 + 4 * 10 / 9 - 2;
 * ?>
 */
print "პასხუი: " . (2 + (4 * 10)) / (9 - 2);

print "</br>";


/**
 * N5
 * შექმენით მასივი, რომელიც ასახავს ქალაქებისა და მასში მცხოვრებთა რაოდენობას:
 * თბილისი 2 000 000
 * რუსთავი 1 000 000
 * ქუთაისი 999 000
 * ბათუმი 1 400 000
 * თელავი 750 000
 * დაბჭდეთ ცხრილი, რომელიც შეიცავს ამ ინფორმაციას.
 */

// მასივი
$population = [
    "თბილისი" => 2000000,
    "რუსთავი" => 1000000,
    "ქუთაისი" => 999000,
    "ბათუმი" => 1400000,
    "თელავი" => 750000
];

// ცხრილი
print "<h3>მოსახლეობა ბავშვების გარეშე</h3>";
print "<table border='1'>
<tr>
<th>ქალაქი</th>
<th>მოსახლეობის რაოდენობა</th>
</tr>";

foreach ($population as $key => $qunatity) {
    print "<tr>";
    print "<td>" . $key . "</td>";
    print "<td>" . number_format($qunatity, 0, '') . "</td>";
    print "</tr>";
}
print "</table>";

print "</br>";



/**
 * N6
 * შექმნილი მასივი დაალაგეთ მოსახლეობის რაოდენობის კლებადობის მიხედვით. რევერსულად.
 */

//კლებადობის მიხედვით დალაგება
arsort($population);

// ცხრილი
print "<h3>კლებადობის მიხედვით დალაგებული ცხრილი</h3>";
print "<table border='1'>
<tr>
<th>ქალაქი</th>
<th>მოსახლეობის რაოდენობა</th>
</tr>";

foreach ($population as $key => $qunatity) {
    print "<tr>";
    print "<td>" . $key . "</td>";
    print "<td>" . number_format($qunatity, 0, '') . "</td>";
    print "</tr>";
}
print "</table>";


/**
 * მოდიფიცირება გაუკეთეთ შექმნილ მასივს ისე რომ თითოეულ ჩანაწერს დაუმატოთ 
 * ამ ქალაქებში მცხოვრებ ბავშვთა რაოდენობა:
 * თბილისი 10 985
 * რუსთავი 5 999
 * ქუთაისი 4 005
 * ბათუმი 7 210
 * თელავი 5 789
 */

$population = [
    "თბილისი" => 2000000,
    "რუსთავი" => 1000000,
    "ქუთაისი" => 999000,
    "ბათუმი" => 1400000,
    "თელავი" => 750000
];

$childrenPopulation = [
    "თბილისი" => 10985,
    "რუსთავი" => 5999,
    "ქუთაისი" => 4005,
    "ბათუმი"  => 7210,
    "თელავი"  => 5789
];
// $population["თბილისი"] += $childrenPopulation["თბილისი"];
// $population["რუსთავი"] += $childrenPopulation["რუსთავი"];
// $population["ქუთაისი"] += $childrenPopulation["ქუთაისი"];
// $population["ბათუმი"] += $childrenPopulation["ბათუმი"];
// $population["თელავი"] += $childrenPopulation["თელავი"];

$keys = array_keys($population);
for ($i = 0; $i < count($keys); $i++) {
    $population[$keys[$i]] += $childrenPopulation[$keys[$i]];
}
print "</br>";

//ცხრილი
print "<h3>მოსახლეობა ბავშვების ჩათვლით</h3>";
print "<table border='1'>
<tr>
<th>ქალაქი</th>
<th>მოსახლეობის რაოდენობა</th>
</tr>";

foreach ($population as $key => $qunatity) {
    print "<tr>";
    print "<td>" . $key . "</td>";
    print "<td>" . number_format($qunatity, 0, '') . "</td>";
    print "</tr>";
}
print "</table>";
