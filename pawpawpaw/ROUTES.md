# API Endpoints and Usage

## Auth Endpoints

### **Register Endpoint**

| HTTP Method | Endpoint          | Description                  | Example Payload | Example Response |
|-------------|-------------------|------------------------------|-----------------|------------------|
| POST        | `/auth/register`   | Register a new user.         | `{ "nama": "John Doe", "nik": "1234567890123456", "no_telp": "08123456789", "email": "john@example.com", "password": "password", "role": "PATIENT" }` | `{ "message": "User registered successfully", "user_id": 1 }` |

### **Login Endpoint**

| HTTP Method | Endpoint          | Description                  | Example Payload | Example Response |
|-------------|-------------------|------------------------------|-----------------|------------------|
| POST        | `/auth/login`      | Log in a user.               | `{ "email": "john@example.com", "password": "password" }` | `{ "message": "Logged in successfully", "user": "John Doe" }` |

### **Logout Endpoint**

| HTTP Method | Endpoint          | Description                  | Example Payload | Example Response |
|-------------|-------------------|------------------------------|-----------------|------------------|
| DELETE      | `/auth/logout`     | Log out a user.              | N/A             | `{ "message": "Logged out successfully" }` |


## Patients Endpoints 

### **Get a List of Doctors**

| HTTP Method | Endpoint                | Description                                       | Example Payload | Example Response                                                            |
|-------------|-------------------------|---------------------------------------------------|-----------------|----------------------------------------------------------------------------|
| GET         | `/patients/doctors`      | Get a list of all doctors and their specializations. | N/A             | `{ "message": "Doctors fetched successfully", "data": [...] }`             |

### **Get a Doctor's Schedule**

| HTTP Method | Endpoint                | Description                                      | Example Payload | Example Response                                                            |
|-------------|-------------------------|--------------------------------------------------|-----------------|----------------------------------------------------------------------------|
| GET         | `/patients/doctors/{id}` | Get a doctor's schedule by ID.                   | N/A             | `{ "message": "Doctor fetched successfully", "data": { "specializations": [...], "doctorSchedules": [...] } }` |

### **Create a New Appointment**

| HTTP Method | Endpoint                 | Description                                   | Example Payload                                                   | Example Response                                                                 |
|-------------|--------------------------|-----------------------------------------------|-------------------------------------------------------------------|---------------------------------------------------------------------------------|
| POST        | `/patients/appointments`  | Create a new appointment for the patient.      | `{ "doctor_id": 1, "date": "2024-12-25", "time": "14:00" }`       | `{ "message": "Appointment created successfully", "data": { "id": 1, "status": "PENDING" } }` |

### **Get All Appointments for the Logged-in Patient**

| HTTP Method | Endpoint                 | Description                                   | Example Payload | Example Response                                                                 |
|-------------|--------------------------|-----------------------------------------------|-----------------|---------------------------------------------------------------------------------|
| GET         | `/patients/appointments`  | Get all appointments for the logged-in patient. | N/A             | `{ "message": "Appointments fetched successfully", "data": [...] }`              |

### **Get a Specific Appointment**

| HTTP Method | Endpoint                  | Description                                   | Example Payload | Example Response                                                                 |
|-------------|---------------------------|-----------------------------------------------|-----------------|---------------------------------------------------------------------------------|
| GET         | `/patients/appointments/{id}` | Get details of a specific appointment.        | N/A             | `{ "message": "Appointment fetched successfully", "data": { "id": 1, "status": "PENDING" } }` |

### **Submit a Review for a Doctor**

| HTTP Method | Endpoint              | Description                                   | Example Payload                                                          | Example Response                                                                  |
|-------------|-----------------------|-----------------------------------------------|--------------------------------------------------------------------------|----------------------------------------------------------------------------------|
| POST        | `/patients/reviews`    | Submit a review and rating for a doctor.      | `{ "doctor_id": 1, "rating": 5, "comment": "Excellent service!" }`       | `{ "message": "Review submitted successfully", "data": { "id": 1, "rating": 5 } }` |

