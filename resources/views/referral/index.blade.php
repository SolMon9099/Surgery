@extends('layouts.master')

@section('title', 'Patient Data Management')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="patients-referral-table table">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Hgt(cm)/Wgt(kg)</th>
                    <th>Referral</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $key=>$value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->address}}&nbsp;{{$value->address_line2}}&nbsp;{{$value->city}}&nbsp;&nbsp;{{$value->state}}&nbsp;&nbsp;{{$value->postal}}</td>
                        <td>{{$value->phone}}</td>
                        <td>{{$value->height}}/{{$value->weight}}</td>
                        <td>
                            @if($value->referral)
                                <a href="{{ route('referral.edit', $value->referral->id) }}"><i data-feather="edit" class="me-50"></i><span>Edit Referral</span></a>
                            @else
                                <a href="{{ route('referral.create_referral', $value->id) }}"><i data-feather="plus" class="me-50"></i><span>Add Referral</span></a>
                            @endif
                        </td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">
                                    <i data-feather='more-vertical' class="font-small-4"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('users.edit', $value->id).'?from_request=referral' }}" class="dropdown-item">
                                        <i data-feather="edit-2" class="me-50"></i>
                                        <span>Edit Patient</span>
                                    </a>
                                    <a href="#" class="dropdown-item deletePatientBtn" data-id = {{$value->id}}>
                                        <i data-feather="trash" class="me-50"></i>
                                        <span>Delete Patient</span>
                                    </a>
                                    @if($value->referral)
                                    <a href="#" class="dropdown-item deleteReferralBtn" data-id = {{$value->referral->id}}>
                                        <i data-feather="trash" class="me-50"></i>
                                        <span>Delete Referral</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="patient-modals" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Patient Information</h1>
                </div>

                <form action="{{ route('users.store') }}" class="add-new-user row gy-1 pt-75" method="POST">
                    @csrf
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Username</label>
                        <input type="text" class="form-control name" id="name" placeholder="John Doe" name="name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control email" placeholder="john.doe@example.com" name="email" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">phone</label>
                        <input type="text" id="phone" class="form-control phone-number-mask" name="phone" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">Date of Birth</label>
                        <input type="text" id="date_of_birth" class="form-control date-mask" name="date_of_birth" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control password" placeholder="*****" name="password" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" class="form-control confirm_password" placeholder="*****" name="confirm_password" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="adderss_line2">Address Line2</label>
                        <input type="text" id="address_line2" name="address_line2" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="patient_state">State/Province</label>
                        <input type="text" id="state" name="state" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="postal">Patient Postal/Zip Code</label>
                        <input type="text" id="postal" name="postal" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="patient_gender">Gender</label>
                        <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" checked />
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" />
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="height">Height(cm)</label>
                        <input type="number" id="height" name="height" class="form-control" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="weight">Weight(kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" />
                    </div>
                    <input type="hidden" value="patient" name="roles"/>
                    <input type="hidden" value="referral" name="from_request"/>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Save</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {
        $('.page-item').click(function(){
            feather.replace();
        })
    })

    $(document).on('click', '.deleteReferralBtn', function(e) {
        let id = $(this).data('id');
        var url = "{{ route('referral.destroy', ':id') }}".replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success( response.message, 'Success!', { "showDuration": 500, positionClass: 'toast-top-right' });
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).on('click', '.deletePatientBtn', function(e) {
        let id = $(this).data('id');
        var url = "{{ route('users.delete', ':id') }}".replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success( response.message, 'Success!', { "showDuration": 500, positionClass: 'toast-top-right' });
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

</script>
@endsection
