@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Companies</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                        <li class="breadcrumb-item active">Company List</li>
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
                    <h5 class="card-title mb-0">Company List</h5>
                    <div>
                        <a title="Export Excel" href="{{ route('companies.export') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0" id="companies-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Company Code</th>
                                    <th>Reg. No.</th>
                                    <th>TIN No.</th>
                                    <th>GST No.</th>
                                    <th>Entity Type</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->company_name }}</td>
                                    <td>{{ $company->company_code }}</td>
                                    <td>{{ $company->registration_number }}</td>
                                    <td>{{ $company->tin_number }}</td>
                                    <td>{{ $company->gst_number }}</td>
                                    <td>{{ $company->legal_entity_type }}</td>
                                    <td>
                                        @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank" class="text-primary">
                                            {{ Str::limit($company->website, 20) }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($company->email)
                                        <a href="mailto:{{ $company->email }}" class="text-primary">
                                            {{ $company->email }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ $company->groups_of_company }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $companies->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

