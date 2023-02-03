<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('hospital_access')
            <li class="c-sidebar-nav-item">
                <a
                    @if(\Auth::user()->isHospital())
                        href="{{ url("/admin/hospitals/".Auth::user()->hospital->id."/edit")  }}"
                    @else
                        href="{{ route("admin.hospitals.index") }}"
                    @endif
                   class="c-sidebar-nav-link {{ request()->is("admin/hospitals") || request()->is("admin/hospitals/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-h-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.hospital.title') }}
                </a>
            </li>
        @endcan
        @can('patient_record_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/patients*") ? "c-show" : "" }} {{ request()->is("admin/surgeries*") ? "c-show" : "" }} {{ request()->is("admin/diseases*") ? "c-show" : "" }} {{ request()->is("admin/vaccines*") ? "c-show" : "" }} {{ request()->is("admin/allergies*") ? "c-show" : "" }} {{ request()->is("admin/medicines*") ? "c-show" : "" }} {{ request()->is("admin/patient-medicines*") ? "c-show" : "" }} {{ request()->is("admin/patient-visits*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.patientRecord.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('patient_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.patients.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/patients") || request()->is("admin/patients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-wheelchair c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.patient.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('surgery_access')
                        <li class="c-sidebar-nav-item">
                            <a
                                @if(\Auth::user()->isHospital())
                                    href="{{ route('admin.surgeries.create') }}"
                                @else
                                    href="{{ route("admin.surgeries.index") }}"
                                @endif
                               class="c-sidebar-nav-link {{ request()->is("admin/surgeries") || request()->is("admin/surgeries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cut c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.surgery.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('disease_access')
                        <li class="c-sidebar-nav-item">
                            <a
                                @if(\Auth::user()->isHospital())
                                    href="{{ route("admin.diseases.create") }}"
                                @else
                                    href="{{ route("admin.diseases.index") }}"
                                @endif
                                class="c-sidebar-nav-link {{ request()->is("admin/diseases") || request()->is("admin/diseases/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bug c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.disease.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('vaccine_access')
                        <li class="c-sidebar-nav-item">
                            <a
                                @if(\Auth::user()->isHospital())
                                    href="{{ route("admin.vaccines.create") }}"
                                @else
                                    href="{{ route("admin.vaccines.index") }}"
                                @endif

                               class="c-sidebar-nav-link {{ request()->is("admin/vaccines") || request()->is("admin/vaccines/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-syringe c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.vaccine.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('allergy_access')
                        <li class="c-sidebar-nav-item">
                            <a
                                @if(\Auth::user()->isHospital())
                                    href="{{ route("admin.allergies.create") }}"
                                @else
                                    href="{{ route("admin.allergies.index") }}"
                                @endif

                               class="c-sidebar-nav-link {{ request()->is("admin/allergies") || request()->is("admin/allergies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-allergies c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.allergy.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('medicine_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.medicines.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/medicines") || request()->is("admin/medicines/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-prescription-bottle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.medicine.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('patient_medicine_access')
                        <li class="c-sidebar-nav-item">
                            <a
                                @if(\Auth::user()->isHospital())
                                    href="{{ route("admin.patient-medicines.create") }}"
                                @else
                                    href="{{ route("admin.patient-medicines.index") }}"
                                @endif
                               class="c-sidebar-nav-link {{ request()->is("admin/patient-medicines") || request()->is("admin/patient-medicines/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-prescription-bottle-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.patientMedicine.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('patient_visit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.patient-visits.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/patient-visits") || request()->is("admin/patient-visits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.patientVisit.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                       href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
               onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
