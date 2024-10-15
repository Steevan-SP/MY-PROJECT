<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
							
							
                                     <li class="nav-item">
    <div class="dropdown">
        <a href="javascript:void(0);" class="btn btn-primary d-sm-inline-block d-none dropdown-toggle" id="generateReportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Generate Report <i class="las la-signal ms-3 scale5"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="generateReportDropdown">
        <li><a class="dropdown-item" href="{{ route('reportDT.index') }}">Daily Transaction Summary Report</a></li>
        <li><a class="dropdown-item" href="{{ route('reportGD.index') }}">Guest Details Report</a></li>
        <li><a class="dropdown-item" href="{{ route('TotalGuest.index') }}">Total Guest Report</a></li>
        <li><a class="dropdown-item" href="{{ route('TotalStockSummary.index') }}">Stock Summary Report</a></li>
        <li><a class="dropdown-item" href="{{ route('LocalGuestReport.index') }}">Local Guest Details</a></li>
        </ul>
    </div>
</li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>