<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sales Attendance System</title>
    @notifyCss
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
        /* Gunakan Flexbox untuk menata layout halaman */
        html, body {
            height: 100%;
            margin: 0;
        }

        .content-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1; /* Memastikan konten utama mengambil ruang yang tersedia */
        }
    </style>
</head>
<body class="bg-light">

    <div class="content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="/">
                    <span class="h4 text-primary">Sales Attendance System</span>
                    <div class="text-muted">Monitoring absensi sales real-time</div>
                </a>
                <div class="d-flex">
                    <button class="btn btn-outline-primary me-2" onclick="window.location.href='{{ route('employee-data') }}'">Employee Data</button>
                    <button class="btn btn-outline-secondary">Schedule Employee</button>
                </div>
            </div>
            
        </nav>

        <!-- Main Content -->
        <div class="container mt-5 main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="bg-white py-4 mt-5 shadow-sm">
            <div class="container text-center">
                <p class="text-muted mb-0">Sales Attendance System &copy; 2025</p>
            </div>
        </footer>
    </div>
    

    @stack('scripts')
    <x-notify::notify />
    @notifyJs

     @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    
</body>
</html>
