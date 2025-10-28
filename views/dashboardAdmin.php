<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="content">
    <!-- Dashboard -->
    <section id="dashboard" class="active">
      <h2>Hallo Admin!</h2>
    </section>

    

    <!-- Kelola Setoran -->
    <section id="setoran">
      <h2>Kelola Setoran</h2>
      <input type="text" id="search-setoran" class="search" placeholder="Cari Data Nasabah...">
      <button class="btn-green" onclick="openForm('tambahSetoranForm')">Tambah</button>

      <table id="table-setoran">
        <tr>
          <th>Tanggal</th><th>Nama</th><th>Jenis Sampah</th><th>Berat(kg)</th><th>Jumlah</th><th>Aksi</th>
        </tr>
        <tr>
          <td>23-11-2025</td><td>Anton Wardani</td><td>Plastik</td><td>2kg</td><td>Rp 200.000</td>
          <td><button class="btn-blue" onclick="openForm('editSetoranForm')">Edit</button></td>
        </tr>
        <tr>
          <td>23-11-2025</td><td>Agung Budiono</td><td>Kaca</td><td>1.5kg</td><td>Rp 120.000</td>
          <td><button class="btn-blue" onclick="openForm('editSetoranForm')">Edit</button></td>
        </tr>
      </table>

      <!-- Popup Tambah Setoran -->
      <div id="tambahSetoranForm" class="popup">
        <div class="popup-content">
          <h3>Tambah Data Setoran</h3>
          <input type="text" placeholder="Tanggal Pengajuan">
          <input type="text" placeholder="Nama Nasabah">
          <input type="text" placeholder="Jenis Sampah">
          <input type="number" placeholder="Berat(kg)">
          <input type="text" placeholder="Harga">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm('tambahSetoranForm')">Batal</button>
          </div>
        </div>
      </div>

      <!-- Popup Edit Setoran -->
      <div id="editSetoranForm" class="popup">
        <div class="popup-content">
          <h3>Edit Data Setoran</h3>
          <input type="text" placeholder="Tanggal Pengajuan">
          <input type="text" placeholder="Nama Nasabah">
          <input type="number" placeholder="Jenis Sampah">
          <input type="text" placeholder="Berat(kg)">
          <input type="text" placeholder="Harga">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm('editSetoranForm')">Batal</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Penarikan -->
    <section id="penarikan">
      <h2>Kelola Penarikan</h2>
      <input type="text" id="search-penarikan" class="search" placeholder="Cari Data Nasabah...">
      <button class="btn-green" onclick="openForm('tambahSetoranFormde')">Tambah</button>
      <table id="table-penarikan">
        <tr><th>Tanggal</th><th>Nama</th><th>Metode</th><th>Penarikan</th></tr>
        <tr><td>23-11-2025</td><td>Anton Wardani</td><td>Transfer</td><td>Rp. 100.000</td></tr>
        <tr><td>23-11-2025</td><td>Agung Budiono</td><td>Ambil Tunai</td><td>Rp. 100.000</td></tr>
      </table>
            <div id="tambahSetoranFormde" class="popup">
        <div class="popup-content">
          <h3>Tambah Data Setoran</h3>
          <input type="text" placeholder="Tanggal Penarikan">
          <input type="text" placeholder="Nama Nasabah">
          <input type="number" placeholder="Metode">
          <input type="text" placeholder="Jumlah Penarikan">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm('tambahSetoranFormde')">Batal</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Harga -->
    <section id="harga">
      <h2>Kelola Harga</h2>
      <button class="btn-green" onclick="openForm('tambahSetoranFormer')">Tambah</button>
      <table>
        <tr><th>Jenis Sampah</th><th>Berat(kg)</th><th>Lapak(kg)</th><th>Nasabah(kg)</th><th>Aksi</th></tr>
        <tr><td>Akrilik</td><td>1</td><td>Rp 13.000</td><td>20</td>
        <td><button class="btn-green" onclick="openForm('nasabahFormer')">Edit</button><button class="btn-red">Hapus</button></td>
      </table>

      <div id="tambahSetoranFormer" class="popup">
        <div class="popup-content">
          <h3>Tambah Data Setoran</h3>
          <input type="text" placeholder="Jenis Sampah">
          <input type="text" placeholder="Berat(kg)">
          <input type="number" placeholder="Lapak(kg)">
          <input type="text" placeholder="Nasabah(kg)">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm('tambahSetoranFormer')">Batal</button>
          </div>
        </div>
      </div>
     

         <div id="nasabahFormer" class="popup">
        <div class="popup-content">
          <h3>Edit Data Nasabah</h3>
          <input type="text" placeholder="Jenis Sampah">
          <input type="text" placeholder="Berat(kg)">
          <input type="email" placeholder="Lapak(kg)">
          <input type="password" placeholder="Nasabah(kg)">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm('nasabahFormer')">Batal</button>
          </div>
        </div>
      </div>

    </section>

    
  </div>

  <script>
    function showSection(id) {
      document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
      document.querySelectorAll(".nav-btn").forEach(btn => btn.classList.remove("active"));
      document.getElementById(id).classList.add("active");
      event.target.classList.add("active");
    }

    function openForm(formId) {
      document.getElementById(formId).style.display = "flex";
    }
    function closeForm(formId) {
      document.getElementById(formId).style.display = "none";
    }

    function setupSearch(inputId, tableId) {
      document.getElementById(inputId).addEventListener("keyup", function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll(`#${tableId} tr:not(:first-child)`);
        rows.forEach(row => {
          let name = row.cells[1].textContent.toLowerCase();
          row.style.display = name.includes(value) ? "" : "none";
        });
      });
    }

    setupSearch("search-kelola", "table-kelola");
    setupSearch("search-setoran", "table-setoran");
    setupSearch("search-penarikan", "table-penarikan");
  </script>
</body>
</html>