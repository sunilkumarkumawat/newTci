@extends('layout.app')
@section('content')
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
                                <form id="createCommon">
                                    <input type='hidden' value='expense' name="modal_type" />
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                                    <input type='hidden' value='3' name='branch_id' />

                                    <div id="expense-container" class="bg-item mb-3 border p-3 rounded">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label  for="sr_no">Sr.No.</label>
                                                    <input type="text" id="sr_no" class="form-control blockHeight sr-no"
                                                        name="sr_no" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="text-danger" for="expense_name" >Expense Name*</label>
                                                    <input type="text" class="form-control blockHeight"
                                                        id="expense_name" name="expense_name" data-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="text-danger" for="expense-date" >Date*</label>
                                                    <input type="date"  class="form-control blockHeight" id="expense-date"
                                                        name="expense-date" data-required="true">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-12">
                                                <label class="text-danger" for="expense-quantity">Quantity*</label>
                                                <input type="text" class="form-control blockHeight quantity"
                                                    id="expense-quantity" name="quantity" data-required="true">
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="text-danger" for="expense-rate">Rate*</label>
                                                    <input type="text" class="form-control blockHeight rate"
                                                        id="expense-rate" name="rate" data-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="text-danger" for="expense-total">Total Amount*</label>
                                                    <input type="text" class="form-control blockHeight total"
                                                        id="expense-total" name="total_amt" data-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="text-danger" for="payment_mode_id">Payment Mode*</label>
                                                    <select class="form-control " id="payment_mode_id"
                                                        name="payment_mode_id" readonly data-required="true">
                                                        <option value="1">Cash</option>
                                                        <option value="2">Card</option>
                                                        <option value="3 ">Bank Transfer</option>
                                                        <option value="4">UPI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label>Attachment</label>
                                                    <input type="file" class="form-control "
                                                        id="expense-attachment" name="attachment">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control blockHeight" id="expense-remark" name="description" rows="6"></textarea>
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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Sr.No</th>
                                                <th>Date</th>
                                                <th>Particular</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="expense-list">
                                            <!-- Expense entries will be loaded here -->
                                            {{-- @foreach ($expenses ?? [] as $index => $expense) --}}
                                            <tr>
                                                <td>1</td>
                                                <td>hello</td>
                                                <td>34</td>
                                                <td>60</td>
                                                <td>800</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn-xs">
                                                            <i class="fa fa-eye  fs-6  text-info"></i>
                                                        </a>

                                                        <a href="#" class="btn-xs">
                                                            <i class="fa fa-edit fs-6 mx-2 text-warning"></i>
                                                        </a>
                                                        <a href="#" class=" btn-xs">
                                                            <i class="fa fa-trash fs-6 text-danger"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><strong>Total:</strong></span>
                                                <input type="text" class="form-control" id="list_total" readonly>
                                            </div>
                                        </div>
                                    </div>
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

            // Function to add event listeners to all delete buttons
            function addDeleteEventListeners() {
                document.querySelectorAll('.delete-expense').forEach(function(button) {
                    button.addEventListener('click', function() {
                        if (confirm('Are you sure you want to delete this expense?')) {
                            const expenseId = this.getAttribute('data-id');
                            const row = this.closest('tr');
                            const amount = parseFloat(row.querySelector('td:nth-child(5)')
                                .textContent) || 0;

                            // If it's a server-stored expense (has a numeric ID)
                            if (!expenseId.startsWith('temp-')) {
                                // Delete from server
                                fetch(`/expenses/${expenseId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'input[name="_token"]').value
                                        }
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log('Success:', data);
                                        // Remove the row from DOM
                                        row.remove();
                                        // Update sr numbers and recalculate total
                                        updateSrNumbers();
                                        recalculateTotal();
                                        alert('Expense deleted successfully!');
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Error deleting expense.');
                                    });
                            } else {
                                // Just remove the temporary row
                                row.remove();
                                // Update sr numbers and recalculate total
                                updateSrNumbers();
                                recalculateTotal();
                            }
                        }
                    });
                });
            }

            // Add event listeners to the initial delete buttons
            addDeleteEventListeners();
        });
    </script>
@endsection
