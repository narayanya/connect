@extends('layouts.app')

@push('breadcrumb')
    <li class="breadcrumb-item active">Vendor</li>
@endpush

@push('page-title')
    Vendor
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteLinks = document.querySelectorAll('.js-ak-delete-link');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="ri-delete-bin-line"></i> Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = this.getAttribute('data-link') || '#';
                            form.innerHTML = `
                                @csrf
                                @method('DELETE')
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Vendor List</h4>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" role="search" style="margin-bottom:0px;">
                        <input type="hidden" name="vendor_source" value="vendor">
                        <input type="hidden" name="vendor_length" value="{{ Request()->query('vendor_length') }}">
                        <div class="input-group">
                            <input type="text" class="form-control search-form" name="vendor_search" placeholder="Search" value="{{ Request()->query('vendor_source') == 'vendor' ? Request()->query('vendor_search') ?? '' : '' }}" autocomplete="off">
                            <button class="btn btn-outline-primary" type="submit" style="padding: 4px 10px;">
                                <i class="ri-search-line"></i>
                            </button>
                            @if(Request()->query('vendor_source') == 'vendor' && Request()->query('vendor_search'))
                                <button class="btn btn-outline-secondary js-ak-reset-search" type="button">
                                    <i class="ri-close-line"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                    @can('add-Vendor')
                        <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line"></i> Add New
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered js-ak-content">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                   <th>Email</th>   <th>Company Name</th>   <th>Nauture Of Business</th>   <th>Purpose Of Transaction with company</th>   <th>Company's Address</th>   <th>Pincode</th>   <th>Vendor Email Id</th>   <th>Contact Person Name</th>   <th>Contact No.</th>   <th>Contact Person Name</th>   <th>Payment Terms</th>   <th>Gender</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendor_list as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->email }}</td>
<td>{{ $data->company_name }}</td>
<td>{{ $data->businessnature->nature ?? "" }}</td>
<td>{{ $data->purpose_of_transaction_with_company }}</td>
<td>{{ $data->companys_address }}</td>
<td>{{ $data->pincode }}</td>
<td>{{ $data->vendor_email_id }}</td>
<td>{{ $data->contact_person_name }}</td>
<td>{{ $data->contact_no }}</td>
<td>{{ $data->contact_person_name }}</td>
<td>{{ $data->payment_terms }}</td>
<td>{{ $data->gender->gender ?? "" }}</td>

                                    <td class="text-center">
                                        @can('edit-Vendor')
                                            <a style="padding:1px 5px;" href="{{ route('vendor.edit', $data->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                        @endcan
                                        @can('delete-Vendor')
                                            <a style="padding:1px 5px;" href="javascript:void(0)" data-link="{{ route('vendor.destroy', $data->id) }}" class="btn btn-sm btn-outline-danger js-ak-delete-link">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <select class="form-select js-ak-table-length-DataTable" style="width: auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0 js-ak-pagination-box">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection