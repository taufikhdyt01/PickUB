document.addEventListener('DOMContentLoaded', function () {
    const signOutBtn = document.getElementById('sign-out-btn');
    if (signOutBtn) {
        signOutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('logout-form').submit();
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const profileImageInput = document.getElementById('profileImageInput');
    const currentProfileImage = document.getElementById('currentProfileImage');
    const removeProfileImageButton = document.getElementById('removeProfileImage');
    const profileForm = document.getElementById('profileForm');

    profileImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                currentProfileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    removeProfileImageButton.addEventListener('click', function () {
        currentProfileImage.src = '/media/default.jpeg';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'remove_image';
        input.value = 'true';
        profileForm.appendChild(input);
    });
});



