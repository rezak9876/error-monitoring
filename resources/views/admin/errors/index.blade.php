@extends('admin.layouts.app')

@section('body')
    @if (Session::has('message'))
        <div class="toast-container position-absolute p-3 top-0 end-0" id="toastPlacement"
            data-original-class="toast-container position-absolute p-3">
            <div class="toast fade show">
                <div class="toast-header">
                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <rect width="100%" height="100%" fill="green"></rect>
                    </svg>
                </div>
                <div class="toast-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table border mb-0">
            <thead class="table-light fw-semibold">
                <tr class="align-middle">
                    <th class="text-center">
                        <svg class="icon">
                            <use xlink:href="/coreui/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                        </svg>
                    </th>
                    <th>Message</th>
                    <th>Count</th>
                    <th class="text-center">Country</th>
                    <th>Usage</th>
                    <th class="text-center">Payment Method</th>
                    <th>Activity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($errors as $error)
                    <tr class="align-middle">
                        <td class="text-center">
                            <div class="avatar avatar-md"><img class="avatar-img" src="/coreui/assets/img/avatars/1.jpg"
                                    alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                        </td>
                        <td>
                            <div><a href="{{ route('errors.show', $error->id) }}">{{ $error->message }}</a>
                            </div>
                            <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary rounded-pill">{{ $error->count }}</button>
                        </td>
                        </td>
                        <td class="text-center">
                            <svg class="icon icon-xl">
                                <use xlink:href="/coreui/vendors/@coreui/icons/svg/flag.svg#cif-us"></use>
                            </svg>
                        </td>
                        <td>
                            <div class="clearfix">
                                <div class="float-start">
                                    <div class="fw-semibold">50%</div>
                                </div>
                                <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul
                                        10, 2020</small></div>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center">
                            <svg class="icon icon-xl">
                                <use xlink:href="/coreui/vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard">
                                </use>
                            </svg>
                        </td>
                        <td>
                            <div class="small text-medium-emphasis">Last login</div>
                            <div class="fw-semibold">10 sec ago</div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon">
                                        <use xlink:href="/coreui/vendors/@coreui/icons/svg/free.svg#cil-options">
                                        </use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a
                                        class="dropdown-item text-danger" href="#">Delete</a></div>
                            </div>
                        </td>
                    @empty
                        <p>No Error</p>
                @endforelse
                </tr>
            </tbody>
        </table>
    </div>

    {{ $errors->links() }}
@endsection
