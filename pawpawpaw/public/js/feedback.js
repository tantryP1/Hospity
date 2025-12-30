function updateWordCount() {
    const textarea = document.getElementById('feedback');
    const wordCount = document.getElementById('wordCount');
    const currentLength = textarea.value.length;
    wordCount.textContent = `${currentLength}/300 Kata`;
}

function toggleTag(element) {
    element.classList.toggle('active');
}

let selectedDoctorId = null; // Variabel untuk menyimpan id_doctor yang dipilih

    // Fungsi untuk memilih dokter berdasarkan tag
    function selectDoctor(element) {
        // Hapus class 'selected' dari semua tag
        document.querySelectorAll('.tag').forEach(tag => tag.classList.remove('selected'));
        // Tambahkan class 'selected' ke tag yang diklik
        element.classList.add('selected');
        // Simpan id_doctor dari atribut data-id
        selectedDoctorId = element.getAttribute('data-id');
        // Tampilkan dokter yang dipilih
        document.getElementById('selectedDoctor').textContent = `Dokter yang dipilih: ${element.textContent}`;
        // Log ke console
        console.log(`ID Dokter yang dipilih: ${selectedDoctorId}`);
    }    

    // Fungsi untuk memperbarui jumlah karakter di textarea
    function updateWordCount() {
        const feedback = document.getElementById('feedback').value;
        document.getElementById('wordCount').textContent = `${feedback.length}/300 Kata`;
    }

    // Fungsi untuk mengirimkan data feedback
    document.getElementById('feedbackForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Mencegah reload halaman

        const message = document.getElementById('feedback').value;

        if (!selectedDoctorId) {
            alert('Pilih dokter terlebih dahulu!');
            return;
        }

        if (!message) {
            alert('Pesan tidak boleh kosong!');
            return;
        }

        try {
            const response = await fetch('http://127.0.0.1:8000/api/patients/feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Untuk keamanan CSRF
                },
                body: JSON.stringify({ id_doctor: selectedDoctorId, message: message })
            });

            const result = await response.json();

            if (response.ok) {
                //alert(result.message);
                // Reset form jika sukses
                document.getElementById('feedbackForm').reset();
                updateWordCount();
                // Reset pilihan dokter
                document.querySelectorAll('.tag').forEach(tag => tag.classList.remove('selected'));
                selectedDoctorId = null;
                window.location.href = '/homepage';
            } else {
                alert('Gagal mengirim feedback: ' + (result.errors ? JSON.stringify(result.errors) : result.message));
            }
        } catch (error) {
            alert('Terjadi kesalahan: ' + error.message);
        }
    });