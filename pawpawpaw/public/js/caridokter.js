document.getElementById('cariButton').addEventListener('click', function() {
    // Ambil spesialisasi yang dipilih
    var name = document.getElementById('name').value;

    // Panggil API berdasarkan spesialisasi
    fetch(`http://127.0.0.1:8000/api/admins/doctors/specializations/${name}`)
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Doctors fetched successfully') {
                displayDoctors(data.data, name);  // Function untuk menampilkan dokter di halaman
            } else {
                console.error(data.message);
                document.getElementById('dokterContainer').innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error fetching doctors:', error);
            document.getElementById('dokterContainer').innerHTML =
                '<p>Terjadi kesalahan saat memuat data dokter.</p>';
        });
});

function displayDoctors(doctors, specialization) {
    var container = document.getElementById('dokterContainer');
    container.innerHTML = '';  // Hapus isi sebelumnya

    if (doctors.length === 0) {
        container.innerHTML = '<p>Tidak ada dokter ditemukan.</p>';
        return;
    }

    doctors.forEach(function(doctor) {
        var doctorDiv = document.createElement('div');
        doctorDiv.classList.add('dokter-box');  // Atur kelas CSS untuk style
        doctorDiv.style.display = "block";

        doctorDiv.innerHTML = `
            <h3>${doctor.nama}</h3>
            <p>Spesialisasi: ${specialization}</p>
            <button class="pesan-button" onclick="pesanDokter('${doctor.id_user}')">Pesan</button>
        `;

        container.appendChild(doctorDiv);
    });
}

function pesanDokter(doctorId) {
    // Ambil nilai tanggal dan waktu dari input form
    const date = document.getElementById('tanggal').value;
    const time = document.getElementById('jam').value;

    // Validasi input
    if (!date || !time) {
        alert("Tanggal dan waktu harus diisi!");
        return;
    }

    // Data yang akan dikirim ke server
    const appointmentData = {
        doctor_id: doctorId,
        date: date,
        time: time,
    };

    // Kirim data ke API menggunakan fetch
    fetch("http://127.0.0.1:8000/api/patients/appointments", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify(appointmentData),
    })
        .then(response => response.json())
        .then(data => {
            if (data.message === "Appointment created successfully") {
                // Ambil ID janji temu dari respons
                const appointmentId = data.data.id_konsultasi;
                console.log("ID Konsultasi:", appointmentId);

                // Redirect ke halaman detail
                window.location.href = `/appointments/${appointmentId}`;
            } else {
                alert("Gagal membuat janji temu: " + data.message);
            }
        })
        .catch(error => {
            console.error("Kesalahan:", error);
            alert("Terjadi kesalahan saat membuat janji temu.");
        });
}