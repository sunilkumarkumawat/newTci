@extends('layout.app')
@section('content')

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <!-- Summary Boxes -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="summary-box summary-box-critical">
                        <h3>12</h3>
                        <p><i class="fas fa-exclamation-circle"></i> Expiring Today</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="summary-box summary-box-warning">
                        <h3>28</h3>
                        <p><i class="fas fa-exclamation-triangle"></i> Expiring in 3 Days</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="summary-box summary-box-notice">
                        <h3>43</h3>
                        <p><i class="fas fa-clock"></i> Expiring in 7 Days</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="summary-box summary-box-expired">
                        <h3>8</h3>
                        <p><i class="fas fa-times-circle"></i> Recently Expired</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fas fa-user-clock mr-2"></i>Membership Renewal Tracker</h3>
                        </div>
                        
                        <form id="filterForm" action="#" method="post" class="p-3  border-bottom">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-2">
                                    <label class="filter-label">Filter Status</label>
                                    <select class="form-control" id="expiryFilter" name="expiryFilter">
                                        <option value="">All Members</option>
                                        <option value="today">Expiring Today</option>
                                        <option value="3days">Expiring in 3 Days</option>
                                        <option value="7days">Expiring in 7 Days</option>
                                        <option value="14days">Expiring in 14 Days</option>
                                        <option value="expired">Already Expired</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2">
                                    <label class="filter-label">Membership Type</label>
                                    <select class="form-control" id="membershipType" name="membershipType">
                                        <option value="">All Types</option>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                        <option value="vip">VIP</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2">
                                    <label class="filter-label">Time Slot</label>
                                    <select class="form-control" id="timeSlot" name="timeSlot">
                                        <option value="">All Time Slots</option>
                                        <option value="morning">Morning (6 AM - 12 PM)</option>
                                        <option value="afternoon">Afternoon (12 PM - 5 PM)</option>
                                        <option value="evening">Evening (5 PM - 10 PM)</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-2">
                                    <label class="filter-label">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search by name or ID...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-body table-responsive p-0">
                            <table id="renewalTable" class="table table-hover custom-responsive-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile</th>
                                        <th>Member Info</th>
                                        <th>Plan Details</th>
                                        <th>Expiry Status</th>
                                        <th>Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Member 1 -->
                                    <tr class="dataEntry">
                                        <td data-label="ID">M1001</td>
                                        <td data-label="Profile" class="profile-column">
                                            <img src="/api/placeholder/60/60" alt="Member Photo" class="profile-img">
                                        </td>
                                        <td data-label="Member Info">
                                            <strong>John Smith</strong><br>
                                            <small>Joined: Jan 15, 2023</small>
                                        </td>
                                        <td data-label="Plan Details">
                                            <span class="plan-tag"><i class="fas fa-crown"></i> Premium</span><br>
                                            <span class="plan-tag"><i class="fas fa-clock"></i> Morning</span>
                                        </td>
                                        <td data-label="Expiry Status">
                                            <span class="expiry-badge expiry-critical">Expires Today</span><br>
                                            <small class="time-left">Ends at 11:59 PM</small>
                                        </td>
                                        <td data-label="Contact">
                                            <i class="fas fa-phone-alt mr-1"></i> (555) 123-4567<br>
                                            <i class="fas fa-envelope mr-1"></i> john.s@example.com
                                        </td>
                                        <td data-label="Actions" class="action-column">
                                            <button class="btn btn-success btn-action"><i class="fas fa-sync-alt"></i> Renew</button>
                                            <button class="btn btn-info btn-action"><i class="fas fa-envelope"></i> Notify</button>
                                            <button class="btn btn-secondary btn-action"><i class="fas fa-user"></i> Profile</button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Member 2 -->
                                    <tr class="dataEntry">
                                        <td data-label="ID">M1008</td>
                                        <td data-label="Profile" class="profile-column">
                                            <img src="/api/placeholder/60/60" alt="Member Photo" class="profile-img">
                                        </td>
                                        <td data-label="Member Info">
                                            <strong>Sarah Johnson</strong><br>
                                            <small>Joined: Mar 22, 2023</small>
                                        </td>
                                        <td data-label="Plan Details">
                                            <span class="plan-tag"><i class="fas fa-star"></i> Standard</span><br>
                                            <span class="plan-tag"><i class="fas fa-clock"></i> Evening</span>
                                        </td>
                                        <td data-label="Expiry Status">
                                            <span class="expiry-badge expiry-warning">2 Days Left</span><br>
                                            <small class="time-left">Expires on May 10, 2025</small>
                                        </td>
                                        <td data-label="Contact">
                                            <i class="fas fa-phone-alt mr-1"></i> (555) 234-5678<br>
                                            <i class="fas fa-envelope mr-1"></i> sarah.j@example.com
                                        </td>
                                        <td data-label="Actions" class="action-column">
                                            <button class="btn btn-success btn-action"><i class="fas fa-sync-alt"></i> Renew</button>
                                            <button class="btn btn-info btn-action"><i class="fas fa-envelope"></i> Notify</button>
                                            <button class="btn btn-secondary btn-action"><i class="fas fa-user"></i> Profile</button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Member 3 -->
                                    <tr class="dataEntry">
                                        <td data-label="ID">M1012</td>
                                        <td data-label="Profile" class="profile-column">
                                            <img src="/api/placeholder/60/60" alt="Member Photo" class="profile-img">
                                        </td>
                                        <td data-label="Member Info">
                                            <strong>Robert Chen</strong><br>
                                            <small>Joined: Feb 10, 2024</small>
                                        </td>
                                        <td data-label="Plan Details">
                                            <span class="plan-tag"><i class="fas fa-gem"></i> VIP</span><br>
                                            <span class="plan-tag"><i class="fas fa-clock"></i> Afternoon</span>
                                            <span class="plan-tag"><i class="fas fa-box"></i> Locker</span>
                                        </td>
                                        <td data-label="Expiry Status">
                                            <span class="expiry-badge expiry-notice">5 Days Left</span><br>
                                            <small class="time-left">Expires on May 13, 2025</small>
                                        </td>
                                        <td data-label="Contact">
                                            <i class="fas fa-phone-alt mr-1"></i> (555) 345-6789<br>
                                            <i class="fas fa-envelope mr-1"></i> robert.c@example.com
                                        </td>
                                        <td data-label="Actions" class="action-column">
                                            <button class="btn btn-success btn-action"><i class="fas fa-sync-alt"></i> Renew</button>
                                            <button class="btn btn-info btn-action"><i class="fas fa-envelope"></i> Notify</button>
                                            <button class="btn btn-secondary btn-action"><i class="fas fa-user"></i> Profile</button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Member 4 -->
                                    <tr class="dataEntry">
                                        <td data-label="ID">M0997</td>
                                        <td data-label="Profile" class="profile-column">
                                            <img src="/api/placeholder/60/60" alt="Member Photo" class="profile-img">
                                        </td>
                                        <td data-label="Member Info">
                                            <strong>Maria Rodriguez</strong><br>
                                            <small>Joined: Dec 05, 2023</small>
                                        </td>
                                        <td data-label="Plan Details">
                                            <span class="plan-tag"><i class="fas fa-crown"></i> Premium</span><br>
                                            <span class="plan-tag"><i class="fas fa-clock"></i> Morning</span>
                                            <span class="plan-tag"><i class="fas fa-box"></i> Locker</span>
                                        </td>
                                        <td data-label="Expiry Status">
                                            <span class="expiry-badge expiry-expired">Expired</span><br>
                                            <small class="time-left">Expired on May 06, 2025</small>
                                        </td>
                                        <td data-label="Contact">
                                            <i class="fas fa-phone-alt mr-1"></i> (555) 456-7890<br>
                                            <i class="fas fa-envelope mr-1"></i> maria.r@example.com
                                        </td>
                                        <td data-label="Actions" class="action-column">
                                            <button class="btn btn-success btn-action"><i class="fas fa-sync-alt"></i> Renew</button>
                                            <button class="btn btn-info btn-action"><i class="fas fa-envelope"></i> Notify</button>
                                            <button class="btn btn-secondary btn-action"><i class="fas fa-user"></i> Profile</button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Member 5 -->
                                    <tr class="dataEntry">
                                        <td data-label="ID" class="datas">M1020</td>
                                        <td data-label="Profile" class="profile-column">
                                            <img src="/api/placeholder/60/60" alt="Member Photo" class="profile-img">
                                        </td>
                                        <td data-label="Member Info">
                                            <strong>David Wilson</strong><br>
                                            <small>Joined: Apr 15, 2024</small>
                                        </td>
                                        <td data-label="Plan Details">
                                            <span class="plan-tag"><i class="fas fa-star"></i> Standard</span><br>
                                            <span class="plan-tag"><i class="fas fa-clock"></i> Evening</span>
                                        </td>
                                        <td data-label="Expiry Status">
                                            <span class="expiry-badge expiry-critical">Expires Today</span><br>
                                            <small class="time-left">Ends at 11:59 PM</small>
                                        </td>
                                        <td data-label="Contact">
                                            <i class="fas fa-phone-alt mr-1"></i> (555) 567-8901<br>
                                            <i class="fas fa-envelope mr-1"></i> david.w@example.com
                                        </td>
                                        <td data-label="Actions" class="action-column">
                                            <button class="btn btn-success btn-action"><i class="fas fa-sync-alt"></i> Renew</button>
                                            <button class="btn btn-info btn-action"><i class="fas fa-envelope"></i> Notify</button>
                                            <button class="btn btn-secondary btn-action"><i class="fas fa-user"></i> Profile</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    Showing <strong>1-5</strong> of <strong>91</strong> members
                                </div>
                                <div class="col-md-6">
                                    <ul class="pagination justify-content-end m-0">
                                        <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Renewal Modal -->
