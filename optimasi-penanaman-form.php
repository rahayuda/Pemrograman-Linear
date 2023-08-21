<!DOCTYPE html>
<html>
<head>
    <title>Optimasi Penanaman Pohon</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles here */
        .label-left {
            text-align: left;
            padding-left: 10px;
            font-weight: bold;
        }
        .input-small {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Optimasi Penanaman Pohon untuk Memaksimalkan Pendapatan</h2>
        <hr> <!-- HR pertama sebagai pemisah judul dengan form -->
        <form action="" method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Harga Pohon A:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="harga_a" step="0.01">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Harga Pohon B:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="harga_b" step="0.01">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Jumlah Pohon:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="jumlah_pohon">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Luas Pohon A (m2):</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="luas_a" step="0.01">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Luas Pohon B (m2):</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="luas_b" step="0.01">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label label-left">Luas Tanah (m2):</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control input-small" name="luas_tanah">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">Hitung</button>
                </div>
            </div>
        </form>
        <hr> <!-- HR kedua sebagai pemisah form dengan hasil -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $hargaA = $_POST["harga_a"];
            $hargaB = $_POST["harga_b"];
            $jumlahPohon = $_POST["jumlah_pohon"];
            $luasA = $_POST["luas_a"];
            $luasB = $_POST["luas_b"];
            $luasTanah = $_POST["luas_tanah"];

            $maxRevenue = 0;
            $maxX = 0;
            $maxY = 0;

            for ($x = 0; $x <= $jumlahPohon; $x++) {
                for ($y = 0; $y <= $jumlahPohon; $y++) {
                    if ($x * $luasA + $y * $luasB <= $luasTanah && $x + $y <= $jumlahPohon) {
                        $revenue = $hargaA * $x + $hargaB * $y;
                        if ($revenue > $maxRevenue) {
                            $maxRevenue = $revenue;
                            $maxX = $x;
                            $maxY = $y;
                        }
                    }
                }
            }

            echo "<div class='mt-4'>";
            echo "<p>Jumlah pohon jenis A yang harus ditanam: " . $maxX . "</p>";
            echo "<p>Jumlah pohon jenis B yang harus ditanam: " . $maxY . "</p>";
            echo "<p>Pendapatan maksimal yang dapat diperoleh: " . $maxRevenue . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
