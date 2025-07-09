@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Varieties</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Master</a></li>
                        <li class="breadcrumb-item active">Variety List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Variety List</h5>
                    <div>
                        <button title="Filters" type="button" class="btn btn-info btn-sm" data-bs-toggle="offcanvas" href="#FilterCanvas">
                            <i class="ri-filter-3-line align-middle me-1"></i> Filters
                        </button>
                        <a title="Export Excel" href="{{ route('varieties.export') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="variety-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Crop Name</th>
                                    <th>Variety Name</th>
                                    <th>Variety Code</th>
                                    <th>Numeric Code</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody> <!-- AJAX data -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="FilterCanvas" aria-labelledby="FilterCanvasLabel">
        <div class="offcanvas-header bg-light">
            <h5 class="offcanvas-title" id="FilterCanvasLabel">Variety Filters</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form id="filter-form" class="d-flex flex-column justify-content-end h-100">
            <div class="offcanvas-body">
                <div class="col-lg-12">
                    <label for="status_filter" class="form-label">Status:</label>
                    <select name="status" id="status_filter" class="form-control form-select" onchange="filter_data();">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-3">
                    <label for="crop_filter" class="form-label">Crop:</label>
                    <select name="crop_id" id="crop_filter" class="form-control form-select" onchange="filter_data();">
                        <option value="">Select Crop</option>
                        @foreach ($crops as $crop)
                        <option value="{{ $crop->id }}">{{ $crop->crop_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12 mt-3">
                    <label for="category_filter" class="form-label">Category:</label>
                    <select name="category_id" id="category_filter" class="form-control form-select" onchange="filter_data();">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="offcanvas-footer border-top p-3 text-center">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary w-100" id="apply-btn">Apply Filters</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-light w-100" id="reset-btn">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection



@push('scripts')
<script>
    function filter_data() {
        $('#variety-table').DataTable().ajax.reload();
    }

    $(document).ready(function() {
        // Initialize DataTable
        const table = $('#variety-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            destroy: true,
            ajax: {
                url: "{{ route('varieties.getVarietyList') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function(d) {
                    d.status = $('#status_filter').val();
                    d.crop_id = $('#crop_filter').val();
                    d.category_id = $('#category_filter').val();
                },
                error: function(xhr, error, thrown) {
                    if (xhr.status === 419) {
                        alert('Session expired or CSRF token mismatch. Please refresh the page.');
                        window.location.reload();
                    } else {
                        console.error('DataTable error:', error, thrown);
                    }
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'crop_name',
                    name: 'core_crop.crop_name'
                },
                {
                    data: 'variety_name',
                    name: 'variety_name'
                },
                {
                    data: 'variety_code',
                    name: 'variety_code'
                },
                {
                    data: 'numeric_code',
                    name: 'numeric_code'
                },
                {
                    data: 'category_name',
                    name: 'core_category.category_name'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    render: function(data) {
                        let badgeClass = data === 'Active' ? 'success' : 'danger';
                        return `<span class="badge bg-${badgeClass}">${data}</span>`;
                    }
                }
            ]
        });

        // Apply filters on button click
        $('#apply-btn').on('click', function() {
            filter_data();
            $('#FilterCanvas').offcanvas('hide');
        });

        // Reset filters
        $('#reset-btn').on('click', function() {
            $('#status_filter, #crop_filter, #category_filter').val('');
            filter_data();
            $('#FilterCanvas').offcanvas('hide');
        });
    });
</script>
@endpush