<div class="modal fade" id="renewalModal" tabindex="-1" role="dialog" aria-labelledby="renewalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renewalModalLabel">Renew Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img src="/api/placeholder/80/80" alt="Member Photo" class="profile-img mb-2">
                    <h5>John Smith</h5>
                    <p class="text-muted">Membership ID: M1001</p>
                </div>
                
                <div class="form-group">
                    <label>Current Plan</label>
                    <input type="text" class="form-control" value="Premium - Morning Slot" disabled>
                </div>
                
                <div class="form-group">
                    <label>Renewal Plan</label>
                    <select class="form-control">
                        <option value="same">Same as Current (Premium - Morning Slot)</option>
                        <option value="premium-afternoon">Premium - Afternoon Slot</option>
                        <option value="premium-evening">Premium - Evening Slot</option>
                        <option value="standard-morning">Standard - Morning Slot</option>
                        <option value="standard-afternoon">Standard - Afternoon Slot</option>
                        <option value="standard-evening">Standard - Evening Slot</option>
                        <option value="vip-morning">VIP - Morning Slot</option>
                        <option value="vip-afternoon">VIP - Afternoon Slot</option>
                        <option value="vip-evening">VIP - Evening Slot</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Duration</label>
                    <select class="form-control">
                        <option value="1">1 Month</option>
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Renewal Date</label>
                    <input type="date" class="form-control" value="2025-05-08">
                </div>
                
                <div class="form-group">
                    <label>Payment Method</label>
                    <select class="form-control">
                        <option value="cash">Cash</option>
                        <option value="card">Credit/Debit Card</option>
                        <option value="upi">UPI</option>
                        <option value="net">Net Banking</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add any special notes or comments..."></textarea>
                </div>
                
                <div class="alert alert-info">
                    <strong>Amount Due:</strong> $150.00
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Complete Renewal</button>
            </div>
        </div>
    </div>
