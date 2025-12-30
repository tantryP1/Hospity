document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('antrian-container');
    // const searchBox = document.getElementById('search-box');
    // const searchButton = document.getElementById('search-button');
    const searchBar = document.getElementById('search-box');
    let allAppointments = []; // Simpan semua data untuk pencarian

    // Fungsi untuk fetch data dari API
    async function fetchAppointments() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/admins/appointments');
            if (!response.ok) {
                throw new Error('Failed to fetch appointments');
            }
            const data = await response.json();
            if (data.message === 'Appointments fetched successfully') {
                allAppointments = data.data
                renderAppointments(allAppointments);
            } else {
                container.innerHTML = '<p>Tidak ada data untuk ditampilkan.</p>';
            }
        } catch (error) {
            container.innerHTML = `<p>Error: ${error.message}</p>`;
        }
    }

    // Fungsi untuk render data ke HTML
    function renderAppointments(appointments) {
        container.innerHTML = ''; // Clear existing content
        if (appointments.length === 0) {
            container.innerHTML = '<p>Belum ada janji konsultasi.</p>';
            return;
        }
        appointments.forEach(appointment => {
            const patientName = appointment.patient.nama;
            const poli = appointment.poli;
            const tanggal = appointment.tanggal_kunjungan;
            const jam = appointment.jam_kunjungan;
            const index = appointment.id_reservation;

            const div = document.createElement('div');
            div.classList.add('reservasi-box');
            div.innerHTML = `
                <h3>${patientName}</h3>
                <p>Poli ${poli} | ${tanggal} | ${jam}</p>
                <div class="action-buttons">
                    <button class="edit-button" data-index="${index}">
                        <img src="img/pencil.png" alt="Edit">
                    </button>
                    <button class="delete-button" data-index="${index}">
                        <img src="img/trashbin.png" alt="Delete">
                    </button>
                </div>
            `;
            container.appendChild(div);
        });

        // Tambahkan event listener untuk tombol edit dan hapus
        const editButtons = container.querySelectorAll('.edit-button');
        const deleteButtons = container.querySelectorAll('.delete-button');

        editButtons.forEach(button => {
            button.addEventListener('click', handleEdit);
        });

        deleteButtons.forEach(button => {
            button.addEventListener('click', handleDelete);
        });

    }

    // Panggil fungsi fetch saat halaman selesai dimuat
    fetchAppointments();

    // Fungsi untuk menangani tombol edit
    function handleEdit(event) {
        event.stopPropagation(); // Cegah event bubbling
            const id = event.currentTarget.dataset.index; // Ambil ID dari data-index tombol
            window.location.href = `/edit/${id}`; // Arahkan ke halaman edit
    }
    // function handleEdit(event) {
    //     const index = event.currentTarget.getAttribute('data-index');
    //     const appointment = allAppointments.find(a => a.id_reservation == index);

    //     if (appointment) {
    //         const newPoli = prompt('Masukkan Poli Baru:', appointment.poli);
    //         const newTanggal = prompt('Masukkan Tanggal Baru (YYYY-MM-DD):', appointment.tanggal_kunjungan);
    //         const newJam = prompt('Masukkan Jam Baru (HH:MM):', appointment.jam_kunjungan);

    //         if (newPoli && newTanggal && newJam) {
    //             // Lakukan update data di backend (contoh pakai fetch)
    //             fetch(`http://127.0.0.1:8000/api/admins/appointments/${index}`, {
    //                 method: 'PUT',
    //                 headers: { 'Content-Type': 'application/json' },
    //                 body: JSON.stringify({ poli: newPoli, tanggal_kunjungan: newTanggal, jam_kunjungan: newJam })
    //             })
    //                 .then(response => {
    //                     if (response.ok) {
    //                         alert('Reservasi berhasil diperbarui!');
    //                         fetchAppointments(); // Refresh data
    //                     } else {
    //                         alert('Gagal memperbarui reservasi!');
    //                     }
    //                 })
    //                 .catch(error => console.error('Error:', error));
    //         }
    //     }
    // }

    // Fungsi untuk menangani tombol hapus
    function handleDelete(event) {
        const index = event.currentTarget.getAttribute('data-index');

        if (confirm('Apakah Anda yakin ingin menghapus reservasi ini?')) {
            // Lakukan penghapusan data di backend (contoh pakai fetch)
            fetch(`http://127.0.0.1:8000/api/admins/appointments/${index}`, {
                method: 'DELETE'
            })
                .then(response => {
                    if (response.ok) {
                        alert('Reservasi berhasil dihapus!');
                        fetchAppointments(); // Refresh data
                    } else {
                        alert('Gagal menghapus reservasi!');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
    
    // searchButton.addEventListener('click', () => {
    //     const searchQuery = searchBox.value.toLowerCase();
    //     const filteredData = dataPasien.filter(pasien =>
    //         pasien.nama.toLowerCase().includes(searchQuery)
    //     );
    //     renderPasien(filteredData);
    // });

    // Event handler untuk mencari nama pasien
    searchBar.addEventListener('input', function () {
        const query = searchBar.value.toLowerCase(); // Ambil nilai input dan ubah ke huruf kecil
        const filteredAppointments = allAppointments.filter(appointment =>
            appointment.patient.nama.toLowerCase().includes(query) // Filter berdasarkan nama pasien
        );
        renderAppointments(filteredAppointments); // Render data yang difilter
    });
});



// // Dummy data pasien
// const dataPasien = [
//     { nama: 'John Doe', poli: 'Umum', tanggal: '2024-12-12', jam: '09:30' },
//     { nama: 'Jane Smith', poli: 'Anak', tanggal: '2024-12-13', jam: '10:00' },
//     { nama: 'Alice Brown', poli: 'Gigi', tanggal: '2024-12-14', jam: '11:30' },
// ];

// // Render data pasien ke dalam box
// const antrianContainer = document.getElementById('antrian-container');

// function renderPasien(data) {
//     antrianContainer.innerHTML = ''; // Clear container
//     data.forEach((pasien, index) => {
//         const box = document.createElement('div');
//         box.classList.add('reservasi-box');
//         box.innerHTML = `
//             <h3>${pasien.nama}</h3>
//             <p>Poli ${pasien.poli} - ${pasien.tanggal} - ${pasien.jam}</p>
//             <div class="action-buttons">
//                 <button class="edit-button" data-index="${index}">
//                     <img src="img/pencil.png" alt="Edit">
//                 </button>
//                 <button class="delete-button" data-index="${index}">
//                     <img src="img/trashbin.png" alt="Delete">
//                 </button>
//             </div>
//         `;
//         antrianContainer.appendChild(box);
//     });
// }

// // Event handler untuk search pasien
// const searchBox = document.getElementById('search-box');
// const searchButton = document.getElementById('search-button');

// searchButton.addEventListener('click', () => {
//     const searchQuery = searchBox.value.toLowerCase();
//     const filteredData = dataPasien.filter(pasien =>
//         pasien.nama.toLowerCase().includes(searchQuery)
//     );
//     renderPasien(filteredData);
// });

// // Event handler untuk edit dan hapus
// antrianContainer.addEventListener('click', (event) => {
//     const target = event.target.closest('button');
//     if (!target) return;

//     const index = target.dataset.index;
//     if (target.classList.contains('edit-button')) {
//         // Simpan data pasien yang akan diedit ke localStorage
//         localStorage.setItem('editData', JSON.stringify(dataPasien[index]));

//         // Arahkan ke halaman edit.html
//         window.location.href = 'edit.html';
//     } else if (target.classList.contains('delete-button')) {
//         if (confirm(`Hapus pasien: ${dataPasien[index].nama}?`)) {
//             dataPasien.splice(index, 1);
//             renderPasien(dataPasien);
//         }
//     }
// });

// // Render data awal
// renderPasien(dataPasien);