<!-- resources/views/applications/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">My Applications</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">My Applications List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Applications</h5>
                    @if(auth()->user()->emp_id)
                    <a title="Add New Application" href="{{ route('applications.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i>Add New Application
                    </a>
                    @endif
                </div>

                <div class="card-body">
                    @if($applications->isEmpty())
                        <div class="alert alert-info">You haven't submitted any applications yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>App ID</th>
                                        <th>Distributor Name</th>
                                        <th>Territory</th>
                                        <th>Status</th>
                                        <th>Submitted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                    <tr>
                                        <td>{{ $application->application_code }}</td>
                                        <td>{{ $application->establishment_name ?? 'N/A' }}</td>
                                        <td>{{ $application->territory }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->status_badge }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $application->created_at->format('d-M-Y') }}</td>
                                        <td>
                                            <a href="{{ route('applications.show', $application) }}" class="btn btn-sm btn-info">
                                                <i class="bx bx-show fs-14"></i>
                                            </a>
                                            @if(in_array($application->status, ['draft', 'reverted']))
                                            <a href="{{ route('applications.edit', $application) }}" class="btn btn-sm btn-info edit-user">
                                                <i class="bx bx-pencil fs-14"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $applications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection