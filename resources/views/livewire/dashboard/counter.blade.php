<div class="row">
	<div class="col-xl-12">
		<div class="card product-progress-card">
			<div class="card-block">
				<div class="row pp-main">
					<div class="col-xl-3 col-md-6">
						<div class="pp-cont">
							<div class="row align-items-center m-b-20">
								<div class="col-auto">
									<i class="fa fa-database f-24 text-primary"></i>
								</div>
								<div class="col text-right">
									<h2 class="m-b-0 text-c-blue">{{ $data['total'] }}</h2>
								</div>
							</div>
							<div class="row align-items-center m-b-15">
								<div class="col-auto">
									<p class="m-b-0">ทั้งหมด</p>
								</div>
								<div class="col text-right">
									<p class="m-b-0 text-c-blue"><i class="fas fa-long-arrow-alt-up m-r-10"></i>100%</p>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-c-blue" style="width:100%"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6">
						<div class="pp-cont">
							<div class="row align-items-center m-b-20">
								<div class="col-auto">
									<i class="fa fa-tag f-24 text-info"></i>
								</div>
								<div class="col text-right">
									<h2 class="m-b-0 text-info">{{ $data['today'] }}</h2>
								</div>
							</div>
							<div class="row align-items-center m-b-15">
								<div class="col-auto">
									<p class="m-b-0">วันนี้</p>
								</div>
								<div class="col text-right">
									<p class="m-b-0 text-info"><i class="fas fa-long-arrow-alt-down m-r-10"></i>{{ number_format($data['todayPercent'], 2) }}%</p>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-info" style="width:{{ $data['todayPercent'] }}%"></div>
							</div>
						</div>
					</div>
                    					<div class="col-xl-3 col-md-6">
						<div class="pp-cont">
							<div class="row align-items-center m-b-20">
								<div class="col-auto">
									<i class="fa fa-tag f-24 text-success"></i>
								</div>
								<div class="col text-right">
									<h2 class="m-b-0 text-success">{{ $data['sent'] }}</h2>
								</div>
							</div>
							<div class="row align-items-center m-b-15">
								<div class="col-auto">
									<p class="m-b-0">สำเร็จ</p>
								</div>
								<div class="col text-right">
									<p class="m-b-0 text-success"><i class="fas fa-long-arrow-alt-down m-r-10"></i>{{ number_format($data['sentPercent'], 2) }}%</p>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-success" style="width:{{ $data['sentPercent'] }}%"></div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-md-6">
						<div class="pp-cont">
							<div class="row align-items-center m-b-20">
								<div class="col-auto">
									<i class="fa fa-tag f-24 text-c-red"></i>
								</div>
								<div class="col text-right">
									<h2 class="m-b-0 text-c-red">{{ $data['failed'] }}</h2>
								</div>
							</div>
							<div class="row align-items-center m-b-15">
								<div class="col-auto">
									<p class="m-b-0">ผิดพลาด</p>
								</div>
								<div class="col text-right">
									<p class="m-b-0 text-c-red"><i class="fas fa-long-arrow-alt-down m-r-10"></i>{{ number_format($data['failedPercent'], 2) }}%</p>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-c-red" style="width:{{ $data['failedPercent'] }}%"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>Analytics</h5>
				<div class="card-header-right">
					<ul class="list-unstyled card-option">
						<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
						<li><i class="feather icon-maximize full-card"></i></li>
						<li><i class="feather icon-minus minimize-card"></i></li>
						<li><i class="feather icon-refresh-cw reload-card"></i></li>
						<li><i class="feather icon-trash close-card"></i></li>
						<li><i class="feather icon-chevron-left open-card-option"></i></li>
					</ul>
				</div>
			</div>
			<div class="card-block">
				<div id="sales-analytics" style="height: 390px;"></div>
			</div>
		</div>
	</div>
</div>
