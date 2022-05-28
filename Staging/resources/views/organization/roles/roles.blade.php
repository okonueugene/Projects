@extends('layouts.organization')

@section('title')
    Roles and Permissions
@endsection

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Access Roles</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#modalForm">Add Role</button>
                                            </li>
                                            <li><a href="#" class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-download-cloud"></em><span>Back</span></a></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <p>A user must have a <strong class="text-primary">Role and Permission</strong> to be able
                                    to complete a transaction.</p>
                            </div>
                        </div>
                        <div id="accordion" class="accordion">
                            @foreach ($role_permissions as $key => $role)
                                <div class="accordion-item">
                                    <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                        data-target="#accordion-item-{{ $role->id }}">
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <h6 class="title d-inline">{{ $role->name }}
                                                    {{-- {{ $role->id = '1' ? '(Default Role)' : '' }} --}}
                                                </h6>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="badge badge-info badge-sm"><em
                                                        class="icon ni ni-users mr-1"></em> {{ $role->users->count() }}
                                                    Member(s)</span>
                                            </div>
                                            <div class="col-md-4">
                                                <button
                                                    class="btn d-inline btn-round btn-sm btn-secondary float-right">Permissions
                                                    ({{ $role->permissions->count() }})</button>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="accordion-body collapse" id="accordion-item-{{ $role->id }}"
                                        data-parent="#accordion">
                                        <div class="accordion-inner">
                                            @if ($role->permissions->count() > 0)
                                                <div class="row text-center gy-4">
                                                    @foreach ($role['permissions'] as $perm)
                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="preview-block">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" checked
                                                                        class="custom-control-input" id="customCheck1">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck1">{{ $perm->name }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-center">No permissions associated with this role</p>
                                            @endif
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <button type="submit" onclick="handleUpdate({{ $role->id }})"
                                                        class="btn btn-sm btn-secondary"><span>Edit
                                                            </span></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="{{ route('org.roles.destroy', $role->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn float-right btn-icon btn-sm btn-danger"><em
                                                                class="icon ni ni-trash"></em></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form -->
    <div class="modal fade" tabindex="-1" id="modalForm">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('org.roles.store') }}" method="POST" class="form-validate is-alter">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="pay-amount">Role name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="name" id="pay-amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Access Permissions</label>
                            <div class="row gy-4">
                                @foreach ($permissions as $value)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="preview-block">
                                            <div class="custom-control custom-checkbox">
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'form-check-input']) }}
                                                    {{ $value->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Askari Technologies</span>
                </div>
            </div>
        </div>
    </div>
@endsection