### **Get All Reviews for a Specific Doctor**

| HTTP Method | Endpoint                    | Description                                   | Example Payload | Example Response                                                            |
|-------------|-----------------------------|-----------------------------------------------|-----------------|----------------------------------------------------------------------------|
| GET         | `/patients/reviews/{doctor_id}` | Get all reviews for a specific doctor.        | N/A             | `{ "message": "Reviews fetched successfully", "data": [...] }`             |

### **Create a Reservation for a Doctor**

| HTTP Method | Endpoint               | Description                                    | Example Payload                                                                                               | Example Response                                                                |
|-------------|------------------------|------------------------------------------------|-------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------|
| POST        | `/patients/reservations` | Create a reservation and generate a QR code.    | `{ "id_doctor": 1, "poli": "Cardiology", "tanggal_kunjungan": "2024-12-25", "jam_kunjungan": "14:00:00" }`    | `{ "message": "Reservation created successfully", "data": { "id_reservation": 1, "qr_code_path": "..." } }` |

### **Get the Queue Details for the Logged-in Patient**

| HTTP Method | Endpoint           | Description                                   | Example Payload | Example Response                                                                |
|-------------|--------------------|-----------------------------------------------|-----------------|---------------------------------------------------------------------------------|
| GET         | `/patients/queues`  | View the queue details for the logged-in patient. | N/A             | `{ "message": "Queue details fetched successfully", "data": [...] }`             |

### **Submit Feedback for a Doctor**

| HTTP Method | Endpoint            | Description                                   | Example Payload                                                    | Example Response                                                                |
|-------------|---------------------|-----------------------------------------------|--------------------------------------------------------------------|---------------------------------------------------------------------------------|
| POST        | `/patients/feedback` | Submit feedback or complaints for a doctor.   | `{ "id_doctor": 1, "message": "Great experience!" }`               | `{ "message": "Feedback submitted successfully", "data": { "id_feedback": 1 } }` |



## Doctor Endpoints

### **Get Appointments**

| HTTP Method | Endpoint                 | Description                                  | Example Payload | Example Response                                      |
|-------------|--------------------------|----------------------------------------------|-----------------|------------------------------------------------------|
| GET         | `/doctors/appointments`  | Get all appointments for the logged-in doctor. | N/A             | `{ "message": "Consultations fetched successfully", "data": [...] }` |

### **Update Appointment Status**

| HTTP Method | Endpoint                             | Description                                     | Example Payload                                         | Example Response                                                    |
|-------------|--------------------------------------|-------------------------------------------------|---------------------------------------------------------|---------------------------------------------------------------------|
| PUT         | `/doctors/appointments/{id}/status` | Update the status of a consultation (e.g., `PENDING`, `COMPLETED`, `CANCELLED`). | `{ "status": "COMPLETED" }`                             | `{ "message": "Consultation status updated successfully", "data": {...} }` |

### **Add Schedule**

| HTTP Method | Endpoint                 | Description                                  | Example Payload                                                    | Example Response                                                    |
|-------------|--------------------------|----------------------------------------------|--------------------------------------------------------------------|--------------------------------------------------------------------|
| POST        | `/doctors/schedules`      | Add a new schedule for the logged-in doctor. | `{ "tanggal": "2024-12-25", "jam": "10:00:00", "status": "AVAILABLE" }` | `{ "message": "Schedule added successfully", "data": { ... } }` |

### **Update Schedule**

| HTTP Method | Endpoint                | Description                                  | Example Payload                                                    | Example Response                                                    |
|-------------|-------------------------|----------------------------------------------|--------------------------------------------------------------------|--------------------------------------------------------------------|
| PUT         | `/doctors/schedules/{id}`| Update an existing schedule.                | `{ "tanggal": "2024-12-26", "jam": "14:00:00", "status": "UNAVAILABLE" }` | `{ "message": "Schedule updated successfully", "data": { ... } }` |

