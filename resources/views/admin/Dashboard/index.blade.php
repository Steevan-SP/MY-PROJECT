@extends('layouts.admin.master')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Control Panel</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Overview Hub</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->admin)
                        <h4 class="card-title">Welcome, {{ Auth::user()->admin->firstname }}!</h4>
                    @else
                        <h4 class="card-title">Welcome, {{ Auth::user()->firstname }}!</h4>
                    @endif
                    <p class="card-text">{{ $welcomeNote }}</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
				<div class="row guest-card-row">
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-warning guest-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
									<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"></path>
									</svg>
								</div>
								<div>
                                <h2 class="text-white guest-num">{{ $guestsToday }}</h2>
                                 <span class="text-white fs-18">Guest Count Today</span>
                                </div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-success guest-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
									<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z"></path>
									<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z"></path>
									</svg>
									
								</div>
								<div>
									<h2 class="text-white guest-num">{{ $guestsYesterday }}</h2>
									<span class="text-white fs-18">Count of Guests Yesterday</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card bg-secondary invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
									<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"></path>
									</svg>
								
								</div>
								<div>
								<div>
    								<h2 class="text-white invoice-num">{{$paymentTodayTotal}}</h2>
   									<span class="text-white fs-18">Wallet Balance for Today</span>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>		
                <div class="row">
					<div class="col-xl-9 col-xxl-12">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-xl-6">
										<div class="card-bx bg-blue">
											<img class="pattern-img" src="images/pattern/pattern6.png" alt="">
											<div class="card-info text-white">
												<img src="images/pattern/circle.png" class="mb-4" alt="">
                                                <p class="fs-16">Wallet Balance for Yesterday</p>
												<h2 class="text-white card-balance">Rs.{{$paymentYesterdayTotal}}</h2>
												<p class="fs-16">Wallet Balance for Day Before Yesterday</p>
												<span>Rs.{{$paymentDayBeforeYesterdayTotal}}</span>
											</div>
											
										</div>
									</div>
									<div class="col-xl-6">
										<div class="row  mt-xl-0 mt-4">
											<div class="col-md-6">
												<h4 class="card-title">Yesterday's Overview</h4>
												<span>Hunasfalls - where nature flows</span>
												<ul class="card-list mt-4">
													<li><span class="bg-blue circle"></span>Total Guests<span>{{$guestsYesterday}}</span></li>
													<li><span class="bg-success circle"></span>Local Guest<span>{{$localGuestsYesterday}}</span></li>
													<li><span class="bg-warning circle"></span>Foreign Guest<span>{{$foreignGuestsYesterday}}</span></li>
													<li><span class="bg-light circle"></span>Complementary<span></span>{{$complementaryGuestsYesterday}}</li>
												</ul>
											</div>
											<div class="col-md-6">
												<canvas id="polarChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div class="container-fluid">
				<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Last Week's Guest Arrival and Billings Details</h4>
                    <canvas id="lastWeekGuestBillingChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>	
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="polarChart"></canvas>
<script>
    

    const lastWeekArrivalData = <?php echo json_encode($lastWeekArrivalData); ?>;
    const lastWeekBillingData = <?php echo json_encode($lastWeekBillingData); ?>;
    const lastWeekLabels = <?php echo json_encode($lastWeekLabels); ?>;


    const lastWeekCtx = document.getElementById('lastWeekGuestBillingChart').getContext('2d');
    const lastWeekChart = new Chart(lastWeekCtx, {
        type: 'line',
        data: {
            labels: lastWeekLabels,
            datasets: [{
                label: 'Guest Arrival',
                data: lastWeekArrivalData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Billing',
                data: lastWeekBillingData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            }
        }
    });

    var polarChartData = {
        labels: ['Local Guests', 'Foreign Guests', 'Complementary'],
        datasets: [{
            label: 'Yesterday\'s Overview',
            data: [{{$localGuestsYesterday}}, {{$foreignGuestsYesterday}}, {{$complementaryGuestsYesterday}}],
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    };

    var polarChartCanvas = document.getElementById('polarChart').getContext('2d');


    var polarChart = new Chart(polarChartCanvas, {
        type: 'polarArea',
        data: polarChartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
