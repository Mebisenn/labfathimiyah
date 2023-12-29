<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pelajaran Generator</title>
</head>
<body>

<h1>Jadwal Pelajaran Generator</h1>

<button onclick="generateSchedule()">Generate Jadwal</button>
<button onclick="saveSchedule()">Simpan</button>

<p id="schedule"></p>

<script>
    function generateSchedule() {
        // Menggunakan AJAX untuk memanggil script PHP yang akan mengambil dan mengacak jadwal dari database
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("schedule").innerHTML = this.responseText;
            }
        };
        xhr.open("GET", "generate.php", true);
        xhr.send();
    }

    function saveSchedule() {
        // Menggunakan AJAX untuk memanggil script PHP yang akan menyimpan jadwal ke database
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText); // Menampilkan pesan dari server (opsional)
            }
        };
        xhr.open("GET", "save_schedule.php", true);
        xhr.send();
    }
</script>

</body>
</html>
