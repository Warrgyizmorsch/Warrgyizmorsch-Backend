<x-crm.layout.app>
    <!-- PAGE HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center ">

        <!-- LEFT SIDE -->
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">
                    User
                </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">
                    Profile
                </li>
            </ul>
        </div>
    </div>
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-xxl-4 col-xl-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3 rounded-circle overflow-hidden" style="object-fit: cover;">
                                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('/images/blank.jpeg') }}" alt="" class="img-fluid rounded-circle" style="width:150px;height:150px;object-fit:cover;cursor:pointer;">
                                </div>
                                <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle" style="top:76%; right:10px">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                            </div>
                            <div class="mb-4">
                                <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $user->name }}</a>
                                <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $user->email }}</a>
                            </div>
                            {{-- <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">28.65K</h6>
                                            <p class="fs-12 text-muted mb-0">Followers</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">38.85K</h6>
                                            <p class="fs-12 text-muted mb-0">Following</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">43.67K</h6>
                                            <p class="fs-12 text-muted mb-0">Engagement</p>
                                        </div>
                                    </div> --}}
                        </div>
                        <ul class="list-unstyled mb-4">
                            <!-- <li class="hstack justify-content-between mb-4">
                                <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Address</span>
                                <a href="javascript:void(0);" class="float-end">{{ $user->address }}</a>
                            </li> -->
                            <li class="hstack justify-content-between mb-4">
                                <span class="text-muted fw-medium hstack gap-3"><i class="feather-phone"></i>Phone</span>
                                <a href="javascript:void(0);" class="float-end">{{ $user->contact_no }}</a>
                            </li>
                            <li class="hstack justify-content-between mb-0">
                                <span class="text-muted fw-medium hstack gap-3"><i class="feather-mail"></i>Email</span>
                                <a href="javascript:void(0);" class="float-end" style="max-width: 220px; word-break: break-all;">{{ $user->email }}</a>
                            </li>
                        </ul>
                        <div class="d-flex gap-2 text-center pt-4">
                            {{-- <a href="javascript:void(0);" class="w-50 btn btn-light-brand">
                                        <i class="feather-trash-2 me-2"></i>
                                        <span>Delete</span>
                                    </a> --}}
                            <a href="javascript:void(0);" id="editProfileBtn" onclick="openEditProfile()" class="w-50 btn btn-primary">
                                <i class="feather-edit me-2"></i>
                                <span>Edit Profile</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xxl-8 col-xl-6">
                <div id="viewProfileSection">
                    <div class="card border-top-0">
                        <div class="card-header p-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Details</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#securityTab" role="tab">Security</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="about-section mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Profile About:</h5>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Updates</a>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 fw-bold text-dark">Full Name:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->name }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 fw-bold text-dark">Mobile Number:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->contact_no }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 fw-bold text-dark">Email:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->email }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 fw-bold text-dark">Role:</div>
                                        <div class="col-sm-6 fw-semibold">
                                            @if($user->role)
                                            @php
                                            $displayRole = $user->role->name;
                                            @endphp

                                            @if($displayRole == 'Admin')
                                            <span class="text-primary fw-bold">{{ $displayRole }}</span>

                                            @elseif($displayRole == 'HOD')
                                            <span class="text-primary fw-bold">Head of Department</span>

                                            @elseif($displayRole == 'Supervisor')
                                            <span class="text-primary fw-bold">{{ $displayRole }}</span>

                                            @else
                                            <span class="text-muted">{{ $displayRole }}</span>
                                            @endif

                                            @else
                                            <span class="text-muted">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="row g-0 mb-4">
                                        <div class="col-sm-6 fw-bold text-dark">Address:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->address }}</div>
                                    </div> -->
                                </div>
                            </div>

                            <div class="tab-pane fade p-4" id="securityTab" role="tabpanel">
                                <h5 class="fw-bold mb-3">Change Password</h5>
                                <form method="POST" action="{{ route('profile.passwprdUpdate') }}" class="mt-3">
                                    @csrf
                                    @method('put')
                                    @if(auth()->user()->role_id === 1)
                                    <div class="mb-3">
                                        <label class="form-label">Users</label>
                                        <select name="user_id" class="form-control"  data-select2-selector="status" >
                                            <option value="">-- Select User --</option>
                                            @foreach($users as $u)
                                            <option value="{{ $u->id }}" {{ $u->id == auth()->id() ? 'selected' : '' }}>
                                                {{ $u->name }} / {{ $u->contact_no }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary px-4">Update Password</button>

                                    @if (session('status') === 'password-updated')
                                    <p class="text-success mt-3">Saved.</p>
                                    @endif
                                </form>
                            </div>


                        </div>
                    </div>
                </div>

                <div id="editProfileSection" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Profile</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- IMAGE -->
                                <div class="text-center mb-4 position-relative d-inline-block">
                                    <label for="edit_image" class="position-relative" style="cursor:pointer;">
                                        <img id="editProfilePreview"
                                            src="{{ $user->image ? asset('storage/' . $user->image) : asset('/images/blank.jpeg') }}"
                                            class="rounded-circle border"
                                            style="width:120px;height:120px;object-fit:cover;">

                                        <!-- Camera Icon -->
                                        <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:35px;height:35px;">
                                            <i class="feather-camera"></i>
                                        </span>
                                    </label>

                                    <input type="file" name="image" id="edit_image" class="d-none" onchange="previewImage(this)">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" name="mobile" class="form-control" value="{{ $user->contact_no }}">
                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                                </div> -->

                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-light" onclick="closeEditProfile()">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function openEditProfile() {
            document.getElementById('viewProfileSection').style.display = 'none';
            document.getElementById('editProfileSection').style.display = 'block';

            document.getElementById('editProfileBtn').style.display = 'none';
        }

        function closeEditProfile() {
            document.getElementById('editProfileSection').style.display = 'none';
            document.getElementById('viewProfileSection').style.display = 'block';

            document.getElementById('editProfileBtn').style.display = 'inline-block';

        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('editProfilePreview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- [ Main Content ] end -->
</x-crm.layout.app>
