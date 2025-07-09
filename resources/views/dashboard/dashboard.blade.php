@extends('layouts.app')

@push('styles')
<style>
    /* Status badge colors */
    .badge {
        &.bg-approved { background-color: #28a745; }
        &.bg-rejected { background-color: #dc3545; }
        &.bg-pending { background-color: #ffc107; color: #212529; }
        &.bg-reverted { background-color: #fd7e14; }
        &.bg-on_hold { background-color: #17a2b8; }
        &.bg-submitted { background-color: #007bff; }
    }

    /* Application status cards */
    .status-card {
        border-left: 4px solid;
        &.approved { border-left-color: #28a745; }
        &.rejected { border-left-color: #dc3545; }
        &.pending { border-left-color: #ffc107; }
        &.reverted { border-left-color: #fd7e14; }
        &.on_hold { border-left-color: #17a2b8; }
    }

    /* Action buttons */
    .action-btns .btn {
        margin-right: 5px;
        margin-bottom: 5px;
    }

    /* Table improvements */
    .table-responsive {
        overflow-x: auto;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }

    /* Action summary table */
    .action-summary-table th, .action-summary-table td {
        text-align: center;
    }

    /* Pagination */
    .pagination {
        margin-top: 20px;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="page-title mb-sm-0">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="row mb-2">
        <div class="row mb-1 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Welcome, {{ Auth::user()->name }}!</h4>
                        <p class="text-muted mb-0">Your Role: {{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
                    </div>
                    <div class="mt-3 mt-lg-0">
                        <form action="javascript:void(0);">
                            <div class="row g-3 mb-0 align-items-center">
                                <div class="col-sm-auto">
                                    {{ \Carbon\Carbon::now()->format('l, d M Y') }}
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    @if(isset($pendingApplications) && $pendingApplications->isNotEmpty())
                                        <span class="badge bg-danger rounded-pill">
                                            {{ $pendingApplications->total() }} Pending
                                        </span>
                                    @else
                                        <span class="badge bg-success rounded-pill">
                                            No Pending
                                        </span>
                                    @endif
                                </div>
                                <!--end col-->
                                
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>
        
    </div>

    <!-- Action Summary Section -->
    @if(isset($actionSummary) && $actionSummary->isNotEmpty())
        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="header-title">User Action Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-centered action-summary-table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th>Approved</th>
                                        <th>Rejected</th>
                                        <th>Reverted</th>
                                        <th>On Hold</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($actionSummary as $summary)
                                        <tr>
                                            <td>{{ $summary['user_name'] }}</td>
                                            <td>{{ $summary['actions']['approve'] ?? 0 }}</td>
                                            <td>{{ $summary['actions']['reject'] ?? 0 }}</td>
                                            <td>{{ $summary['actions']['revert'] ?? 0 }}</td>
                                            <td>{{ $summary['actions']['on_hold'] ?? 0 }}</td>
                                            <td>{{ array_sum($summary['actions']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Approval Dashboard Section -->
    @if((isset($pendingApplications) && !empty($pendingApplications)) || (isset($myApplications) && !empty($myApplications)))
        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="header-title">Approval Dashboard</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item" href="#" data-filter="all">All Applications</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="pending">Pending Approval</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="my">My Applications</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-custom mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#pending-tab">
                                    Pending Approvals ({{ $pendingApplications->total() ?? 0 }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#my-tab">
                                    My Applications ({{ $myApplications->total() ?? 0 }})
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <!-- Pending Approvals Tab -->
                            <div class="tab-pane fade show active" id="pending-tab">
                                @if(!isset($pendingApplications) || $pendingApplications->isEmpty())
                                    <div class="alert alert-info">No applications pending your approval.</div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Application ID</th>
                                                    <th>Territory</th>
                                                    <th>Region</th>
                                                    <th>Status</th>
                                                    <th>Submitted On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingApplications as $application)
                                                <tr class="status-card {{ $application->status }}">
                                                    <td>{{ $application->application_code ?? 'N/A' }}</td>
                                                    <td>{{ $application->territoryDetail->territory_name ?? 'N/A' }}</td>
                                                    <td>{{ $application->regionDetail->region_name ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $application->status_badge }}">
                                                            {{ ucfirst($application->status) }}
                                                        </span>
                                                        @if($application->status === 'on_hold' && $application->follow_up_date)
                                                            <small class="d-block text-muted">
                                                                Until: {{ $application->follow_up_date->format('d M Y') }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $application->created_at->format('d M Y H:i') }}</td>
                                                    <td class="action-btns">
                                                        <a href="{{ route('approvals.show', $application) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Review
                                                        </a>
                                                        @if($application->status === 'on_hold')
                                                            <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="On Hold">
                                                                <i class="fas fa-pause"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $pendingApplications->links() }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- My Applications Tab -->
                            <div class="tab-pane fade" id="my-tab">
                                @if(!isset($myApplications) || $myApplications->isEmpty())
                                    <div class="alert alert-info">You haven't submitted or acted on any applications yet.</div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Application ID</th>
                                                    <th>Territory</th>
                                                    <th>Status</th>
                                                    <th>Current Approver</th>
                                                    <th>Last Action</th>
                                                    <th>Remarks</th>
                                                    <th>Last Updated</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($myApplications as $application)
                                                <tr class="status-card {{ $application->status }}">
                                                    <td>{{ $application->application_code ?? 'N/A' }}</td>
                                                    <td>{{ $application->territoryDetail->territory_name ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $application->status_badge }}">
                                                            {{ ucfirst($application->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($application->current_approver_id)
                                                            {{-- $application->currentApprover->name --}}
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($application->approvalLogs->isNotEmpty())
                                                            {{ ucfirst($application->approvalLogs->first()->action) }} by 
                                                            {{ $application->approvalLogs->first()->user->name ?? 'Unknown' }}
                                                            on {{ $application->approvalLogs->first()->created_at->format('d M Y H:i') }}
                                                        @else
                                                            <span class="text-muted">No actions</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($application->approvalLogs->isNotEmpty())
                                                            {{ $application->approvalLogs->first()->remarks ?? 'No remarks' }}
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $application->updated_at->format('d M Y H:i') }}</td>
                                                    <td class="action-btns">
                                                        <div class="d-flex flex-wrap">
                                                            <a href="{{ route('approvals.show', $application) }}" class="btn btn-sm btn-primary me-1 mb-1">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            @if($application->status === 'reverted' && $application->created_by === Auth::user()->emp_id)
                                                                <a href="{{ route('applications.edit', $application) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                            @endif
                                                            @if($application->status === 'approved')
                                                                <span class="badge bg-success p-2 me-1 mb-1">
                                                                    <i class="fas fa-check-circle"></i> Approved
                                                                </span>
                                                            @endif
                                                            @if($application->status === 'rejected')
                                                                <button class="btn btn-sm btn-outline-danger me-1 mb-1" disabled>
                                                                    <i class="fas fa-times-circle"></i> Rejected
                                                                </button>
                                                            @endif
                                                            @if($application->status === 'on_hold')
                                                                <button class="btn btn-sm btn-info me-1 mb-1" disabled>
                                                                    <i class="fas fa-pause-circle"></i> On Hold
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $myApplications->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Status Summary Cards -->
    @if(isset($myApplications) && $myApplications->isNotEmpty())
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Applications</h5>
                        <h2 class="mb-0">{{ $myApplications->total() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Approved</h5>
                        <h2 class="mb-0">{{ $myApplications->where('status', 'approved')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <h2 class="mb-0">{{ $myApplications->where('status', 'submitted')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Rejected</h5>
                        <h2 class="mb-0">{{ $myApplications->where('status', 'rejected')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Filter functionality
        $('[data-filter]').click(function(e) {
            e.preventDefault();
            const filter = $(this).data('filter');
            
            if (filter === 'pending') {
                $('.nav-tabs a[href="#pending-tab"]').tab('show');
            } else if (filter === 'my') {
                $('.nav-tabs a[href="#my-tab"]').tab('show');
            }
        });
        
        // Function to update counts
        function updateStatusCounts() {
            $.ajax({
                url: '{{ route("dashboard.status-counts") }}',
                type: 'GET',
                success: function(data) {
                    $('.nav-tabs a[href="#pending-tab"]').text(`Pending Approvals (${data.pending})`);
                    $('.nav-tabs a[href="#my-tab"]').text(`My Applications (${data.my})`);
                    $('.badge.bg-danger.rounded-pill').text(`${data.pending} Pending`);
                    if (data.pending === 0) {
                        $('.badge.bg-danger.rounded-pill').removeClass('bg-danger').addClass('bg-success').text('No Pending');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching status counts:', xhr.responseText);
                }
            });
        }
        
        // Initial load
        updateStatusCounts();
        
        // Refresh badge counts every 60 seconds
        setInterval(updateStatusCounts, 60000);
    });
</script>
@endpush