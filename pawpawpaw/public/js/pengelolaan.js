const container = document.querySelector('#daftar-antrian');
const filterTanggal = document.querySelector('#filter-tanggal');
const filterJam = document.querySelector('#filter-jam');
const applyFilter = document.querySelector('#apply-filter');

// Variabel untuk menyimpan data janji temu dari API
let allAppointments = [];

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
            allAppointments = result.data;
            renderAppointments(allAppointments);
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

// Fungsi untuk memfilter data berdasarkan tanggal dan jam
function applyFilterHandler() {
    const tanggal = filterTanggal.value;
    const jam = filterJam.value;
    const jamFilter = jam ? `${jam}:00` : null;

    // Memfilter data berdasarkan input tanggal dan jam
    const filteredData = allAppointments.filter(appointment => {
        return (
            (!tanggal || appointment.tanggal_kunjungan === tanggal) && // Filter berdasarkan tanggal
            (!jam || appointment.jam_kunjungan === jamFilter) // Filter berdasarkan jam
        );
    });

    // Render data yang sudah difilter
    renderAppointments(filteredData);
}

// Event Listener untuk tombol filter
applyFilter.addEventListener("click", applyFilterHandler);

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

// // Contoh data pasien
// const dataPasien = [
//     { nama: "John Doe", tanggal: "2024-12-12", jam: "09:30", poli: "Umum" },
//     { nama: "Jane Smith", tanggal: "2024-12-13", jam: "10:00", poli: "Gigi" },
//     { nama: "Albert Einstein", tanggal: "2024-12-12", jam: "11:00", poli: "Umum" },
// ];

// // Referensi elemen HTML
// const daftarAntrian = document.getElementById("daftar-antrian");
// const filterTanggal = document.getElementById("filter-tanggal");
// const filterJam = document.getElementById("filter-jam");
// const applyFilter = document.getElementById("apply-filter");

// // Fungsi untuk memuat data pasien
// function loadData(data) {
//     daftarAntrian.innerHTML = ""; // Kosongkan daftar sebelum menambahkan
//     data.forEach(pasien => {
//         const box = document.createElement("div");
//         box.classList.add("reservasi-box");

//         box.innerHTML = `
//             <h3>${pasien.nama}</h3>
//             <p>${pasien.tanggal} | ${pasien.jam}</p>
//             <p>Poli ${pasien.poli}</p>
//         `;
//         daftarAntrian.appendChild(box);
//     });
// }

// // Fungsi untuk memfilter data berdasarkan tanggal dan jam
// function applyFilterHandler() {
//     const tanggal = filterTanggal.value;
//     const jam = filterJam.value;

//     const filteredData = dataPasien.filter(pasien => {
//         return (!tanggal || pasien.tanggal === tanggal) &&
//                (!jam || pasien.jam === jam);
//     });

//     loadData(filteredData);
// }

// // Event Listener untuk tombol filter
// applyFilter.addEventListener("click", applyFilterHandler);

// // Muat semua data awal
// loadData(dataPasien);