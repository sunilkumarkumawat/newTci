@extends('layout.app')
@section('content')
    @php
        $isEdit = isset($data);
    @endphp

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                {{-- breadcrumb --}}
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Expense</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <!-- Expense Form Column -->
                    <div class="col-md-4 col-12">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-primary">
                                <div class="card-title">
                                    <h4><i class="fa fa-credit-card"></i> &nbsp;Add Expense</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="createCommon" enctype="multipart/form-data">
                                    @if ($isEdit)
                                        <input type='hidden' value='{{ $data->id }}' name='id' />
                                    @endif
                                    <input type='hidden' value='Expense' name='modal_type' />
                                    <input type='hidden' id="branch_id" name='branch_id'
                                        value="{{ old('branch_id', $data->branch_id ?? '') }}" />
                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="sr_no">Sr.No.</label>
                                                    <input type="text" id="sr_no" placeholder="Enter Sr no"
                                                        class="form-control blockHeight sr-no" name="sr_no"
                                                        value="{{ old('sr_no', $data->sr_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="expense_name">Expense Name<span
                                                            style="color:red;">*</span></label>
                                                    <input type="text" class="form-control blockHeight" id="expense_name"
                                                        placeholder="Enter Expense Name" name="expense_name"
                                                        data-required="true"
                                                        value="{{ old('expense_name', $data->expense_name ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="expense_date">Date<span style="color:red;">*</span></label>
                                                    <input type="date" class="form-control blockHeight" id="expense_date"
                                                        name="expense_date" data-required="true"
                                                        value="{{ old('expense_date', $data->expense_date ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <label for="quantity">Quantity<span style="color:red;">*</span></label>
                                                <input type="text" class="form-control blockHeight quantity"
                                                    id="quantity" name="quantity" data-required="true"
                                                    placeholder="Enter Quantity"
                                                    value="{{ old('quantity', $data->quantity ?? '') }}">
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="rate">Rate<span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control blockHeight rate"
                                                        id="rate" name="rate" data-required="true"
                                                        placeholder="Enter Rate"
                                                        value="{{ old('rate', $data->rate ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="total_amt">Total Amount<span
                                                            style="color:red;">*</span></label>
                                                    <input type="text" class="form-control blockHeight total"
                                                        id="total_amt" name="total_amt" data-required="true"
                                                        placeholder="Total Amount"
                                                        value="{{ old('total_amt', $data->total_amt ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">

                                                @include('commoninputs.inputs', [
                                                    'modal' => 'PaymentMode', // This decides the data source
                                                    'name' => 'payment_mode_id',
                                                    'selected' => $data->payment_mode_id ?? null,
                                                    'label' => 'Payment Mode',
                                                    'required' => true,
                                                ])


                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label>Attachment</label>
                                                    <input type="file" class="form-control" id="expense-attachment"
                                                        name="attachment">
                                                    {{-- File inputs cannot retain old values due to security reasons --}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control blockHeight" id="expense-remark" name="description" rows="6">{{ old('description', $data->description ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 p-0 ">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Expense View Column -->
                    <div class="col-md-8">
                        <div class="card card-outline card-orange">
                            <div class="card-header bg-light">
                                <div class="card-title">
                                    <h4><i class="fa fa-list"></i> &nbsp;Expense List</h4>
                                </div>
                                {{-- <div class="card-tools">
                                    <button type="button" class="btn btn-success btn-sm" id="refresh-list">
                                        <i class="fa fa-refresh"></i> <span class="Display_none_mobile">Refresh</span>
                                    </button>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id='dataContainer'class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Sr.No</th>
                                                <th>Expense Name</th>
                                                <th>Date</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Attachment</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataContainer-expense" class='dataContainer'style="min-height:300px">
                                            @include('common.loadskeletan',['loopCount'=>6])
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>


    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const expenseForm = document.getElementById('expense-form');
            const expenseContainer = document.getElementById('expense-container');
            const expenseList = document.getElementById('expense-list');
            const listTotal = document.getElementById('list_total');

            // Set default date to today
            document.getElementById('expense-date').valueAsDate = new Date();

            // Function to calculate row total
            function calculateRowTotal() {
                const quantity = parseFloat(document.querySelector('.quantity').value) || 0;
                const rate = parseFloat(document.querySelector('.rate').value) || 0;
                const total = quantity * rate;

                document.querySelector('.total').value = total.toFixed(2);
                document.getElementById('total_amount').value = total.toFixed(2);
            }

            // Add event listeners for calculation
            document.querySelector('.quantity').addEventListener('input', calculateRowTotal);
            document.querySelector('.rate').addEventListener('input', calculateRowTotal);

            // Function to add expense to the list
            function addExpenseToList(expense) {
                // Calculate next Sr.No
                const rows = expenseList.querySelectorAll('tr');
                const srNo = rows.length + 1;

                // Format date for display
                const dateObj = new Date(expense.date);
                const formattedDate = dateObj.toLocaleDateString();

                // Create unique temporary ID for the new row
                const tempId = 'temp-' + Date.now();

                // Create new table row
                const newRow = document.createElement('tr');
                newRow.classList.add('highlight-row');
                newRow.innerHTML = `
            <td>${srNo}</td>
            <td>${formattedDate}</td>
            <td>${expense.particular}</td>
            <td>${expense.quantity}</td>
            <td>${expense.total}</td>
            <td>
                <div class="btn-group">
                    <a href="#" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" data-id="${tempId}" class="btn btn-danger btn-sm delete-expense">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        `;

                // Add the new row to the expense list
                expenseList.appendChild(newRow);

                // Update the list total
                updateListTotal(parseFloat(expense.total));

                // Add event listener to the delete button in the new row
                const deleteButton = newRow.querySelector('.delete-expense');
                deleteButton.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this expense?')) {
                        const expenseId = this.getAttribute('data-id');
                        // Remove the row
                        this.closest('tr').remove();
                        // Recalculate total and update sr numbers
                        recalculateTotal();
                        updateSrNumbers();
                    }
                });
            }

            // Function to update list total
            function updateListTotal(amount) {
                const currentTotal = parseFloat(listTotal.value) || 0;
                const newTotal = currentTotal + amount;
                listTotal.value = newTotal.toFixed(2);
            }

            // Function to recalculate the total from all rows
            function recalculateTotal() {
                let total = 0;
                const amountCells = expenseList.querySelectorAll('tr td:nth-child(5)');
                amountCells.forEach(cell => {
                    total += parseFloat(cell.textContent) || 0;
                });
                listTotal.value = total.toFixed(2);
            }

            // Function to update sr numbers after deletion
            function updateSrNumbers() {
                const rows = expenseList.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
            }

            // Handle form submission
            expenseForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Validate form
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    this.classList.add('was-validated');
                    return;
                }

                // Get form data
                const expense = {
                    date: document.getElementById('expense-date').value,
                    particular: document.getElementById('expense-particular').value,
                    quantity: document.getElementById('expense-quantity').value,
                    rate: document.getElementById('expense-rate').value,
                    total: document.getElementById('expense-total').value,
                    payment_mode: document.getElementById('expense-payment-mode').value,
                    remark: document.getElementById('expense-remark').value
                };

                // Add expense to the list
                addExpenseToList(expense);

                // Submit form data to server via AJAX
                const formData = new FormData(this);

                fetch('/expenses', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data);
                        // Show success message
                        alert('Expense added successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show error message but keep the item in the list
                        alert(
                            'There was an error saving the expense to the server. The item is displayed in the list but may not be permanently saved.'
                        );
                    });

                // Reset form fields
                resetForm();
            });

            // Function to reset form fields
            function resetForm() {
                document.getElementById('expense-particular').value = '';
                document.getElementById('expense-quantity').value = '';
                document.getElementById('expense-rate').value = '';
                document.getElementById('expense-total').value = '';
                document.getElementById('expense-payment-mode').value = 'Cash';
                document.getElementById('expense-attachment').value = '';
                document.getElementById('expense-remark').value = '';
                document.getElementById('total_amount').value = '';

                // Keep the date as today
                document.getElementById('expense-date').valueAsDate = new Date();
            }

            // Refresh button functionality
            document.getElementById('refresh-list').addEventListener('click', function() {
                // In a real application, you would fetch the latest data from the server
                fetch('/expenses/list')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Clear the existing list
                        expenseList.innerHTML = '';

                        // Add each expense to the list
                        data.expenses.forEach((expense, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${expense.date}</td>
                        <td>${expense.particular}</td>
                        <td>${expense.quantity}</td>
                        <td>${expense.total}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/expenses/${expense.id}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="/expenses/${expense.id}/edit" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" data-id="${expense.id}" class="btn btn-danger btn-sm delete-expense">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    `;
                            expenseList.appendChild(row);
                        });

                        // Update the total
                        listTotal.value = data.total || '0.00';

                        // Add event listeners to the new delete buttons
                        addDeleteEventListeners();

                        alert('Expense list refreshed successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error refreshing expense list.');
                    });
            });
        });
    </script>
@endsection
