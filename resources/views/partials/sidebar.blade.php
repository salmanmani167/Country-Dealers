<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ route_is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                </li>
                @employee
                @feature('attendance')
                {{-- <li class="{{ route_is('attendance') ? 'active' : '' }}">
                    <a href="{{route('attendance')}}"><i class="la la-dashboard"></i> <span> Attendance</span></a>
                </li> --}}
                @endfeature
                @endemployee
                @if (auth()->user()->is_employee != 1 && auth()->user()->is_client != 1)
                    @feature('apps')
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @feature('calendar')
                            @can('view-calendar')
                            <li><a class="{{route_is('apps.calendar') ? 'active': ''}}" href="{{route('apps.calendar')}}">Calendar</a></li>
                            @endcan
                            @endfeature
                            @feature('filemanager')
                            <li><a class="{{route_is('apps.filemanager') ? 'active': ''}}" href="{{route('apps.filemanager')}}">File Manager</a></li>
                            @endfeature
                        </ul>
                    </li>
                    @endfeature
                    @feature('company')
                    <li class="menu-title">
                        <span>Company</span>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0)" class="noti-dot"><i class="la la-building"></i> <span> Company</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @feature('employees')
                            <li><a class="{{route_is('employees.index') ? 'active': ''}}" href="{{route('employees.index')}}">All Employees</a></li>
                            @endfeature
                            @feature('attendance')
                            <li><a class="{{route_is('admin.attendance') ? 'active': ''}}" href="{{route('admin.attendance')}}">Attendance</a></li>
                            @endfeature
                            <li><a class="{{route_is('departments.index') ? 'active': ''}}" href="{{route('departments.index')}}">Departments</a></li>
                            <li><a class="{{route_is('designations.index') ? 'active': ''}}" href="{{route('designations.index')}}">Designations</a></li>
                            @feature('holidays')
                            <li><a class="{{route_is('holidays.index') ? 'active': ''}}" href="{{route('holidays.index')}}">Holidays</a></li>
                            @endfeature
                            @feature('vacations')
                            <li><a class="{{route_is('leave-types.index') ? 'active': ''}}" href="{{route('leave-types.index')}}">Vacation Type</a></li>
                            <li><a class="{{route_is('leaves.index') ? 'active': ''}}" href="{{route('leaves.index')}}">Vacations</a></li>
                            @endfeature
                            @feature('timesheet')
                            <li><a class="{{route_is('timesheet') ? 'active': ''}}" href="{{route('timesheet')}}">Time Sheet</a></li>
                            @endfeature
                            @feature('overtime')
                            <li><a class="{{route_is('overtime') ? 'active': ''}}" href="{{route('overtime')}}">Overtime</a></li>
                            @endfeature
                            @feature('shifts')
                            <li><a class="{{route_is('shifts.index') ? 'active': ''}}" href="{{route('shifts.index')}}">Shifts</a></li>
                            <li><a class="{{route_is('schedules.index') ? 'active': ''}}" href="{{route('schedules.index')}}">Shift Schedules</a></li>
                            @endfeature
                            <li><a class="{{route_is('houses.index') ? 'active': ''}}" href="{{route('houses.index')}}">Houses</a></li>
                            <li><a class="{{route_is('agencies.index') ? 'active': ''}}" href="{{route('agencies.index')}}">Agency</a></li>
                        </ul>
                    </li>
                    @endfeature
                    @feature('clients')
                    <li>
                        <a href="{{route('clients.index')}}"><i class="la la-users"></i> <span>Clients</span></a>
                    </li>
                    @endfeature
                    @feature('projects')
                    <li class="submenu">
                        <a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{route_is('projects.index') ? 'active': ''}}" href="{{route('projects.index')}}">Projects</a></li>
                        </ul>
                    </li>
                    @endfeature
                    @feature('leads')
                    @can('view-projects')
                    <li class="{{route_is('projects.leads') ? 'active': ''}}">
                        <a href="{{route('projects.leads')}}"><i class="la la-user-secret"></i> <span>Leads</span></a>
                    </li>
                    @endcan
                    @endfeature
                    @feature('tickets')
                    @can('view-tickets')
                    <li class="{{route_is('tickets') ? 'active': ''}}">
                        <a href="{{route('tickets')}}"><i class="la la-ticket"></i> <span>Tickets</span></a>
                    </li>
                    @endcan
                    @endfeature
                    <li class="menu-title">
                        <span>HR</span>
                    </li>
                    @feature('accounts')
                    <li class="submenu">
                        <a href="#"><i class="la la-files-o"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @feature('invoices')
                            <li><a class="{{ route_is('invoices.*') ? 'active' : '' }}" href="{{route('invoices.index')}}">Invoices</a></li>
                            @endfeature
                            @feature('expenses')
                            <li><a class="{{ route_is('expenses') ? 'active' : '' }}" href="{{route('expenses')}}">Expenses</a></li>
                            @endfeature
                            @feature('provident-fund')
                            <li><a class="{{ route_is('provident-funds') ? 'active' : '' }}" href="{{route('provident-funds')}}">Provident Fund</a></li>
                            @endfeature
                            @feature('taxes')
                            <li><a class="{{ route_is('taxes') ? 'active' : '' }}" href="{{route('taxes')}}">Taxes</a></li>
                            @endfeature
                            @feature('products')
                            <li><a class="{{ route_is('products') ? 'active' : '' }}" href="{{route('products')}}">Products</a></li>
                            @endfeature
                            @feature('sales')
                            <li><a class="{{ route_is('sales.index') ? 'active' : '' }}" href="{{route('sales.index')}}">Sales</a></li>
                            @endfeature
                        </ul>
                    </li>
                    @endfeature
                    @feature('policies')
                    <li class="{{route_is('policies.index') ? 'active': ''}}">
                        <a href="{{route('policies.index')}}"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
                    </li>
                    @endfeature
                    @feature('jobs')
                    <li class="submenu">
                        <a href="#"><i class="la la-briefcase"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ route_is('jobs') ? 'active' : '' }}" href="{{route('jobs')}}"> Manage Jobs </a></li>
                            <li><a class="{{ route_is('job-applicants') ? 'active' : '' }}" href="{{route('job-applicants')}}"> Applied Candidates </a></li>
                        </ul>
                    </li>
                    @endfeature
                    @feature('reports')
                    <li class="submenu">
                        <a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ route_is('reports.expense') ? 'active' : '' }}" href="{{route('reports.expense')}}">Expense Report</a></li>
                            <li><a class="{{ route_is('reports.invoice') ? 'active' : '' }}" href="{{route('reports.invoice')}}">Invoice Report</a></li>
                        </ul>
                    </li>
                    @endfeature
                    @feature('goals')
                    @canany(['view-goals', 'view-goalTypes'])
                    <li class="submenu">
                        <a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @can('view-goals')
                            <li><a class="{{ route_is('goals') ? 'active' : '' }}" href="{{route('goals')}}"> Goal List </a></li>
                            @endcan
                            @can('view-goalTypes')
                            <li><a class="{{ route_is('goal-types') ? 'active' : '' }}" href="{{route('goal-types')}}"> Goal Type </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany
                    @endfeature
                    @feature('assets')
                    @can('view-assets')
                    <li class="{{ route_is('assets') ? 'active' : '' }}">
                        <a href="{{route('assets')}}"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
                    </li>
                    @endcan
                    @endfeature
                    @can('view-users')
                    <li class="menu-title">
                        <span>User</span>
                    </li>

                    <li class="{{route_is('users.index') ? 'active': ''}}">
                        <a href="{{route('users.index')}}"><i class="la la-user-plus"></i> <span>Users</span></a>
                    </li>

                    <li class="{{route_is('users.index') ? 'active': ''}}">
                        <a href="{{route('employees.index')}}"><i class="la la-user-plus"></i> <span>Employee</span></a>
                    </li>

                    @endcan
                    @can('view-roles')
                    <li class="{{route_is('roles.index') ? 'active': ''}}">
                        <a href="{{route('roles.index')}}"><i class="la la-key"></i> <span>Roles & Permissions</span></a>
                    </li>
                    @endcan
                    @feature('announcement')
                    <li class="{{route_is('user.notifications') ? 'active': ''}}">
                        <a href="{{route('user.notifications')}}"><i class="la la-bell"></i> <span>Announcement</span></a>
                    </li>
                    @endfeature
                    <li class="menu-title">
                        <span>Settings</span>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0)"><i class="la la-cogs"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{route_is('settings.company') ? 'active': ''}}" href="{{route('settings.company')}}">Company Settings</a></li>
                            <li><a class="{{route_is('settings.theme') ? 'active': ''}}" href="{{route('settings.theme')}}">Theme Settings</a></li>
                            <li><a class="{{route_is('settings.invoice') ? 'active': ''}}" href="{{route('settings.invoice')}}">Invoice Settings</a></li>
                            <li><a class="{{route_is('settings.attendance') ? 'active': ''}}" href="{{route('settings.attendance')}}">Attendance Settings</a></li>
                            <li><a class="{{route_is('settings.features') ? 'active': ''}}" href="{{route('settings.features')}}">App Features</a></li>
                        </ul>
                    </li>
                    @feature('backups')
                    <li class="{{ route_is('backups') ? 'active' : '' }}">
                        <a href="{{ route('backups') }}"
                            ><i class="la la-cloud-upload"></i> <span>Backups </span>
                        </a>
                    </li>
                    @endfeature
                @endif
                <li class="mt-1">
                    <form action="{{route('logout')}}" id="user_logout_form" method="post">
                        @csrf
                        <a href="javascript:void(0)" onclick="$('#user_logout_form').trigger('submit')"><i class="la la-sign-out ml-0"></i> <span class="ml-2">Logout</span></a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
