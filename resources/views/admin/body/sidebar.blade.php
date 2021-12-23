@php
    $routeName = Route::current()->getName();
    $routeSegment =request()->segment(2);
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
                        <h3><b>School Management System</b></h3>
                    </div>
                </a>
            </div>
        </div>
        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ ($routeName == 'dashboard') ? 'active' :''}}">
                <a href="{{ route('dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role =='Admin')
            <li class="treeview {{ ($routeSegment === 'users') ? 'active' :''}}" >
                <a href="#">
                    <i class="fa fa-group" aria-hidden="true"></i>
                    <span>Manage User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('users.index') }}"><i class="ti-more"></i>View User</a></li>
                    <li><a href="{{ route('users.create') }}"><i class="ti-more"></i>Add User</a></li>
                </ul>
            </li>
            @endif

            <li class="treeview {{ ($routeSegment === 'profile') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('profile.index')}}"><i class="ti-more"></i>Your Profile</a></li>
                    <li><a href="{{ route('ChangePassword') }}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>


            <li class="treeview {{ ($routeSegment === 'setup') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-gears" aria-hidden="true"></i><span>Setup Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('studentClass.index')}}"><i class="ti-more"></i>Student Class</a></li>
                    <li><a href="{{ route('studentYear.index') }}"><i class="ti-more"></i>Student Year</a></li>
                    <li><a href="{{ route('studentGroup.index') }}"><i class="ti-more"></i>Student Group</a></li>
                    <li><a href="{{ route('studentShift.index') }}"><i class="ti-more"></i>Student Shift</a></li>
                    <li><a href="{{ route('feeCategory.index') }}"><i class="ti-more"></i>Fee Category</a></li>
                    <li><a href="{{ route('feeAmount.index') }}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li><a href="{{ route('examType.index') }}"><i class="ti-more"></i>Exam Type</a></li>
                    <li><a href="{{ route('schoolSubject.index') }}"><i class="ti-more"></i>School Subject</a></li>
                    <li><a href="{{ route('assignSubject.index') }}"><i class="ti-more"></i>Assign Subject</a></li>
                    <li><a href="{{ route('designation.index') }}"><i class="ti-more"></i>Designation</a></li>
                </ul>
            </li>

            <li class="treeview {{ ($routeSegment === 'students') ? 'active' :''}}">
                <a href="#">
                    <i class="mdi mdi-account-settings"></i><span>Student Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('registration.index')}}"><i class="ti-more"></i>Student Registration</a></li>
                    <li><a href="{{ route('rollGenerate.index')}}"><i class="ti-more"></i>Roll Generate</a></li>
                    <li><a href="{{ route('registrationFee.index')}}"><i class="ti-more"></i>Registration Fee</a></li>
                    <li><a href="{{ route('monthlyFee.index')}}"><i class="ti-more"></i>Monthly Fee</a></li>
                    <li><a href="{{ route('examFee.index')}}"><i class="ti-more"></i>Exam Fee</a></li>
                </ul>

            </li>

            <li class="treeview {{ ($routeSegment === 'employees') ? 'active' :''}}">
                <a href="#">
                    <i class="ti-user"></i><span>Employee Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('employeeRegistration.index')}}"><i class="ti-more"></i>Employee Registration</a></li>
                    <li><a href="{{ route('employeeSalary.index')}}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li><a href="{{ route('employeeLeave.index')}}"><i class="ti-more"></i>Employee Leave</a></li>
                    <li><a href="{{ route('employeeAttendance.index')}}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li><a href="{{ route('monthlySalary.index')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
                </ul>

            </li>


            <li class="treeview {{ ($routeSegment === 'marks') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>Marks Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('marksManagement.index')}}"><i class="ti-more"></i>Marks Entry</a></li>
                    <li><a href="{{ route('marksEdit')}}"><i class="ti-more"></i>Marks Edit</a></li>
                    <li><a href="{{ route('marksGrade.index')}}"><i class="ti-more"></i>Marks Grade</a></li>
                </ul>
            </li>

            <li class="treeview {{ ($routeSegment === 'accountsManagement') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-money" aria-hidden="true"></i><span>Accounts Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('studentFee.index')}}"><i class="ti-more"></i>Student Fee</a></li>
                    <li><a href="{{ route('accountEmployeeSalary.index')}}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li><a href="{{ route('otherCost.index')}}"><i class="ti-more"></i>Other Cost</a></li>
                </ul>
            </li>

            <li class="treeview {{ ($routeSegment === 'reports') ? 'active' :''}}">
                <a href="#">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i><span>Reports Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('monthlyProfit')}}"><i class="ti-more"></i>Monthly-Yearly Profit</a></li>
                    <li><a href="{{ route('markSheet')}}"><i class="ti-more"></i>Marks Sheet Generate </a></li>
                    <li><a href="{{ route('attendanceReport')}}"><i class="ti-more"></i>Attendance Report</a></li>
                    <li><a href="{{ route('resultReport')}}"><i class="ti-more"></i>Student Result</a></li>
                    <li><a href="{{ route('studentIdCard')}}"><i class="ti-more"></i>Student ID Card</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