### **Delete Schedule**

| HTTP Method | Endpoint                | Description                                  | Example Payload | Example Response                                                    |
|-------------|-------------------------|----------------------------------------------|-----------------|--------------------------------------------------------------------|
| DELETE      | `/doctors/schedules/{id}`| Delete an existing schedule.                | N/A             | `{ "message": "Schedule deleted successfully" }` |

### **View Queue**

| HTTP Method | Endpoint                 | Description                                  | Example Payload | Example Response                                      |
|-------------|--------------------------|----------------------------------------------|-----------------|------------------------------------------------------|
| GET         | `/doctors/queues`        | View all pending queues for the logged-in doctor. | N/A             | `{ "message": "Queue fetched successfully", "data": [...] }` |

### **Filter Queue**

| HTTP Method | Endpoint                        | Description                                    | Example Payload                                             | Example Response                                        |
|-------------|---------------------------------|------------------------------------------------|-------------------------------------------------------------|--------------------------------------------------------|
| GET         | `/doctors/queues/filter`       | Filter queues by visit date or time.           | `{ "tanggal_kunjungan": "2024-12-25", "jam_kunjungan": "10:00:00" }` | `{ "message": "Filtered queue fetched successfully", "data": [...] }` |

### **Update Profile**

| HTTP Method | Endpoint                 | Description                                  | Example Payload                                                    | Example Response                                                    |
|-------------|--------------------------|----------------------------------------------|--------------------------------------------------------------------|--------------------------------------------------------------------|
| PUT         | `/doctors/profile`        | Update the profile of the logged-in doctor.  | `{ "aktif_praktek": true, "lokasi_praktek": "Main Clinic", "kontak": "1234567890" }` | `{ "message": "Profile updated successfully", "data": { ... } }` |


## Admin Endpoints Summary

### **Get All Patients**

| HTTP Method | Endpoint            | Description                                      | Example Payload | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| GET         | `/admins/patients`   | Get a list of all patients.                     | N/A             | `{ "message": "Patients fetched successfully", "data": [...] }`    |

### **Get All Doctors**

| HTTP Method | Endpoint            | Description                                      | Example Payload | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| GET         | `/admins/doctors`    | Get a list of all doctors.                      | N/A             | `{ "message": "Doctors fetched successfully", "data": [...] }`     |

### **Add a New Doctor**

| HTTP Method | Endpoint            | Description                                      | Example Payload                                                                                              | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|--------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------|
| POST        | `/admins/doctors`    | Add a new doctor.                                | `{ "nama": "Dr. John", "nik": "1234567890123456", "no_telp": "08123456789", "email": "john@example.com", "password": "password" }` | `{ "message": "Doctor added successfully", "data": {...} }`         |

### **Update an Existing Doctor**

| HTTP Method | Endpoint            | Description                                      | Example Payload                                                                                              | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|--------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------|
| PUT         | `/admins/doctors/{id}`| Update details of an existing doctor.           | `{ "nama": "Dr. John Doe", "no_telp": "08123456788", "email": "john.doe@example.com" }`                       | `{ "message": "Doctor updated successfully", "data": {...} }`       |

### **Delete a Doctor**

| HTTP Method | Endpoint            | Description                                      | Example Payload | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| DELETE      | `/admins/doctors/{id}`| Delete a doctor.                                | N/A             | `{ "message": "Doctor deleted successfully" }`                      |

### **Get All Appointments**

| HTTP Method | Endpoint            | Description                                      | Example Payload | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| GET         | `/admins/appointments`| Get a list of all appointments.                 | N/A             | `{ "message": "Appointments fetched successfully", "data": [...] }` |

### **Update Appointment Status**

| HTTP Method | Endpoint                        | Description                                      | Example Payload                                         | Example Response                                                   |
|-------------|---------------------------------|--------------------------------------------------|---------------------------------------------------------|---------------------------------------------------------------------|
| PUT         | `/admins/appointments/{id}/status` | Update the status of an appointment (e.g., `PENDING`, `COMPLETED`, `CANCELLED`). | `{ "status": "COMPLETED" }`                             | `{ "message": "Appointment status updated successfully", "data": {...} }` |

