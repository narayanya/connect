@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Organization Functions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                        <li class="breadcrumb-item active">Function List</li>
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
                    <h5 class="card-title mb-0">Function List</h5>
                    <div>
                        <a title="Export Excel" href="{{ route('org-functions.export') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="org-functions-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Function Name</th>
                                    <th>Function Code</th>
                                    <th>Effective Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($functions as $function)
                                <tr>
                                    <td>{{ $function->id }}</td>
                                    <td>{{ $function->function_name }}</td>
                                    <td>{{ $function->function_code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($function->effective_date)->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $function->is_active ? 'success' : 'danger' }}">
                                            {{ $function->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $functions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

