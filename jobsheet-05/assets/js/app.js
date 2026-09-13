// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
  const toggleBtn = document.getElementById("nav-toggle-btn");
  const nav = document.querySelector("header nav");
  if (!toggleBtn || !nav) return;

  toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
  });
}

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
function initHapusConfirm() {
  document.querySelectorAll(".btn-hapus").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const row = btn.closest("tr");
      const nama = row ? row.querySelector("td")?.textContent : "data ini";
      const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');
      if (yakin && row) {
        row.remove();
        updateCounter();
      }
    });
  });
}

function updateCounter() {
  const table = document.querySelector(".table-responsive table");
  const count = document.querySelector(".search-count");
  if (!table || !count) return;

  const rows = table.querySelectorAll("tbody tr");
  const totalCount = rows.length;
  let visibleCount = 0;
  rows.forEach(function (row) {
    if (row.style.display !== "none") visibleCount++;
  });
  count.textContent = `Menampilkan ${visibleCount} dari ${totalCount} buku`;
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
  const input = document.getElementById("search-input");
  const table = document.querySelector(".table-responsive table");
  if (!input || !table) return;

  input.addEventListener("keyup", function () {
    const keyword = input.value.toLowerCase();
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(function (row) {
      const tdJudul = row.querySelector("td");
      if (tdJudul) {
        const teks = tdJudul.textContent.toLowerCase();
        if (teks.includes(keyword)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      }
    });
    updateCounter();
  });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
  hapusError(input);
  const span = document.createElement("span");
  span.className = "error";
  span.textContent = pesan;
  input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
  const next = input.nextElementSibling;
  if (next && next.classList.contains("error")) {
    next.remove();
  }
}

function initValidasiForm() {
  const form = document.querySelector("form");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    let valid = true;

    const requiredFields = ["judul", "nama", "pengarang", "stok"];
    requiredFields.forEach(name => {
      const el = form.querySelector(`[name='${name}']`);
      if (el) {
        if (el.value.trim() === "") {
          tampilkanError(el, "Field ini wajib diisi.");
          valid = false;
        } else {
          hapusError(el);
        }
      }
    });

    const tahun = form.querySelector("[name='tahun']");
    if (tahun) {
      const nilai = parseInt(tahun.value, 10);
      if (tahun.value.trim() === "") {
        tampilkanError(tahun, "Field ini wajib diisi.");
        valid = false;
      } else if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
        tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
        valid = false;
      } else {
        hapusError(tahun);
      }
    }

    const stok = form.querySelector("[name='stok']");
    if (stok && stok.value.trim() !== "") {
      const nilai = parseInt(stok.value, 10);
      if (isNaN(nilai) || nilai < 0) {
        tampilkanError(stok, "Stok tidak boleh negatif.");
        valid = false;
      }
    }

    const isbn = form.querySelector("[name='isbn']");
    if (isbn && isbn.value.trim() !== "") {
      if (!/^[0-9\-]+$/.test(isbn.value.trim())) {
        tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung.");
        valid = false;
      } else {
        hapusError(isbn);
      }
    } else if (isbn) {
      hapusError(isbn);
    }

    if (!valid) {
      e.preventDefault();
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initNavToggle();
  initHapusConfirm();
  initTableFilter();
  initValidasiForm();
  updateCounter();
});
