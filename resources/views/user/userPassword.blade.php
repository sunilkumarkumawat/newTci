@extends('layout.app')
@section('content')
@php
$permissions = Helper::getPermissions();
@endphp
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            {{-- breadcrumb --}}
            <div class="row">
                <div class="col-md-12 col-12 p-0">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item">Id & Password</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="card card-outline card-orange col-md-12 col-12 p-0">
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h4><i class="fa fa-desktop"></i> &nbsp; Id & Password</h4>
                        </div>
                        <div class="card-tools">
                            @if(in_array('user_management.`add`', $permissions) || Auth::user()->role_id == 1)
                            <!-- <a href="{{ url('studentAdd') }}" class="student_management.add btn btn-primary  btn-sm"><i class="fa fa-plus"></i>
                                    <span class="Display_none_mobile"> {{ __('common.Add') }} </span></a> -->
                            @endif
                            {{-- <a href="{{ url('userAdd') }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-arrow-left"></i> <span class="Display_none_mobile"> {{ __('common.Back') }}
                            </span></a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bg-item border p-3 rounded">
                            <form id="quickForm" method="post">
                                <input type='hidden' value='User' name='modal_type' />
                                <div class="row">
                                    @include('commoninputs.filterinputs', [
                                    'filters' => [
                                    'keyword' => true,
                                    'status' => true
                                    ]
                                    ])
                                    <div class="col-md-1 mt-4">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="bg-item border p-3 rounded usernameParameter d-none">
                            <div class="row">
                                <!-- Username creation method -->
                                <div class="col-md-2">
                                    <label for="username_source">Username Based On:</label>
                                    <select id="username_source" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <!-- <option value="father_mobile">Father Mobile</option> -->
                                        <option value="self_mobile">Self Mobile</option>
                                        <option value="dob">Date of Birth (YYYYMMDD)</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>

                             

                                <!-- Password input -->
                                <div class="col-md-2">
                                    <label for="default_password">Password:</label>
                                    <input type="text" id="default_password" class="form-control form-control-sm" placeholder="Enter password">
                                </div>
                            </div>
                        
                            <!-- Apply preview -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                <button class='btn btn-sm bg-danger' id='generatePassword'>Apply to all</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-2 ">
                            <form id="generatePasswordForm" data-modal='User' method="post" action="{{ url('generatePassword') }}">
                            <table id='generatePassTable' class="generatePassTable d-none table table-bordered table-striped mt-4">
                                <thead>
                                    <tr class="bg-light">
                                        <th>SR.NO</th>
                                        <th>Name</th>
                                        <th>Dob</th>
                                        <th>Mobile</th>
                                        <!-- <th>Father Mobile</th> -->
                                        <th>Username</th>
                                        <th>Password</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan='100%' class='text-center'><button type='submit' class='btn btn-sm bg-success'>Submit</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>

        <script>
            $(document).ready(function() {
                $('#quickForm').on('submit', function(e) {
                    e.preventDefault();

                    // get form data
                    const formData = $(this).serializeArray();
                    const modalType = $('input[name="modal_type"]').val();
                      const columns = 'id,name,dob,mobile,userName,confirm_password';

                    // ensure modal_type is sent
                    formData.push({
                        name: 'modal_type',
                        value: modalType
                    });

                        formData.push({
                        name: 'columns',
                        value: columns
                    });

                    $.ajax({
                        url: "{{ url('allTypeUsersData') }}",
                        method: "GET",
                        data: formData,
                        success: function(data) {

                            $('.generatePassTable,.usernameParameter').removeClass('d-none');

                            const tbody = $('#generatePassTable tbody');
                            tbody.empty();

                            if (!data.data.length) {
                                tbody.append(`<tr><td colspan="7" class="text-center">No records found.</td></tr>`);
                                return;
                            }

                            data.data.forEach((item, index) => {
                                tbody.append(`
                        <tr data-self_mobile="${item.mobile}" data-dob="${item.dob}">
                            <td>${index + 1}</td>
                            <td>${item.name}
                            <input type="hidden" value='${item.id}' name="id[]" />
                             
                            </td>
                            <td>${item.dob ?? '-'}</td>
                            <td>${item.mobile ?? '-'}</td>
                           
                            <td>
                            <input type="text" 
                            class="form-control form-control-sm username-input " 
                            name="userName[]" 
                            value="${item.userName ?? ''}" 
                            data-id="${item.id}" />
                            </td>

                            <td>
                            <input type="text" 
                            class="form-control form-control-sm password-input" 
                            name="password[]" 
                            value="${item.confirm_password ?? ''}" 
                            data-id="${item.id}" />
                            </td>
                           
                        </tr>
                    `);
                            });
                        },
                        error: function() {
                            alert("Something went wrong.");
                        }
                    });
                });
            });
        </script>

        <script>


function generateRandomString(length = 6) {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}

            // Show or hide the custom box
          $('#generatePassword').on('click', function () {
    const selectedValue = $('#username_source').val();
    const commonPassword = $('#default_password').val();
           const tbodyLength = $('#studentTable tbody tr').length;

    if (tbodyLength === 0) {
        toastr.error('Please search for students first.');
        return;
    }
            
    if(selectedValue === '') {
       toastr.error('Please select a username source.');
       return;
    }


    $('#generatePassTable tbody tr').each(function () {
        const row = $(this);
        let value = '';

        switch (selectedValue) {
           
            case 'self_mobile':
                value = row.data('self_mobile');
                break;
            case 'dob':
                const dob = row.data('dob') || '';
                value = dob.replaceAll('-', '');
                break;
               case 'custom':
                const fullName = row.find('td:nth-child(2)').text().trim(); // assuming name is in 2nd column
                const first3 = fullName.substring(0, 3);
                value = first3 + generateRandomString(5);
                break;
            default:
                value = '';
        }

        row.find('.username-input').val(value);
        row.find('.password-input').val(commonPassword);
    });
});

           
        </script>
        @endsection