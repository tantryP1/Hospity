const container = document.querySelector('.antrean-container');

// Fungsi untuk mengambil data dari API
async function fetchAppointments() {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/doctors/appointments');
        if (!response.ok) {
            throw new Error('Failed to fetch appointments');
        }
        const result = await response.json();

        // Periksa apakah data tersedia
        if (result.data && Array.isArray(result.data)) {
            renderAppointments(result.data);
            // Tambahkan event listener setelah semua elemen dibuat
            console.log('Isi container:', container.innerHTML);
            const reservasiBoxes = container.querySelectorAll('.reservasi-box');
            console.log(reservasiBoxes.length); // Periksa apakah elemen ditemukanx
            reservasiBoxes.forEach((box) => {
                box.addEventListener('click', () => {
                    window.location.href = '/pengelolaan'; // Arahkan ke halaman pengelolaan
                });
            });
        } else {
            container.innerHTML = '<p>Tidak ada janji temu tersedia.</p>';
        }
    } catch (error) {
        console.error('Error:', error);
        container.innerHTML = '<p>Gagal mengambil data janji temu.</p>';
    }
}

// Fungsi untuk merender data ke dalam box
function renderAppointments(appointments) {
    container.innerHTML = ''; // Kosongkan container sebelum merender ulang
    appointments.forEach((appointment) => {
        const reservasiBox = document.createElement('div');
        reservasiBox.classList.add('reservasi-box');
        reservasiBox.innerHTML = `
            <h3>${appointment.patient.nama}</h3>
            <p>${appointment.tanggal_kunjungan} | ${appointment.jam_kunjungan}</p>
            <p>Poli ${appointment.poli}</p>
        `;
        container.appendChild(reservasiBox);
    });
}

// Panggil fungsi untuk mengambil dan merender janji temu
fetchAppointments();


// const dataReservasi = [
//     { nama: "John Doe", jadwal: "12 Desember 2024", jam: "09:30", poli: "Umum" },
//     { nama: "Jane Smith", jadwal: "12 Desember 2024", jam: "10:00", poli: "Gigi" },
//     { nama: "Michael Johnson", jadwal: "12 Desember 2024", jam: "10:30", poli: "Anak" },
// ];

// const container = document.querySelector('.antrean-container');

// // Loop data dan tambahkan box ke dalam container
// dataReservasi.forEach(reservasi => {
//     const box = document.createElement('div');
//     box.classList.add('reservasi-box');

//     box.innerHTML = `
//         <h3>${reservasi.nama}</h3>
//         <p>${reservasi.jadwal} | ${reservasi.jam}</p>
//         <p>Poli ${reservasi.poli}</p>
//     `;
    
//     // Tambahkan event listener untuk navigasi
//     box.addEventListener('click', () => {
//         window.location.href = '/pengelolaan'; // Arahkan ke halaman pengelolaan
//     });
    
//     container.appendChild(box);
// });