</div>

<!-- Required CSS -->
<style>
    /* Custom CSS for Renewal Tracker */
    :root {
        --primary-color: #3498db;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --success-color: #2ecc71;
        --secondary-color: #7f8c8d;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .dataEntry{
        padding-top: 5px;
        
    }

    .datas{
        vertical-align: middle;
    }

    
    .content-wrapper {
        padding: 20px 0;
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 30px;
    }
    
    .card-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 5px 20px;
    }
    
    .card-title {
        margin-bottom: 0;
        font-weight: 600;
    }
    
   
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        border-color: var(--primary-color);
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
    }
    
    .expiry-badge {
        padding: 2px 10px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 7px;
    }
    
    .expiry-critical {
        background-color: var(--danger-color);
        color: white;
    }
    
    .expiry-warning {
        background-color: var(--warning-color);
        color: white;
    }
    
    .expiry-notice {
        background-color: var(--primary-color);
        color: white;
    }
    
    .expiry-good {
        background-color: var(--success-color);
        color: white;
    }
    
    .expiry-expired {
        background-color: #333;
        color: white;
    }
    
    .btn-action {
        padding: 5px 10px;
        font-size: 0.8rem;
        margin-right: 5px;
    }
    
    .profile-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #f8f9fa;
    }

    .plan-tag{
        padding: 0px 8px !important;
    }
    
    .summary-box {
        padding: 8px;
        border-radius: 10px;
        margin-bottom: 20px;
        color: white;
        transition: all 0.3s ease;
    }
    
    .summary-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .summary-box h3 {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }
    
    .summary-box p {
        margin-bottom: 0;
        opacity: 0.8;
    }
    
    .summary-box-critical {
        background-color: var(--danger-color);
    }
    
    .summary-box-warning {
        background-color: var(--warning-color);
    }
    
    .summary-box-notice {
        background-color: var(--primary-color);
    }
    
    .summary-box-expired {
        background-color: #333;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0;
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .pagination .page-link {
        color: var(--primary-color);
    }
    
    .plan-tag {
        background-color: #e9ecef;
        border-radius: 4px;
        padding: 3px 8px;
        font-size: 0.8rem;
        display: inline-block;
    }
    .action-column {
            min-width: 120px;
            margin-top: 20px;
            text-align: center;
            vertical-align: middle !important;                /* adminlte.min.css  ( .table td- vertical-align: top;)*/
        }
    
    /* Refined Mobile Responsive CSS for Membership Renewal Tracker */

/* Mobile-first approach for iPhone and similar devices */
@media (max-width: 767px) {
    /* Fix the overall table structure */
    .custom-responsive-table {
        display: block;
        width: 100%;
        border: none;
    }
    
    .custom-responsive-table thead {
        display: none;
    }
    
    .custom-responsive-table tbody,
    .custom-responsive-table tr {
        display: block;
        width: 100%;
    }
    
    /* Style each row as a card */
    .custom-responsive-table tr {
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    /* Style each cell */
    .custom-responsive-table td {
        display: flex;
        width: 100%;
        padding: 12px 15px;
        border-bottom: 1px solid #f0f0f0;
        align-items: center;
        min-height: 40px;
    }
    
    .custom-responsive-table td::before {
        content: attr(data-label);
        width: 40%;
        font-weight: 600;
        color: #555;
        font-size: 14px;
        flex-shrink: 0;
        text-align: left;
        padding-right: 10px;
    }
    
    /* Special treatment for specific cells */
    .custom-responsive-table td[data-label="ID"] {
        background-color: #f8f9fa;
        font-weight: 600;
        font-size: 16px;
    }
    
    /* Fix profile section alignment */
    .custom-responsive-table td.profile-column {
        justify-content: center;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 5px;
    }
    
    .custom-responsive-table td.profile-column::before {
        display: none;
    }
    
    .profile-img {
        width: 70px;
        height: 70px;
        border: 3px solid #f0f0f0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    /* Fix member info section */
    .custom-responsive-table td[data-label="Member Info"] {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding-top: 0;
    }
    
    .custom-responsive-table td[data-label="Member Info"]::before {
        display: none;
    }
    
    .custom-responsive-table td[data-label="Member Info"] strong {
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .custom-responsive-table td[data-label="Member Info"] small {
        color: #777;
    }
    
    /* Style plan details */
    .custom-responsive-table td[data-label="Plan Details"] {
        justify-content: center;
        text-align: center;
        padding: 15px;
    }
    
    .custom-responsive-table td[data-label="Plan Details"]::before {
        display: none;
    }
    
    .plan-tag {
        padding: 5px 10px;
        margin: 3px;
        font-size: 12px;
        border-radius: 30px;
        display: inline-block;
        background-color: #e9ecef;
        color: #333;
    }
    
    /* Style expiry status */
    .custom-responsive-table td[data-label="Expiry Status"] {
        justify-content: center;
        text-align: center;
        padding: 15px;
    }
    
    .custom-responsive-table td[data-label="Expiry Status"]::before {
        display: none;
    }
    
    .expiry-badge {
        padding: 5px 15px;
        border-radius: 30px;
        margin-bottom: 5px;
        display: inline-block;
        font-weight: 600;
    }
    
    .time-left {
        display: block;
        margin-top: 5px;
        color: #777;
        font-size: 12px;
    }
    
    /* Style contact info */
    .custom-responsive-table td[data-label="Contact"] {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 15px;
    }
    
    .custom-responsive-table td[data-label="Contact"]::before {
        display: none;
    }
    
    .custom-responsive-table td[data-label="Contact"] i {
        margin-right: 5px;
        width: 16px;
        text-align: center;
    }
    
    /* Fix action buttons */
    .custom-responsive-table td.action-column {
        flex-direction: column;
        padding: 15px;
        border-bottom: none;
    }
    
    .custom-responsive-table td.action-column::before {
        display: none;
    }
    
    .action-column .btn-action {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
    }
    
    .action-column .btn-action:last-child {
        margin-bottom: 0;
    }
    
    /* Fix summary boxes for mobile */
    .summary-box {
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .summary-box h3 {
        font-size: 24px;
        margin-bottom: 5px;
    }
    
    .summary-box p {
        font-size: 14px;
        margin-bottom: 0;
    }
    
    /* Mobile filter area */
    #filterForm {
        padding: 15px;
    }
    
    #filterForm .form-control {
        margin-bottom: 10px;
    }
    
    .filter-label {
        font-size: 14px;
        margin-bottom: 5px;
        display: block;
        font-weight: 500;
    }
    
    /* Card footer and pagination */
    .card-footer {
        padding: 15px;
        text-align: center;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 10px;
    }
    
    .pagination .page-link {
        padding: 5px 10px;
        font-size: 14px;
    }
}

/* Updated Responsive Table CSS for Mobile Devices */

/* Remove the card-based mobile view and implement a scrollable table */
@media (max-width: 767px) {
    /* Table container with horizontal scroll */
    .card-body.table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0;
    }
    
    /* Keep the regular table structure */
    .custom-responsive-table {
        width: 100%;
        min-width: 850px; /* Minimum width to ensure all columns display properly */
    }
    
    /* Make sure table headers remain visible */
    .custom-responsive-table thead {
        display: table-header-group;
    }
    
    /* Normal table row display */
    .custom-responsive-table tbody,
    .custom-responsive-table tr {
        display: table-row-group;
        width: auto;
    }
    
    .custom-responsive-table tr {
        display: table-row;
    }
    
    /* Normal table cell display */
    .custom-responsive-table td {
        display: table-cell;
        padding: 8px 12px;
        vertical-align: middle !important;
        border-bottom: 1px solid #dee2e6;
    }
    
    /* Remove the data-label display */
    .custom-responsive-table td::before {
        content: none;
    }
    
    /* Adjust cell widths for better display */
    .custom-responsive-table td[data-label="ID"] {
        width: 8%;
    }
    
    .custom-responsive-table td.profile-column {
        width: 10%;
        text-align: center;
    }
    
    .custom-responsive-table td[data-label="Member Info"] {
        width: 15%;
    }
    
    .custom-responsive-table td[data-label="Plan Details"] {
        width: 18%;
    }
    
    .custom-responsive-table td[data-label="Expiry Status"] {
        width: 15%;
    }
    
    .custom-responsive-table td[data-label="Contact"] {
        width: 14%;
    }
    
    .custom-responsive-table td.action-column {
        width: 20%;
    }
    
    /* Reduce image size slightly */
    .profile-img {
        width: 45px;
        height: 45px;
    }
    
    /* Make action buttons more compact */
    .action-column .btn-action {
        padding: 5px 8px;
        font-size: 12px;
        margin-bottom: 4px;
        display: inline-block;
    }
    
    /* Make plan tags more compact */
    .plan-tag {
        padding: 2px 6px;
        font-size: 11px;
        margin-right: 2px;
    }
    
    /* Make expiry badges more compact */
    .expiry-badge {
        padding: 2px 8px;
        font-size: 11px;
    }
    
    /* Improve filter form on mobile */
    #filterForm {
        padding: 10px;
    }
    
    .filter-label {
        font-size: 13px;
        margin-bottom: 3px;
    }
    
    /* Improve pagination on mobile */
    .card-footer {
        padding: 10px;
    }
    
    .pagination .page-link {
        padding: 4px 8px;
        font-size: 13px;
    }
}

/* iPhone-specific tweaks */
@media (min-width: 375px) and (max-width: 428px) {
    /* Ensure the table is scrollable */
    .card-body.table-responsive {
        margin: 0 -10px; /* Increase visible area slightly */
    }
}

/* Small devices (landscape phones) */
@media (min-width: 429px) and (max-width: 767px) {
    /* Slightly better display on landscape orientation */
    .card-body.table-responsive {
        margin: 0 -5px;
    }
    
    .custom-responsive-table {
        min-width: 800px;
    }
}

/* Medium devices (tablets) adjustments */
@media (min-width: 768px) and (max-width: 991px) {
    .profile-img {
        width: 50px;
        height: 50px;
    }
    
    .action-column {
        min-width: 160px;
    }
    
    .btn-action {
        padding: 5px 7px;
        font-size: 12px;
        margin-bottom: 4px;
    }
}
</style>

@endsection