<?php include('partials/_header_revised.php') ?>
<?php 
$check = '5'; 
$active_page = 'schedule';
?>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toast-alert-message"></div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
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
                <h1>Schedule</h1>
            </div>
        </div>

        <!-- Schedule Filter Card -->
        <div class="card shadow-sm border-0 mb-4 premium-card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0"><i class='bx bx-filter-alt text-primary'></i> Filter Schedule</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small fw-bold">Select Class</label>
                        <select class="form-select" id="search-class">
                            <?php include('partials/select_classes.php') ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Section</label>
                        <select class="form-select" id="search-section">
                            <option selected>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100" id="findTimeTableBtn">
                            <i class='bx bx-search-alt'></i> Search Schedule
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timetable Data Card -->
        <div class="card shadow-sm border-0 premium-card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                <h5 class="card-title mb-0" id="timeTableClassSection">Select a class to begin</h5>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary" id="prev-page-btn">
                        <i class='bx bx-chevron-left'></i>
                    </button>
                    <button class="btn btn-primary disabled fw-bold px-3" id="__day__">MONDAY</button>
                    <button type="button" class="btn btn-outline-primary" id="next-page-btn">
                        <i class='bx bx-chevron-right'></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%;">Starts</th>
                                <th style="width: 25%;">Ends</th>
                                <th>Assigned Subject</th>
                            </tr>
                        </thead>
                        <tbody id="timeTable_table1">
                            <!-- Loaded via JS -->
                        </tbody>
                    </table>
                </div>

                <div class="lunch-divider my-4">LUNCH RECESS</div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <tbody id="timeTable_table2">
                            <!-- Loaded via JS -->
                        </tbody>
                    </table>
                </div>

                <div id="dataNotAvailable" style="display: none;">
                    <div class="text-center py-5">
                        <div class="display-4 text-muted opacity-25 mb-3">
                            <i class='bx bx-coffee-togo'></i>
                        </div>
                        <h5 class="text-muted">No Sessions Scheduled</h5>
                        <p class="small text-muted">Check back later or select a different day.</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button class="btn btn-outline-success btn-sm me-2" id="editBtn">
                            <i class='bx bxs-edit-alt'></i> Modify
                        </button>
                        <button class="btn btn-success btn-sm" id="saveBtn" style="display: none;">
                            <i class='bx bx-check-circle'></i> Save Changes
                        </button>
                    </div>
                    <div class="text-end text-muted">
                        <small class="d-block">Last modified by: <span id="lastEditor">N/A</span></small>
                        <small id="editingTime" class="x-small"></small>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/timetable.js"></script>
<?php include('partials/_footer.php'); ?>
