<div class="modal fade" id="editProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="profileForm" enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img id="currentProfileImage" src="{{ asset(Auth::user()->image_url) }}" alt="Profile" style="max-width: 150px; max-height: 150px;">
                            <div class="pt-2">
                                <label class="btn btn-primary btn-sm" title="Upload new profile image">
                                    <i class="bi bi-upload"></i>
                                    <input type="file" name="profile_image" id="profileImageInput" hidden>
                                </label>
                                <button type="button" class="btn btn-danger btn-sm" id="removeProfileImage" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control" id="fullName" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
