@extends('layouts.app')

@section('content')
    <h2>Employee Data</h2>
    <div class="container">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputModal">
                Add Employee Data
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
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
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLabel">Input</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="employeeForm" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="manPowerId" class="col-form-label">Man Power Id</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="manPowerId" name="manPowerId">
                                @error('manPowerId') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="manPowerName" class="col-form-label">Sales Name</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="manPowerName" name="manPowerName">
                                @error('manPowerName') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="dealerCode" class="col-form-label">Dealer Code</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="dealerCode" name="dealerCode">
                                @error('dealerCode') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="dealerName" class="col-form-label">Dealer Name</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="dealerName" name="dealerName">
                                @error('dealerName') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="dealerGroupName" class="col-form-label">Group Name</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="dealerGroupName" name="dealerGroupName">
                                @error('dealerGroupName') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" class="form-control" id="image" required>
                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                   
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
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
        $(document).ready(function() {
            // Initialize DataTable after all scripts are loaded
            $('#table').DataTable({
                processing: true,
                serverSide: false, 
                ajax: {
                    url: '/data-table',
                    type: 'GET',
                    dataSrc: 'data' // Ensure 'data' is the correct key from the server response
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
                ]
            });
        });
    </script>
@endpush


