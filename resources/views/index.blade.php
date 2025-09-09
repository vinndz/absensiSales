@extends('layouts.app') <!-- Menggunakan layout 'app.blade.php' -->

@section('content')

    <style>
        .emp-details dt,
        .emp-details dd {
        padding: 10px 0;
        margin-left: 0;
        }

        .emp-details dd {
        border-bottom: 1px solid #ddd;
        color: #34495e;
        }

        .emp-details dd:last-of-type {
        border-bottom: none;
        }

        .emp-details dt {
        font-weight: 700;
        color: #2c3e50;
        }
    </style>
    <!-- Quick Actions Section -->
    <div class="container mb-5">
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-5">
                <h5 class="card-title text-muted mb-3">Quick Actions</h5>
                <p class="text-muted mb-4">Aksi Lebih Cepat</p>

                <div class="d-flex justify-content-start gap-3">
                    <button id="btnCheckIn" class="btn btn-outline-success btn-lg shadow-sm px-4 py-2 rounded-pill transition-all duration-300 hover:shadow-lg hover:bg-primary">Check In</button>
                    <button id="btnCheckOut" class="btn btn-outline-danger btn-lg shadow-sm px-4 py-2 rounded-pill transition-all duration-300 hover:shadow-lg hover:bg-secondary">Check Out</button>
                    <!-- <button class="btn btn-outline-primary btn-lg shadow-sm px-4 py-2 rounded-pill transition-all duration-300 hover:shadow-lg hover:bg-success" onclick="window.location.href='{{ route('employee-data') }}'">Employee Data</button> -->
                    <!-- <button class="btn btn-outline-warning btn-lg shadow-sm px-4 py-2 rounded-pill transition-all duration-300 hover:shadow-lg hover:bg-success">Employee Schedule</button> -->
                </div>
            </div>
             <!-- Input dan Submit -->
            <form id="manualForm" class="row g-2 align-items-center">
                @csrf
                <div class="col-md-6" style="margin-left: 40px; margin-bottom: 40px;">
                    <input type="text" class="form-control" id="manPowerInput" name="manPowerInput" placeholder="Type Man Power">
                </div>
                <div class="col-auto" style="margin-bottom: 40px; margin-left: -10px;">
                    <button type="button" id="submitManPowerBtn" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <input type="text" id="barcodeInput" class="form-control d-none" autofocus>
        </div>
    </div>

    <!-- Modal Check Data-->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="empImage" src="storage/images/defaultImage.png" class="img-fluid rounded mb-3" style="width: 300px; height: 350px" />\
                    <dl class="row emp-details">
                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8" id="empName"></dd>

                        <dt class="col-sm-4">Man Power ID:</dt>
                        <dd class="col-sm-8" id="empManpower"></dd>

                        <dt class="col-sm-4">Dealer:</dt>
                        <dd class="col-sm-8" id="empDealer"></dd>

                        <dt class="col-sm-4">Dealer Group Name:</dt>
                        <dd class="col-sm-8" id="empDealerGroupName"></dd>
                    </dl>

                    <form id="checkinForm">
                    @csrf
                        <input type="hidden" name="employeeId" id="modalEmployeeId">
                        <button type="submit" class="btn btn-success">Check In</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Check Out Verification -->
    <div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- modal-dialog-centered biar modal di tengah -->
            <div class="modal-content">
            <form id="checkOutForm">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="checkOutModalLabel">Verifikasi Check Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex gap-3 align-items-center">
                <img id="verifyEmpImage" src="" alt="Employee Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"/>
                <div>
                    <p><strong>Name:</strong> <span id="verifyEmpName"></span></p>
                    <p><strong>Man Power ID:</strong> <span id="verifyEmpManPowerId"></span></p>
                    <p><strong>Dealer:</strong> <span id="verifyEmpDealer"></span></p>
                    <p><strong>Dealer Group:</strong> <span id="verifyEmpDealerGroup"></span></p>
                </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" id="verifyEmpIdHidden" name="id" />
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Konfirmasi Check Out</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <!-- Dealer Status Section -->
    <div class="row">
        @foreach($dealers as $dealer)
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title">{{ $dealer['name'] }}</h5>
                        <p class="card-text text-muted">Kode: {{ $dealer['code'] }}</p>
                        <p class="card-text">Check-in Status: <strong>{{ $dealer['checkins'] }}/4</strong></p>
                        <p class="card-text">Last Checked-in: <strong>{{ $dealer['lastCheckedIn'] }}</strong></p>
                        <span class="badge 
                            {{ $dealer['status'] == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($dealer['status']) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Attendance List Table -->
    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">List Attendance Sales Man</h6>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Man Power Id</th>
                                    <th>Sales Name</th>
                                    <th>Dealer Code</th>
                                    <th>Dealer Name</th>
                                    <th>Dealer Group Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan ditampilkan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            // ✅ Inisialisasi DataTable
            $('#table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/data-attendance',
                    type: 'GET',
                    dataSrc: 'data'
                },
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return `<button class="btn btn-primary">Detail</button>`;
                        }
                    },
                    { data: 'manPowerId' },
                    { data: 'manPowerName' },
                    { data: 'dealerCode' },
                    { data: 'dealerName' },
                    { data: 'dealerGroupName' },
                    { data: 'checkIn' },
                    { data: 'checkOut' }
                ]
            });

            $('#btnCheckIn').on('click', function () {
                $(this).addClass('active');
                $('#btnCheckOut').removeClass('active');
                
                // ✅ Saat tombol submit ditekan
                $('#submitManPowerBtn').on('click', function () {
                    const manPowerId = $('#manPowerInput').val().trim();
                    const baseImageUrl = '/storage/'; 
                    if (!manPowerId) return alert('Man Power ID wajib diisi.');

                    fetch(`/employee/${manPowerId}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                                return;
                            }

                            $('#empName').text(data.manPowerName);
                            $('#empManpower').text(data.manPowerId);
                            $('#empDealer').text(data.dealerName);
                            $('#empDealerGroupName').text(data.dealerGroupName);
                            let imageUrl = data.image ? baseImageUrl + data.image : '/defaultImage.png';
                            $('#empImage').attr('src', imageUrl);

                            $('#modalEmployeeId').val(data.id);
                            console.log("Emp ID Hidden Value: ", $('#modalEmployeeId').val());

                            const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
                            modal.show();
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Terjadi kesalahan saat mengambil data.');
                        });
                });

                // ✅ Proses form check-in
                $('#checkinForm').on('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch("{{ route('attendance.checkin') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Check-in berhasil!');
                            $('#table').DataTable().ajax.reload(null, false); // false = tetap di halaman sekarang

                            // Tutup modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('employeeModal'));
                            modal.hide();
                            bootstrap.Modal.getInstance(document.getElementById('employeeModal')).hide();
                            $('#manPowerInput').val('');
                        } else {
                            alert('Gagal check-in.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi kesalahan saat check-in.');
                    });
                });
            });


            $('#btnCheckOut').on('click', function () {
                $(this).addClass('active');
                $('#btnCheckIn').removeClass('active');

                // Ambil data dari elemen DOM
                const empName = $('#empName').text();
                const empManPowerId = $('#empManpower').text();
                const empDealer = $('#empDealer').text();
                const empDealerGroup = $('#empDealerGroupName').text();
                const empImageSrc = $('#empImage').attr('src'); // pastikan ada <img id="empImage" />

                // Tentukan baseImageUrl kalau pakai relative path, kalau sudah full url bisa pakai langsung
                const baseImageUrl = '/storage/images/'; // atau sesuaikan sesuai path sebenarnya

                // Tentukan imageUrl dengan pengecekan
                let imageUrl = empImageSrc ? empImageSrc : '/defaultImage.png';

                // Isi modal dengan data yang sudah diambil
                $('#verifyEmpName').text(empName);
                $('#verifyEmpManPowerId').text(empManPowerId);
                $('#verifyEmpDealer').text(empDealer);
                $('#verifyEmpDealerGroup').text(empDealerGroup);
                $('#verifyEmpImage').attr('src', imageUrl);

                // Ambil ID yang disimpan sebelumnya di sessionStorage
                const employeeId = sessionStorage.getItem('employeeId'); // Ambil ID dari sessionStorage
                $('#verifyEmpIdHidden').val(employeeId);  // Mengisi hidden input dengan ID pegawai untuk checkout

                // Log untuk memastikan ID di-set dengan benar
                console.log("Employee ID for Check Out: ", employeeId);

                // Tampilkan modal verifikasi check-out
                const checkOutModal = new bootstrap.Modal(document.getElementById('checkOutModal'));
                checkOutModal.show();
            });

            // Pengiriman form checkout
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#checkOutForm').on('submit', function (e) {
                e.preventDefault();

                const employeeId = $('#verifyEmpIdHidden').val();  // Mengambil ID dari hidden input

                // Log untuk memeriksa apakah ID kosong
                console.log("Employee ID sebelum submit:", employeeId);

                fetch('/check-out', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id: employeeId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Check Out berhasil!');
                        $('#attendanceTable').DataTable().ajax.reload(null, false);  // Reload tabel

                        // Tutup modal verifikasi Check Out
                        const checkOutModal = bootstrap.Modal.getInstance(document.getElementById('checkOutModal'));
                        checkOutModal.hide();

                        // Reset tombol aktif
                        $('#btnCheckOut').removeClass('active');
                        $('#btnCheckIn').removeClass('active');
                    } else {
                        alert(data.message || 'Check Out gagal.');
                    }
                })
            });

        });
    </script>

@endpush

