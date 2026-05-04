



{{-- <div class="row">
    <div class="col-xxl-12 col-xl-12">
        <div class="card stretch stretch-full">
            <div class="card-body">

                <!-- PROFILE HEADER -->
                <div class="mb-4 text-center">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                        <label for="image">
                            <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3" style="cursor:pointer;">
                                <img src="{{ $user->image ? asset($user->image) : asset('assets/profile.png') }}"
                                    alt="Profile" class="img-fluid rounded-circle" style="object-fit: cover;">
                            </div>
                        </label>
                        <input type="file" name="image" id="image" class="d-none">
                        <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle"
                            style="top: 76%; right: 10px">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                    </div>
                    

                    <div class="mb-4">
                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block">{{ $user->name }}</a>
                        <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $user->email }}</a>
                    </div>
                    

                    <!-- TABS -->
                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                        <div class="flex-fill py-3 px-4 rounded-1 border border-dashed border-gray-5 tab-btn active"
                             data-tab="detailsTab">
                            Personal Details
                        </div>
                        <div class="flex-fill py-3 px-4 rounded-1 border border-dashed border-gray-5 tab-btn"
                             data-tab="securityTab">
                            Security
                        </div>
                    </div>
                    </form>
                </div>

                <!-- DETAILS TAB -->
                <div id="detailsTab" class="tab-content active">
                    <h5 class="fw-bold mb-3">Profile Details</h5>

                    <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-2"><strong>Mobile:</strong> {{ $user->mobile }}</p>

                    <!-- ROLE FIXED -->
                    <p class="mb-2">
                        <strong>Role:</strong>

                        @if($user->role)
                            @php
                                $displayRole = $user->role->name;
                            @endphp

                            @if($displayRole == 'Admin')
                                <span class="text-primary fw-bold">{{ $displayRole }}</span>

                            @elseif($displayRole == 'HOD')
                                <span class="text-success fw-bold">Head of Department</span>

                            @elseif($displayRole == 'Supervisor')
                                <span class="text-warning fw-bold">{{ $displayRole }}</span>

                            @else
                                <span class="text-muted">{{ $displayRole }}</span>
                            @endif

                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                </div>

                <!-- SECURITY TAB -->
                <div id="securityTab" class="tab-content" style="display:none;">
                    <h5 class="fw-bold mb-3">Change Password</h5>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-3">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" autocomplete="current-password">
                            @if($errors->updatePassword->has('current_password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('current_password') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                            @if($errors->updatePassword->has('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                            @if($errors->updatePassword->has('password_confirmation'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Update Password</button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success mt-3">
                                Saved.
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-btn { cursor: pointer; }
    .tab-btn.active { background: #f1f1f1; }
    .tab-content { transition: .3s; }
</style>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');

            this.classList.add('active');
            document.getElementById(this.dataset.tab).style.display = 'block';
        });
    });
</script> --}}