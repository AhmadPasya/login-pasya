const searchBtn = document.querySelector(".search-box button");
const inputs = document.querySelectorAll(".search-box input");
const jobCards = document.querySelectorAll(".job-card");
const kategori = document.querySelectorAll(".card");
const navLokasi = document.querySelector(".nav-lokasi");

let filterKategori = "";

// SEARCH
if (searchBtn) {
    searchBtn.addEventListener("click", function () {
        let keyword = inputs[0].value.toLowerCase();
        let lokasi = inputs[1].value.toLowerCase();

        filterJob(keyword, lokasi, filterKategori);
    });
}

// FILTER
function filterJob(keyword, lokasi, kategori) {

    jobCards.forEach(card => {

        let title = card.querySelector("h3").innerText.toLowerCase();
        let city = card.querySelector(".location").innerText.toLowerCase();
        let kat = card.dataset.kategori;

        let cocok =
            title.includes(keyword) &&
            city.includes(lokasi) &&
            (kategori === "" || kat === kategori);

        card.style.display = cocok ? "block" : "none";
    });
}

// KATEGORI
kategori.forEach(k => {

    k.addEventListener("click", function () {

        kategori.forEach(c => c.classList.remove("active"));

        k.classList.add("active");

        filterKategori = k.dataset.kategori;

        filterJob("", "", filterKategori);
    });

});

// LOKASI NAVBAR
if (navLokasi) {

    navLokasi.addEventListener("change", function () {

        let lokasi = navLokasi.value;

        inputs[1].value = lokasi;

        filterJob("", lokasi, filterKategori);

    });

}

// APPLY
document.querySelectorAll(".apply-btn").forEach(btn => {

    btn.addEventListener("click", function () {

        let id_lowongan = btn.dataset.id;
        let posisi = btn.dataset.posisi;
        let lokasi = btn.dataset.lokasi;

        let confirmApply = confirm(
            "Yakin ingin melamar sebagai " +
            posisi +
            " di " +
            lokasi +
            "?"
        );

        if (confirmApply) {

            fetch("apply.php", {
                method: "POST",

                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },

                body: "id_lowongan=" + id_lowongan
            })

            .then(res => res.text())

            .then(data => {

                if (data.trim() == "success") {

                    alert("Lamaran berhasil dikirim!");

                } else {

                    alert("Gagal mengirim lamaran");

                }

            });

        }

    });

});

// FEATURED CLICK
document.querySelectorAll(".featured-card").forEach(card => {

    card.addEventListener("click", () => {

        alert("Menuju detail lowongan...");

    });

});