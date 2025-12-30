document.addEventListener('DOMContentLoaded', async function () {
    // Ambil ID reservasi dari URL (assume URL format: /edit/{id})
    const path = window.location.pathname;
    const pathSegments = path.split('/');
    const reservationId = pathSegments[pathSegments.length - 1];

    // Seleksi elemen-elemen form
    const namaField = document.getElementById('nama');
    const poliField = document.getElementById('poli');
    const tanggalField = document.getElementById('tanggal');
    const jamField = document.getElementById('jam');
    const form = document.getElementById('editReservasiForm');

    // Fungsi untuk mengambil data reservasi dari API
    async function fetchReservation() {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/admins/appointments/${reservationId}`);
            if (!response.ok) {
                throw new Error('Gagal mengambil data reservasi.');
            }

            const result = await response.json();
            // Pastikan data ada dalam respons
            if (!result.data) {
                throw new Error('Data tidak ditemukan dalam respons API.');
            }

            const data = result.data;

            // Isi form dengan data dari API
            namaField.value = data.patient.nama; // Nama tetap, gunakan ID user sebagai representasi
            namaField.disabled = true; // Menonaktifkan input nama
            poliField.value = data.poli;
            tanggalField.value = data.tanggal_kunjungan;
            jamField.value = data.jam_kunjungan.slice(0, 5); // Format jam ke HH:mm
        } catch (error) {
            console.error('Error:', error.message);
            alert('Terjadi kesalahan saat mengambil data reservasi.');
        }
    }

    // Fungsi untuk menyimpan perubahan melalui API
    async function updateReservation(event) {
        event.preventDefault(); // Mencegah submit default form

        try {
            const updatedData = {
                poli: poliField.value,
                tanggal_kunjungan: tanggalField.value,
                jam_kunjungan: jamField.value
            };

            const response = await fetch(`http://127.0.0.1:8000/api/admins/appointments/${reservationId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(updatedData),
            });

            if (!response.ok) {
                throw new Error('Gagal mengupdate reservasi.');
            }

            const result = await response.json();
            alert('Reservasi berhasil diperbarui.');
            window.location.href = '/admindashboard'; // Arahkan ke halaman admin setelah sukses
        } catch (error) {
            console.error('Error:', error.message);
            alert('Terjadi kesalahan saat menyimpan perubahan.');
        }
    }

    // Event listener untuk form submit
    form.addEventListener('submit', updateReservation);

    // Ambil data reservasi saat halaman dimuat
    fetchReservation();
});