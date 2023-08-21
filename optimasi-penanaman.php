<?php
// Fungsi pendapatan (f = 20000x + 15000y)
function calculateRevenue($x, $y) {
    return 20000 * $x + 15000 * $y;
}

// Batasan luas tanah: x + 0.5y <= 30
// Batasan jumlah pohon: x + y <= 50

$maxRevenue = 0;
$maxX = 0;
$maxY = 0;

for ($x = 0; $x <= 50; $x++) {
    for ($y = 0; $y <= 50; $y++) {
        // Cek batasan luas tanah dan jumlah pohon
        if ($x + 0.5 * $y <= 30 && $x + $y <= 50) {
            $revenue = calculateRevenue($x, $y);
            if ($revenue > $maxRevenue) {
                $maxRevenue = $revenue;
                $maxX = $x;
                $maxY = $y;
            }
        }
    }
}

echo "Jumlah pohon jeruk yang harus ditanam: " . $maxX . "<br>";
echo "Jumlah pohon apel yang harus ditanam: " . $maxY . "<br>";
echo "Pendapatan maksimal yang dapat diperoleh: " . $maxRevenue . " ribu rupiah";
?>