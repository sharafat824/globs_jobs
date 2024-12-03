<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
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
</style>
<div class="">

	<div class="breadcrumb-area">
		<h1>All Applicants</h1>
		<ol class="breadcrumb">
			<li class="item"><a href="dashboard.html">Home</a></li>
			<li class="item"><a href="dashboard.html">Dashboard</a></li>
			<li class="item">All Applicants</li>
		</ol>
	</div>

	<div class="all-applicants-box">
		<h2>Applicants </h2>
		<br />
		<div class="row">
			<table id="example" class="display respons " style="width:100%">
				<thead>
					<tr>
						<th>ProfilePic</th>
						<th>Name</th>
						<th>Category</th>
						<th>Country</th>
						<th>Phone</th>
						<th>Status</th>
						<th>Job(Applied)</th>
						<th>Job(SL)</th>
						<th>Job(A)</th>
						<th>Register Source</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
        "processing": true, 
        "serverSide": true, 
		"paging": true,
		"info":false,
        "ajax": {
            "url": "<?= base_url('Manage_applicant/getApplicantsData'); ?>", // Controller method to fetch data
            "type": "POST"
        },
        "columns": [
            { "data": "profile_pic" },
            { "data": "name" },
            { "data": "category_name" },
            { "data": "cocountry_name" },
            { "data": "phone" },
            { "data": "status" },
            { "data": "total_applied_jobs" },
            { "data": "total_shortlisted_jobs" },
            { "data": "total_assigned_jobs" },
            { "data": "user_source" },
            { "data": "action" }
        ]
    });
});

</script>