### **View All Queues**

| HTTP Method | Endpoint            | Description                                      | Example Payload | Example Response                                                   |
|-------------|---------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| GET         | `/admins/queues`     | View a list of all queues (appointments).       | N/A             | `{ "message": "Queues fetched successfully", "data": [...] }`     |

### **Edit Queue**

| HTTP Method | Endpoint             | Description                                      | Example Payload                                                                                              | Example Response                                                   |
|-------------|----------------------|--------------------------------------------------|--------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------|
| PUT         | `/admins/queues/{id}` | Edit a queue (e.g., patient, doctor, status).    | `{ "id_user_patient": 1, "id_user_doctor": 2, "status": "PENDING", "tanggal_kunjungan": "2024-12-25", "jam_kunjungan": "10:00:00", "no_antrian": 1 }` | `{ "message": "Queue updated successfully", "data": {...} }`         |

### **Delete Queue**

| HTTP Method | Endpoint             | Description                                      | Example Payload | Example Response                                                   |
|-------------|----------------------|--------------------------------------------------|-----------------|---------------------------------------------------------------------|
| DELETE      | `/admins/queues/{id}` | Delete a queue.                                  | N/A             | `{ "message": "Queue deleted successfully" }`                      |

### **Add Specialization**

| HTTP Method | Endpoint                     | Description                                      | Example Payload                                                    | Example Response                                                    |
|-------------|------------------------------|--------------------------------------------------|--------------------------------------------------------------------|--------------------------------------------------------------------|
| POST        | `/admins/specializations`     | Add a new specialization for a doctor.           | `{ "id_user": 1, "specialization_name": "Cardiology" }`            | `{ "message": "Specialization added successfully", "data": {...} }` |

### **Assign Specialization to a Doctor**

| HTTP Method | Endpoint                                | Description                                     | Example Payload                                   | Example Response                                                                 |
|-------------|-----------------------------------------|-------------------------------------------------|-------------------------------------------------|---------------------------------------------------------------------------------|
| POST        | `/admins/doctors/{id}/specializations`  | Assign a specialization to a specific doctor.  | `{ "id_specialization": 1 }`                    | `{ "message": "Specialization assigned successfully", "data": { "id_user": 1, "id_specialization": 1 } }`             |

### **Filter Doctors by Specialization**

| HTTP Method | Endpoint                                | Description                                     | Example Payload | Example Response                                                                 |
|-------------|-----------------------------------------|-------------------------------------------------|-----------------|---------------------------------------------------------------------------------|
| GET         | `/admins/doctors/specializations/{id}`  | Get a list of doctors filtered by specialization. | N/A             | `{ "message": "Doctors fetched successfully", "data": [ { "id_user": 1, "nama": "Dr. John", "email": "john@example.com", "specialization_name": "Cardiology" } ] }` |

## Forgot Password Endpoints 

### **Send Reset Link Email**

| HTTP Method | Endpoint             | Description                                  | Example Payload                                           | Example Response                                                            |
|-------------|----------------------|----------------------------------------------|-----------------------------------------------------------|------------------------------------------------------------------------------|
| POST        | `/forgot-password`    | Send a reset password link to the user's email. | `{ "email": "user@example.com" }`                          | `{ "message": "Reset link sent successfully" }`                              |

### **Reset Password**

| HTTP Method | Endpoint             | Description                                  | Example Payload                                                                 | Example Response                                                    |
|-------------|----------------------|----------------------------------------------|---------------------------------------------------------------------------------|---------------------------------------------------------------------|
| POST        | `/reset-password`     | Reset the user's password using the reset token. | `{ "token": "reset-token", "email": "user@example.com", "password": "newpassword", "password_confirmation": "newpassword" }` | `{ "message": "Password reset successfully" }`                        |
