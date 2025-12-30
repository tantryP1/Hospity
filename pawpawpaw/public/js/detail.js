document.addEventListener('DOMContentLoaded', function () {
    const path = window.location.pathname;
    const pathSegments = path.split('/');
    const appointmentId = pathSegments[pathSegments.length - 1];
    let doctorId = null; // Variabel untuk menyimpan ID dokter
    let poli = null; // Variabel untuk menyimpan poli    

    // Mapping manual untuk spesialisasi
    const specializationMap = {
        1: 'Cardiology',
        2: 'Neurology',
        3: 'Pediatrics',
        4: 'Orthopedics',
        5: 'Dermatology'
    };

    // Fungsi untuk mendapatkan nama spesialisasi dari ID
    function getSpecializationName(id) {
        return specializationMap[id] || 'Unknown'; // Default ke 'Unknown' jika ID tidak ditemukan
    }
    
    // Fetch the appointment details from API
    fetch(`http://127.0.0.1:8000/api/patients/appointments/${appointmentId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Appointment fetched successfully') {
            const appointment = data.data;

            // Mengisi informasi dokter
            const doctor = appointment.doctor;
            document.getElementById('dokterNama').innerText = doctor?.nama || 'Tidak tersedia';
            
            spesialisasi = getSpecializationName(doctor?.id_specialization);
            document.getElementById('dokterSpesialis').innerText = spesialisasi || 'Spesialisasi tidak tersedia';

            document.getElementById('dokterPoli').innerText = doctor?.lokasi_praktek || 'Poli tidak tersedia';

            // Simpan ID Dokter dan spesialisasi untuk proses reservasi
            doctorId = doctor?.id_user || null;
            poli = spesialisasi || null;

            // Debugging untuk memeriksa nilai
            console.log("Poli:", poli);
            console.log("Doctor ID:", doctorId);

            // Mengisi informasi pasien (opsional jika form ingin otomatis terisi)
            const patient = appointment.patient;
            if (patient) {
                document.getElementById('nama').value = patient.nama;
            }

        } else {
            console.error("Janji temu tidak ditemukan:", data.message);
            alert("Janji temu tidak ditemukan.");
        }
    })
    .catch(error => {
        console.error("Kesalahan:", error);
        alert("Terjadi kesalahan saat mengambil data janji temu.");
    });

    // Tombol Reservasi
    document.getElementById('reservasiButton').addEventListener('click', function () {
        const tanggalKunjungan = document.getElementById('tanggalKunjungan').value;
        const jamKunjungan = document.getElementById('jamKunjungan').value + ':00';

        if (!doctorId) {
            alert('ID Dokter tidak tersedia. Silakan coba lagi.');
            return;
        }

        if (!nama || !tanggalKunjungan || !jamKunjungan) {
            alert('Harap isi semua data pada formulir.');
            return;
        }

        // Kirim data reservasi ke API
        fetch('http://127.0.0.1:8000/api/patients/reservations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify({
                id_doctor: doctorId,
                poli: poli,
                tanggal_kunjungan: tanggalKunjungan,
                jam_kunjungan: jamKunjungan
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Reservation created successfully') {
                //alert('Reservasi berhasil dibuat! QR Code telah dihasilkan.');
                console.log(data.data);
                window.location.href = `/konfirmasi/${data.data.id_reservation}`;
            } else {
                alert(`Gagal membuat reservasi: ${data.message}`);
                console.log({
                    id_doctor: doctorId,
                    poli: poli,
                    tanggal_kunjungan: tanggalKunjungan,
                    jam_kunjungan: jamKunjungan
                });
                console.error(data.errors);
            }
        })
        .catch(error => {
            console.error("Kesalahan:", error);
            alert("Terjadi kesalahan saat mengirim data reservasi.");
        });
    });
});