// DATA DARI PHP
var daftarLowongan = [];
var filteredData = [];
var currentKategori = "Semua";

// AMBIL DATA DARI DATABASE
fetch("ambil_data.php")
    .then(response => response.json())
    .then(data => {
        daftarLowongan = data;
        applyFilter();
    });

// RENDER TABEL
function renderTabel() {
    var tbody = document.getElementById("tabel-body");
    tbody.innerHTML = "";

    for (var i = 0; i < filteredData.length; i++) {
        var lowongan = filteredData[i];

        var row = tbody.insertRow();

        row.insertCell(0).innerHTML = lowongan.posisi;
        row.insertCell(1).innerHTML = lowongan.perusahaan;
        row.insertCell(2).innerHTML = lowongan.lokasi;
        row.insertCell(3).innerHTML = lowongan.kategori;
        row.insertCell(4).innerHTML = '<button class="btn-detail-disabled" disabled>Detail</button>';
    }

    updateStatistik();
}

// FILTER
function applyFilter() {
    if (currentKategori === "Semua") {
        filteredData = daftarLowongan.slice();
    } else {
        filteredData = daftarLowongan.filter(function(item) {
            return item.kategori === currentKategori;
        });
    }

    renderTabel();
}

// STATISTIK
function updateStatistik() {
    var statDiv = document.getElementById("statistik");

    statDiv.innerHTML =
        "<strong>Statistik:</strong> Menampilkan " +
        filteredData.length +
        " dari " +
        daftarLowongan.length +
        " lowongan";
}

// EVENT
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("filter-kategori")
        .addEventListener("change", function() {
            currentKategori = this.value;
            applyFilter();
        });
});