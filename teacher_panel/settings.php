<?php include('partials/_header_revised.php') ?>
<?php 
$check = '10'; 
$active_page = 'settings';
?>
<link rel="stylesheet" href="settings-style.css">

<div class="modal fade" id="edit-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class='bx bx-help-circle text-primary' style="font-size: 3rem;"></i>
                <p class="mt-3">Are you sure you want to modify your profile settings?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="EditProfileBtn">Confirm Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change-password-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title"><i class='bx bxs-key text-warning'></i> Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="changePasswordForm" novalidate>
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirmPassword" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary w-100" id="savePasswordBtn">
                        <i class='bx bx-check-double'></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("partials/_navbar.php"); ?>

<div class="container">
    <!-- Standardized Sidebar -->
    <?php include("partials/_sidebar.php"); ?>

    <main>
        <div class="header mb-4">
            <div class="left">
                <h1>Settings</h1>
            </div>
        </div>

        <div class="settings-grid">
            <!-- Profile Image Card -->
            <div class="profile-media">
                <div class="card shadow-sm border-0 premium-card">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0"><i class='bx bx-user-circle text-primary'></i> Avatar</h5>
                    </div>
                    <div class="card-body text-center">
                        <div id="profileImageBox" class="mb-3 d-flex justify-content-center">
                            <img src="<?php echo $img_src; ?>" class="rounded-circle shadow-sm" style="width: 160px; height: 160px; object-fit: cover; border: 4px solid #fff;" id="profile-image-user">
                        </div>
                        <input type="file" id="fileInp" accept="image/*" class="d-none">
                        <button class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="document.getElementById('fileInp').click()">
                            <i class='bx bx-upload'></i> Change Photo
                        </button>
                        <button class="btn btn-warning btn-sm w-100" data-bs-toggle="modal" data-bs-target="#change-password-model">
                            <i class='bx bx-lock-alt'></i> Change Password
                        </button>
                    </div>
                </div>
            </div>

            <!-- Profile Info Form -->
            <div class="profile-id">
                <div class="card shadow-sm border-0 premium-card">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0"><i class='bx bx-id-card text-success'></i> Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <form id="profileForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">First Name</label>
                                    <input type="text" class="form-control bg-light border-0" id="fname" value="<?php echo $teacher_data['fname'] ?? ''; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">Contact Number</label>
                                    <input type="text" class="form-control bg-light border-0" id="phone" value="<?php echo $teacher_data['phone'] ?? ''; ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small">Official Email Address</label>
                                    <input type="email" class="form-control bg-light border-0" id="email" value="<?php echo $teacher_data['email'] ?? ''; ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small">Current Address</label>
                                    <textarea class="form-control bg-light border-0" id="address" rows="3" readonly><?php echo $teacher_data['address'] ?? ''; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-3 border-top d-flex gap-2">
                                <button type="button" class="btn btn-primary px-4" id="editBtn">
                                    <i class='bx bx-edit-alt'></i> Edit Profile
                                </button>
                                <button type="button" class="btn btn-success px-4 d-none" id="saveBtn">
                                    <i class='bx bx-save'></i> Save Changes
                                </button>
                                <button type="button" class="btn btn-light px-4 d-none" id="cancelBtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../student_panel/app.js"></script>
<script src="settings.js"></script>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
