/* File: assets/js/admin-script.js */

/**
 * Fungsi untuk membuka popup modal
 * @param {string} modalId - ID dari elemen modal-overlay yang akan dibuka
 */
function openForm(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error('Modal with ID ' + modalId + ' not found.');
    }
}

/**
 * Fungsi untuk menutup popup modal
 * @param {string} modalId - ID dari elemen modal-overlay yang akan ditutup
 */
function closeForm(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error('Modal with ID ' + modalId + ' not found.');
    }
}

/**
 * Fungsi untuk membuka popup EDIT Nasabah dan mengisinya dengan data
 * @param {HTMLElement} buttonElement - Tombol 'Edit' yang diklik
 */
function openEditForm(buttonElement) {
    try {
        const id = buttonElement.getAttribute('data-id');
        const nama = buttonElement.getAttribute('data-nama');
        const username = buttonElement.getAttribute('data-username');
        const email = buttonElement.getAttribute('data-email');
        const nohp = buttonElement.getAttribute('data-nohp');
        const alamat = buttonElement.getAttribute('data-alamat');

        // Isi nilai ke dalam field form popup edit
        document.getElementById('edit_id_user').value = id; 
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_hp').value = nohp;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('edit_password').value = ''; // Kosongkan password
        
        // Tampilkan popup edit
        openForm('editForm');
    } catch (e) {
        console.error('Error in openEditForm: ', e.message);
        alert('Gagal membuka form edit. Pastikan semua ID elemen benar.');
    }
}

/**
 * Fungsi untuk membuka popup EDIT Sampah dan mengisinya dengan data
 * @param {HTMLElement} buttonElement - Tombol 'Edit' yang diklik
 */
function openEditSampahForm(buttonElement) {
    try {
        // Ambil data dari atribut data-* tombol yang diklik
        const id = buttonElement.getAttribute('data-id');
        const nama = buttonElement.getAttribute('data-nama');
        const kategori = buttonElement.getAttribute('data-kategori');
        const harga = buttonElement.getAttribute('data-harga');

        // Isi nilai ke dalam field form popup edit
        document.getElementById('edit_id_jenis').value = id;
        document.getElementById('edit_nama_jenis').value = nama;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('edit_harga_per_kg').value = harga;
        
        // Tampilkan popup edit
        openForm('editForm');
    } catch (e) {
        console.error('Error in openEditSampahForm: ', e.message);
        alert('Gagal membuka form edit. Pastikan semua ID elemen benar.');
    }
}

/**
 * Fungsi untuk membuka popup KONFIRMASI DELETE
 * @param {HTMLElement} buttonElement - Tombol 'Delete' yang diklik
 */
function openDeleteConfirm(buttonElement) {
    try {
        const deleteUrl = buttonElement.getAttribute('data-url');
        document.getElementById('deleteUrlInput').value = deleteUrl;
        openForm('deleteConfirmModal');
    } catch (e) {
        console.error('Error in openDeleteConfirm: ', e.message);
    }
}

/**
 * Fungsi untuk menjalankan aksi DELETE setelah dikonfirmasi
 */
function confirmDelete() {
    try {
        const deleteUrl = document.getElementById('deleteUrlInput').value;
        if (deleteUrl) {
            window.location.href = deleteUrl;
        } else {
            alert('Error: URL Hapus tidak ditemukan!');
        }
    } catch (e) {
        console.error('Error in confirmDelete: ', e.message);
    }
}