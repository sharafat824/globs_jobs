<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>


<!-- Select2 JS -->
<script src="<?php echo base_url('assets/js/select2.min.js'); ?>" defer></script>


<style>
    /* Pagination styling */
    .pagination {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0.1rem;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #f0f0f0;
        color: #d1d1d1;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .page-item a {
        padding: 0.5rem 1rem;
    }

    /* Avatar styling */
    .avatar {
        object-fit: cover;
        height: 80px;
        width: 80px;
    }

    /* Styling for filters */
    .filters {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 10px;
        border-radius: 8px;
    }

    .filters select {
        font-size: 1rem;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
        color: #333;
        transition: border-color 0.3s;
    }

    .filters select:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Styling for search input */
    #example_filter input {
        width: 16rem;
        border: 1px solid #ddd;
        padding: 0.5rem;
        outline: none;
        border-radius: 4px;
        font-size: 1rem;
    }

    /* Hover effect for DataTable rows */
    #example tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Custom filter and search alignment */
    .filter-search-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filter-search-wrapper .filters,
    .filter-search-wrapper #example_filter {
        margin: 0;
    }

    #example_paginate {
        margin-top: 1rem;
    }

    #example_length {
        margin-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #dda63a !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        background: #dda63a !important;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: rgb(255, 193, 7) !important;
        color: #ffffff !important;

    }

    .btn-check:focus+.btn,
    .btn:focus {
        box-shadow: none !important;
    }

    .select2-container--default .select2-selection--single {
        height: 39px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 5px 10px !important;
    }
</style>

<div class="breadcrumb-area">
    <h1>All Applicants</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
        <li class="item">All Applicants</li>
    </ol>
</div>

<div class="all-applicants-box">

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Applicants</h2>
        </div>
        <div>
            <a href="<?php echo base_url() . 'Candidate/create_employ_user' ?>" class="default-btn default-btn-0"><i class="bi bi-plus"></i>Add</a>
        </div>
    </div>
    <br />
    <div class="row">
        <!-- Custom Filters -->
        <div class="col-md-3 mb-2">
            <select id="filter-category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->id; ?>"><?= htmlspecialchars($category->category_name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <select id="country" class="form-select">
                <option value="">All Countries</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <select id="town" class="form-select">
                <option value="">All Cities</option>
            </select>
        </div>

        <div class="col-md-3 mb-2">
            <div id="example_filter" class="dataTables_filter">
                <input type="search" class=" form-control-sm w-100" placeholder="Search by Name, Email" aria-controls="example">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table id="example" class="display responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>ProfilePic</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th data-toggle="tooltip" data-placement="top" title="Applied, Shortlist, Assigned">Jobs</th>
                        <th>Register Source</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
        const table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ordering": false,
            "info": false,
            "searching": false,
            "ajax": {
                "url": "<?= base_url('Manage_applicant/getApplicantsData'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.category = $('#filter-category').val(); // Add category filter
                    d.country = $('#country').val();
                    d.town = $('#town').val();
                    d.search = $('#example_filter input').val(); // Add search query
                }
            },
            "columns": [{
                    "data": "profile_pic"
                },
                {
                    "data": "name"
                },
                {
                    "data": "category_name"
                },
                {
                    "data": "cocountry_name"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "status"
                },
                {
                    "data": "job"
                },

                {
                    "data": "user_source"
                },
                {
                    "data": "action"
                }
            ],
            "dom": '<"top"f>rt<"bottom"lip><"clear">', // Moves search and other elements below the table.
            language: {
                searchPlaceholder: "Search by name, category, country"
            }
        });

        // Event listeners for filters and search input
        $('#filter-category, #country, #town').on('change', function() {
            table.ajax.reload(); // Reload table data with the applied filters
        });

        $('#example_filter input').on('input', function() {
            table.ajax.reload(); // Reload table data with the search input
        });

        $('#filter-category').select2({
            placeholder: 'Select Category',
            allowClear: true,
            width: '100%'
        });
        $('#country').select2({
            placeholder: 'Select Country',
            allowClear: true,
            width: '100%'
        });
        $('#town').select2({
            placeholder: 'Select City',
            allowClear: true,
            width: '100%'
        });
    });
</script>