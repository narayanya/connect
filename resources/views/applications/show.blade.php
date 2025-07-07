@extends('layouts.app')

@push('styles')
<style>
    .form-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .form-control[readonly],
    select[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .document-link a {
        color: #007bff;
        text-decoration: none;
    }

    .document-link a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container ">
    <h4 class="mb-4">Distributor Application - View (Application ID: {{ $application->application_code }})</h4>
    <div class="card">
        <div class="card-body">
            <!-- Application Status -->
            
<div class="row">
    <div class="mb-2">
        <h6>Application Status: <span class="badge bg-{{ $application->status_badge }}">{{ ucfirst($application->status) }}</span></h6>
        <p>
            <span class="float-start"><strong>Submitted On:</strong> {{ $application->created_at->format('d-M-Y H:i') }}</span> 
            <span class="float-end"><strong>Last Updated:</strong> {{ $application->updated_at->format('d-M-Y H:i') }}</span>
        </p>
    </div>
    <div id="basic-details" class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Basic Details
            </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Territory:</label>
                    <span>{{ $application->territory ? DB::table('core_territory')->where('id', $application->territory)->value('territory_name') : 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Region:</label>
                    <span>{{ $application->region ? DB::table('core_region')->where('id', $application->region)->value('region_name') : 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Zone:</label>
                    <span>{{ $application->zone ? DB::table('core_zone')->where('id', $application->zone)->value('zone_name') : 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Business Unit:</label>
                    <span>{{ $application->business_unit ? DB::table('core_business_unit')->where('id', $application->business_unit)->value('business_unit_name') : 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Crop Vertical:</label>
                    <span>{{ isset($application->crop_vertical) && $application->crop_vertical === '1' ? 'Field Crop' : 'Veg Crop' }}</span>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">State:</label>
                    <span>{{ $application->state ? DB::table('core_state')->where('id', $application->state)->value('state_name') : 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">District:</label>
                    <span>{{ $application->district ? DB::table('core_district')->where('id', $application->district)->value('district_name') : 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>

            <!-- Step 2: Entity Details -->
            <div id="entity-details" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Entity Details
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Type of Firm:</label>
                            <span>{{ $application->entityDetails->entity_type ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Firm Name:</label>
                            <span>{{ $application->entityDetails->establishment_name ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Business Address:</label>
                            <span>{{ $application->entityDetails->business_address ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">House No.:</label>
                            <span>{{ $application->entityDetails->house_no ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Landmark:</label>
                            <span>{{ $application->entityDetails->landmark ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">City:</label>
                            <span>{{ $application->entityDetails->city ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Pincode:</label>
                            <span>{{ $application->entityDetails->pincode ?? 'N/A' }}</span>
                        </div>
                    </div>
               
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">State:</label>
                            <span>{{ $application->entityDetails->state_id ? DB::table('core_state')->where('id', $application->entityDetails->state_id)->value('state_name') : 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">District:</label>
                            <span>{{ $application->entityDetails->district_id ? DB::table('core_district')->where('id', $application->entityDetails->district_id)->value('district_name') : 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Country:</label>
                            <span>{{ $application->entityDetails->country_id ? DB::table('core_country')->where('id', $application->entityDetails->country_id)->value('country_name') : 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Mobile No.:</label>
                            <span>{{ $application->entityDetails->mobile ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Email ID:</label>
                            <span>{{ $application->entityDetails->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">PAN Number:</label>
                            <span>{{ $application->entityDetails->pan_number ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">GST Applicable:</label>
                            <span>{{ $application->entityDetails->gst_applicable ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">GST Number:</label>
                            <span>{{ $application->entityDetails->gst_number ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Seed License:</label>
                            <span>{{ $application->entityDetails->seed_license ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">TAN Number:</label>
                            <span>{{ $application->entityDetails->additional_data['tan_number'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                </div>
                </div>

                <!-- Documents -->
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Documents
                </div>
                <div class="card-body">
                @php
                    $documents = [];
                    if (!empty($application->entityDetails->documents_data)) {
                        $raw = $application->entityDetails->documents_data;
                        if (is_string($raw)) {
                            $decoded = json_decode($raw, true);
                            $documents = is_array($decoded) ? $decoded : [];
                        } elseif (is_array($raw)) {
                            $documents = $raw;
                        }
                    }
                @endphp
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Details</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Verified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $doc)
                        <tr>
                            <td>{{ ucfirst($doc['type'] ?? 'N/A') }}</td>
                            <td>
                                @if(is_array($doc['details'] ?? []))
                                @foreach($doc['details'] as $key => $value)
                                {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}<br>
                                @endforeach
                                @else
                                {{ $doc['details'] ?? 'N/A' }}
                                @endif
                            </td>
                            <td class="document-link">
                                <a href="{{ Storage::url($doc['path'] ?? '') }}" target="_blank">{{ $doc['path'] ? 'View Document' : 'N/A' }}</a>
                            </td>
                            <td>{{ $doc['status'] ?? 'Pending' }}</td>
                            <td>{{ isset($doc['verified']) && $doc['verified'] ? 'Yes' : 'No' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
                <!-- Entity-Specific Details -->
                @if($application->entityDetails->entity_type === 'sole_proprietorship')
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Proprietor Details
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Name:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['name'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Date of Birth:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['dob'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Father's Name:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['father_name'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Address:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['address'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Pincode:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['pincode'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Country:</label>
                            <span>{{ $application->entityDetails->additional_data['proprietor']['country'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                @elseif(in_array($application->entityDetails->entity_type, ['partnership', 'llp', 'private_company', 'public_company', 'cooperative_society', 'trust']))
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    {{ ucfirst(str_replace('_', ' ', $application->entityDetails->entity_type)) }} Details
                </div>
                <div class="card-body">
                @if(in_array($application->entityDetails->entity_type, ['llp', 'private_company', 'public_company', 'cooperative_society', 'trust']))
                <div class="row">
                    @if($application->entityDetails->entity_type === 'llp')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">LLPIN Number</label>
                            <span>{{ $application->entityDetails->additional_data['llp']['llpin_number'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Incorporation Date</label>
                            <span>{{ $application->entityDetails->additional_data['llp']['incorporation_date'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @elseif(in_array($application->entityDetails->entity_type, ['private_company', 'public_company']))
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">CIN Number</label>
                            <span>{{ $application->entityDetails->additional_data['company']['cin_number'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Incorporation Date</label>
                            <span>{{ $application->entityDetails->additional_data['company']['incorporation_date'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @elseif($application->entityDetails->entity_type === 'cooperative_society')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Registration Number</label>
                            <span>{{ $application->entityDetails->additional_data['cooperative']['reg_number'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Registration Date</label>
                            <span>{{ $application->entityDetails->additional_data['cooperative']['reg_date'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @elseif($application->entityDetails->entity_type === 'trust')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Registration Number</label>
                            <span>{{ $application->entityDetails->additional_data['trust']['reg_number'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Registration Date</label>
                            <span>{{ $application->entityDetails->additional_data['trust']['reg_date'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @endif
                </div>
                </div>
                </div>
                @endif
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    {{ $application->entityDetails->entity_type === 'partnership' ? 'Partners' : ($application->entityDetails->entity_type === 'llp' ? 'Designated Partners' : ($application->entityDetails->entity_type === 'cooperative_society' ? 'Committee Members' : ($application->entityDetails->entity_type === 'trust' ? 'Trustees' : 'Directors'))) }}
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            @if($application->entityDetails->entity_type === 'partnership')
                            <th>Father's Name</th>
                            @elseif($application->entityDetails->entity_type === 'llp')
                            <th>DPIN Number</th>
                            @elseif(in_array($application->entityDetails->entity_type, ['private_company', 'public_company']))
                            <th>DIN Number</th>
                            @elseif(in_array($application->entityDetails->entity_type, ['cooperative_society', 'trust']))
                            <th>Designation</th>
                            @endif
                            <th>Contact</th>
                            <th>Address</th>
                            @if($application->entityDetails->entity_type === 'partnership')
                            <th>Email</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application->entityDetails->additional_data['partners'] ?? [] as $partner)
                        <tr>
                            <td>{{ $partner['name'] ?? 'N/A' }}</td>
                            @if($application->entityDetails->entity_type === 'partnership')
                            <td>{{ $partner['father_name'] ?? 'N/A' }}</td>
                            @elseif($application->entityDetails->entity_type === 'llp')
                            <td>{{ $partner['dpin_number'] ?? 'N/A' }}</td>
                            @elseif(in_array($application->entityDetails->entity_type, ['private_company', 'public_company']))
                            <td>{{ $partner['din_number'] ?? 'N/A' }}</td>
                            @elseif(in_array($application->entityDetails->entity_type, ['cooperative_society', 'trust']))
                            <td>{{ $partner['designation'] ?? 'N/A' }}</td>
                            @endif
                            <td>{{ $partner['contact'] ?? 'N/A' }}</td>
                            <td>{{ $partner['address'] ?? 'N/A' }}</td>
                            @if($application->entityDetails->entity_type === 'partnership')
                            <td>{{ $partner['email'] ?? 'N/A' }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
                @if(!empty($application->entityDetails->additional_data['authorized_persons']))
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Authorized Persons
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Relation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application->entityDetails->additional_data['authorized_persons'] as $person)
                        <tr>
                            <td>{{ $person['name'] ?? 'N/A' }}</td>
                            <td>{{ $person['contact'] ?? 'N/A' }}</td>
                            <td>{{ $person['email'] ?? 'N/A' }}</td>
                            <td>{{ $person['address'] ?? 'N/A' }}</td>
                            <td>{{ $person['relation'] ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
                @endif
                @endif
            </div>

            <!-- Step 3: Distribution Details -->
            <div id="distribution-details" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Distribution Details
                </div>
                <div class="card-body">
                <div class="row">
                    @php
                        $areaCovered = $application->distributionDetail->area_covered ?? [];
                        if (is_string($areaCovered)) {
                            $decoded = json_decode($areaCovered, true);
                            if (is_array($decoded)) {
                                $areaCovered = count($decoded) === 1 && str_contains($decoded[0], ',') 
                                    ? array_map('trim', explode(',', $decoded[0])) 
                                    : $decoded;
                            } else {
                                $areaCovered = array_map('trim', explode(',', $areaCovered));
                            }
                        } elseif (!is_array($areaCovered)) {
                            $areaCovered = [];
                        }
                    @endphp
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Area Covered:</label>
                            <span>{{ !empty($areaCovered) ? implode(', ', $areaCovered) : 'N/A' }}</span>
                        </div>
                    </div>
               
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Appointment Type:</label>
                            <span>{{ $application->distributionDetail->appointment_type ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                @if($application->distributionDetail && $application->distributionDetail->appointment_type === 'replacement')
                <div class="replacement-section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Reason for Replacement:</label>
                                <textarea class="form-control" readonly>{{ $application->distributionDetail->replacement_reason ?? 'N/A' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Commitment to Recover Outstanding:</label>
                                <textarea class="form-control" readonly>{{ $application->distributionDetail->outstanding_recovery ?? 'N/A' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Name of Previous Firm</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $application->distributionDetail->previous_firm_name ?? 'N/A' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Code of Previous Firm</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $application->distributionDetail->previous_firm_code ?? 'N/A' }}">
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($application->distributionDetail && $application->distributionDetail->appointment_type === 'new_area')
                <div class="new-area-section">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Earlier Distributor:</label>
                                <span>{{ $application->distributionDetail->earlier_distributor ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
                </div>
            </div>

            <!-- Step 4: Business Plan -->
            <div id="business-plan" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Business Plan (Next Two Years)
                </div>
                <div class="card-body">
                @php
                    $year2025 = \App\Models\Year::where('period', '2025-26')->first();
                    $year2026 = \App\Models\Year::where('period', '2026-27')->first();
                @endphp
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Crop</th>
                            <th>FY 2025-26 (MT)</th>
                            <th>FY 2026-27 (MT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application->businessPlan as $plan)
                        @php
                            $targets = is_string($plan->yearly_targets) ? json_decode($plan->yearly_targets, true) : ($plan->yearly_targets ?? []);
                        @endphp
                        <tr>
                            <td>{{ $plan->crop ?? 'N/A' }}</td>
                            <td>{{ isset($year2025->id) && isset($targets[$year2025->id]) ? $targets[$year2025->id] : 'N/A' }}</td>
                            <td>{{ isset($year2026->id) && isset($targets[$year2026->id]) ? $targets[$year2026->id] : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                </div>
            </div>

            <!-- Step 5: Financial & Operational Information -->
            <div id="financial-info" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Financial & Operational Information
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Net Worth (Previous FY):</label>
                            <span>{{ $application->financialInfo->net_worth ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Shop Ownership:</label>
                            <span>{{ $application->financialInfo->shop_ownership ?? 'N/A' }}</span>
                        </div>
                    </div>
             
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="form-label">Godown Area & Ownership:</label>
                            <span>{{ $application->financialInfo->godown_area ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Years in Business:</label>
                            <span>{{ $application->financialInfo->years_in_business ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">Annual Turnover</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Financial Year</th>
                                        <th>Net Turnover (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $turnover = is_string($application->financialInfo->annual_turnover) 
                                            ? json_decode($application->financialInfo->annual_turnover, true) 
                                            : ($application->financialInfo->annual_turnover ?? []);
                                        $defaultYears = ['2022-23', '2023-24', '2024-25'];
                                    @endphp
                                    @foreach($defaultYears as $year)
                                    <tr>
                                        <td>FY {{ $year }}</td>
                                        <td>{{ isset($turnover[$year]) ? $turnover[$year] : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>
            <!-- Step 6: Existing Distributorships -->
        <div class="row">
            <div id="existing-distributorships" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Existing Distributorships (Agro Inputs)
                </div>
                <div class="card-body">
                @if($application->existingDistributorships->isEmpty())
                <p class="text-muted">No existing distributorships provided.</p>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($application->existingDistributorships as $distributorship)
                        <tr>
                            <td>{{ $distributorship->company_name ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
                </div>
            </div>
        

            <!-- Step 7: Bank Details -->
            <div id="bank-details" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Bank Details
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Financial Status:</label>
                            <span>{{ $application->bankDetail->financial_status ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">No. of Retailers Dealt With:</label>
                            <span>{{ $application->bankDetail->retailer_count ?? 'N/A' }}</span>
                        </div>
                    </div>
              
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Bank Name:</label>
                            <span>{{ $application->bankDetail->bank_name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Account Holder Name:</label>
                            <span>{{ $application->bankDetail->account_holder ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Account Number:</label>
                            <span>{{ $application->bankDetail->account_number ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">IFSC Code:</label>
                            <span>{{ $application->bankDetail->ifsc_code ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Account Type:</label>
                            <span>{{ $application->bankDetail->account_type ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Relationship Duration (Years):</label>
                            <span>{{ $application->bankDetail->relationship_duration ?? 'N/A' }}</span>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">OD Limit (if any):</label>
                            <span>{{ $application->bankDetail->od_limit ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">OD Security:</label>
                            <span>{{ $application->bankDetail->od_security ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
                </div>
           

            <!-- Step 8: Declarations -->
            <div id="declarations" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Declarations
                </div>
                <div class="card-body">
                @php
                    $questions = [
                        'is_other_distributor' => [
                            'label' => 'a. Whether the Distributor is an Agent/Distributor of any other Company?',
                            'details_field' => 'other_distributor_details',
                        ],
                        'has_sister_concern' => [
                            'label' => 'b. Whether the Distributor has any sister concern or affiliated entity other than the one applying for this distributorship?',
                            'details_field' => 'sister_concern_details',
                        ],
                        'has_question_c' => [
                            'label' => 'c. Whether the Distributor is acting as an Agent/Distributor for any other entities in the distribution of similar crops?',
                            'details_field' => 'question_c_details',
                        ],
                        'has_question_d' => [
                            'label' => 'd. Whether the Distributor is a partner, relative, or otherwise associated with any entity engaged in the business of agro inputs?',
                            'details_field' => 'question_d_details',
                        ],
                        'has_question_e' => [
                            'label' => 'e. Whether the Distributor has previously acted as an Agent/Distributor of VNR Seeds and is again applying for a Distributorship?',
                            'details_field' => 'question_e_details',
                        ],
                        'has_disputed_dues' => [
                            'label' => 'f. Whether any disputed dues are payable by the Distributor to the other Company/Bank/Financial Institution?',
                            'details_fields' => [
                                'disputed_amount' => 'Disputed Amount',
                                'dispute_nature' => 'Nature of Dispute',
                                'dispute_year' => 'Year of Dispute',
                                'dispute_status' => 'Present Position',
                                'dispute_reason' => 'Reason for Default',
                            ],
                        ],
                        'has_question_g' => [
                            'label' => 'g. Whether the Distributor has ceased to be Agent/Distributor of any other company in the last twelve months?',
                            'details_field' => 'question_g_details',
                        ],
                        'has_question_h' => [
                            'label' => 'h. Whether the Distributor’s relative is connected in any way with VNR Seeds and any other Seed Company?',
                            'details_field' => 'question_h_details',
                        ],
                        'has_question_i' => [
                            'label' => 'i. Whether the Distributor is involved in any other capacity with the Company apart from this application?',
                            'details_field' => 'question_i_details',
                        ],
                        'has_question_j' => [
                            'label' => 'j. Whether the Distributor has been referred by any Distributors or other parties associated with the Company?',
                            'details_fields' => [
                                'referrer_1' => 'Referrer I',
                                'referrer_2' => 'Referrer II',
                                'referrer_3' => 'Referrer III',
                                'referrer_4' => 'Referrer IV',
                            ],
                        ],
                        'has_question_k' => [
                            'label' => 'k. Whether the Distributor is currently marketing or selling products under its own brand name?',
                            'details_field' => 'question_k_details',
                        ],
                        'has_question_l' => [
                            'label' => 'l. Whether the Distributor has been employed in the agro-input industry at any point during the past 5 years?',
                            'details_field' => 'question_l_details',
                        ],
                    ];
                @endphp
                @foreach($questions as $questionKey => $config)
               @php
                    $declaration = $application->declarations->where('question_key', $questionKey)->first();
                    $hasIssue = $declaration ? $declaration->has_issue : false;
                    $details = [];
                    if ($declaration && $declaration->details) {
                        $details = is_array($declaration->details)
                            ? $declaration->details
                            : json_decode($declaration->details, true);
                    }
               @endphp

                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-2">{{ $config['label'] }}</h6>
                        <p class="mb-0"><strong>Answer:</strong> {{ $hasIssue ? 'Yes' : 'No' }}</p>
                        @if($hasIssue && !empty($details))
                        @if(isset($config['details_field']))
                        <div class="form-group mb-3">
                            <label class="form-label">Details</label>
                            <textarea class="form-control" readonly>{{ $details[$config['details_field']] ?? 'N/A' }}</textarea>
                        </div>
                        @elseif(isset($config['details_fields']))
                        @foreach($config['details_fields'] as $field => $label)
                        <div class="form-group mb-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $details[$field] ?? 'N/A' }}">
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Declaration</h6>
                        @php
                            $truthful = $application->declarations->where('question_key', 'declaration_truthful')->first();
                            $update = $application->declarations->where('question_key', 'declaration_update')->first();
                        @endphp
                        <div class="form-group mb-3">
                            <label class="form-label">a. I/We hereby solemnly affirm the truthfulness and completeness of the foregoing information and agree to be bound by all terms and conditions of the appointment/agreement with the Company.</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $truthful && $truthful->has_issue ? 'Affirmed' : 'Not Affirmed' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">b. I/We undertake to inform the company of any changes to the information provided herein within a period of 7 days, accompanied by relevant documentation.</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $update && $update->has_issue ? 'Agreed' : 'Not Agreed' }}">
                        </div>
                    </div>
                </div>
            </div>
            </div>    
            <!-- Approval Logs -->
            <div id="approval-logs" class="col-md-12">
                <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Approval Logs
                </div>
                <div class="card-body">
                    @if($application->approvalLogs->isEmpty())
                    <p class="text-muted">No approval logs available.</p>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Remarks</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($application->approvalLogs as $log)
                            <tr>
                                <td>{{ $log->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->action ?? 'N/A' }}</td>
                                <td>{{ $log->remarks ?? 'N/A' }}</td>
                                <td>{{ $log->created_at->format('d-M-Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
            
@if(auth()->user()->emp_id === $application->current_approver_id)
<div class="card mt-4">
    <div class="card-header">
        <h5>Take Action</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('approvals.approve', $application) }}" method="POST" class="d-inline">
            @csrf
            <div class="mb-3">
                <label for="approveRemarks" class="form-label">Remarks (Optional)</label>
                <textarea name="remarks" id="approveRemarks" class="form-control" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Approve</button>
        </form>

        <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal" data-bs-target="#revertModal">
            Revert
        </button>

        <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#holdModal">
            Hold
        </button>

        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#rejectModal">
            Reject
        </button>
    </div>
</div>

<!-- Revert Modal -->
<div class="modal fade" id="revertModal" tabindex="-1" aria-labelledby="revertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('approvals.revert', $application) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="revertModalLabel">Revert Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="revertRemarks" class="form-label">Reason for Revert *</label>
                        <textarea name="remarks" id="revertRemarks" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Confirm Revert</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hold Modal -->
<div class="modal fade" id="holdModal" tabindex="-1" aria-labelledby="holdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('approvals.hold', $application) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="holdModalLabel">Put Application On Hold</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="holdRemarks" class="form-label">Reason for Hold *</label>
                        <textarea name="remarks" id="holdRemarks" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="followUpDate" class="form-label">Follow-up Date *</label>
                        <input type="date" name="follow_up_date" id="followUpDate" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary">Confirm Hold</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('approvals.reject', $application) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejectRemarks" class="form-label">Reason for Rejection *</label>
                        <textarea name="remarks" id="rejectRemarks" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush