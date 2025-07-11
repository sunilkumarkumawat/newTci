@extends('layout.app')
@section('content')
@php
$permissions = Helper::getPermissions();
@endphp
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addColumn({type: 'string', role: 'style'});
        data.addRows([
          ['Mushrooms', 3, 'color: orange'],
          ['Onions', 1, 'color: brown'],
          ['Olives', 1, 'color: teal'],
          ['Zucchini', 1, 'color: mediumspringgreen'],
          ['Pepperoni', 2, 'color: dodgerblue']
        ]);

        var piechart_options = {title:'Pie Chart: How Much Pizza I Ate Last Night',
                       
                       height:300};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);

        var barchart_options = {title:'Barchart: How Much Pizza I Ate Last Night',
                       
                       height:300,
                       legend: 'none'};
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data, barchart_options);



        var columnchart_options = {title:'Column Chart: How Much Pizza I Ate Last Night',
                       
                       height:300};
        var columnchart = new google.visualization.ColumnChart(document.getElementById('columnchart_div'));
        columnchart.draw(data, columnchart_options);


        var AreaChart_options = {title:'Area Chart: How Much Pizza I Ate Last Night',
                       
                       height:300};
        var AreaChart = new google.visualization.AreaChart(document.getElementById('AreaChart_div'));
        AreaChart.draw(data, AreaChart_options);


        var LineChart_options = {title:'Line Chart: How Much Pizza I Ate Last Night',
                       
                       height:300};
        var LineChart = new google.visualization.LineChart(document.getElementById('LineChart_div'));
        LineChart.draw(data, LineChart_options);


        var PieChart_options = {title:'Donut Chart: How Much Pizza I Ate Last Night',
                       
                       height:300,
                       pieHole: 0.4};
        var PieChart = new google.visualization.PieChart(document.getElementById('DonutChart_div'));
        PieChart.draw(data, PieChart_options);


        var piechart_options = {title:'Pie 3D Chart: How Much Pizza I Ate Last Night',
                       
                       height:300,
                       is3D: true};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart3d_div'));
        piechart.draw(data, piechart_options);


        var ScatterChart_options = {title:'ScatterChart Chart: How Much Pizza I Ate Last Night',
                       
                       height:300};
        var ScatterChart = new google.visualization.ScatterChart(document.getElementById('ScatterChart_div'));
        ScatterChart.draw(data, ScatterChart_options);


      }
    </script>
<style>
    .box {
    position: relative;
    margin-bottom: 1.5rem;
    width: 100%;
    background-color: #ffffff;
    border-radius: 5px;
    padding: 0px;
    -webkit-transition: .5s;
    transition: .5s;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
    box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
}

.box-body {
    padding: 1.5rem;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    border-radius: 5px;
}

.p-30 {
    padding: 30px !important;
}

.flex-grow-1 {
    flex-grow: 1 !important;
}
.fw-600 {
    font-weight: 600 !important;
}
.h1, h1 {
    font-size: 1.5rem;
}
.w-50 {
    width: 50px !important;
}
.b-1 {
    border: 1px solid #f0f3f6 !important;
}
.l-h-50 {
    line-height: 3.5714285714rem !important;
}
.fs-24 {
    font-size: 1.8461538462rem !important;
}
.me-15 {
    margin-right: 15px !important;
}
.mt-45 {
    margin-top: 45px !important;
}
.me-30 {
    margin-right: 30px !important;
}
.bg-img {
    /* position: relative; */
    /* -webkit-background-size: cover; */
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;
}
.pull-up {
    -webkit-transition: all .25s ease;
    -o-transition: all .25s ease;
    -moz-transition: all .25s ease;
    transition: all .25s ease;
}
.pull-up:hover {
    -webkit-transform: translateY(-4px) scale(1.02);
    -moz-transform: translateY(-4px) scale(1.02);
    -ms-transform: translateY(-4px) scale(1.02);
    -o-transform: translateY(-4px) scale(1.02);
    transform: translateY(-4px) scale(1.02);
    -webkit-box-shadow: 0 14px 24px rgba(0, 0, 0, 0.2);
    box-shadow: 0 14px 24px rgba(0, 0, 0, 0.2);
    z-index: 999;
}
.py-5 {
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}

.px-5 {
    padding-left: 5px !important;
    padding-right: 5px !important;
}
.p-10 {
    padding: 10px !important;
}
p {
    margin-top: 0;
    margin-bottom: 0rem !important;
    font-size: 14px;
}
.bg-primary-light {
    background-color: #e2f3fc !important;
    color: #019ff8 !important;
}
a:hover, a:active, a:focus {
    outline: 0;
    text-decoration: none;
}
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 col-12">
                    <div class="box card-outline card-orange bg-info">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 p-30 flex-grow-1 bg-img bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url('{{ asset('public/assets/school/student/img/custom-30.svg') }}')">
								<div class="row">
									<div class="col-12 col-xl-7">
										<h1 class="mb-0 fw-600">Learn With Effectively With Us!</h1>
										<p class="my-10 fs-16 text-white-70">Get 30% off every course on january.</p>
										<div class="mt-45 d-md-flex align-items-center">
											<div class="me-30 mb-30 mb-md-0">
												<div class="d-flex align-items-center">
													<div class="me-15 text-center fs-24 w-50 h-50 l-h-50 bg-danger b-1 border-white rounded-circle">
														<i class="fa fa-graduation-cap"></i>
													</div>
													<div>
														<h5 class="mb-0">Students</h5>
														<p class="mb-0 text-white-70">75,000+</p>
													</div>
												</div>
											</div>
											<div>
												<div class="d-flex align-items-center">
													<div class="me-15 text-center fs-24 w-50 h-50 l-h-50 bg-warning b-1 border-white rounded-circle">
														<i class="fa fa-user"></i>
													</div>
													<div>
														<h5 class="mb-0">Expert Mentors</h5>
														<p class="mb-0 text-white-70">200+</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-xl-5"></div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
					<div class="row">
						<div class="col-6">
							<a class="box box-link-shadow text-center card-outline card-orange pull-up" href="{{ url('/student/exams/start/1') }}">
								<div class="box-body py-5 bg-primary-light px-5">
									<p class="fw-500 text-primary text-overflow">Topic Wise</p>
								</div>
								<div class="box-body p-10">
									<h1 class="countnm fs-40 m-0">5</h1>
								</div>
							</a>
						</div>
						<div class="col-6">
							<a class="box box-link-shadow text-center card-outline card-orange pull-up" href="javascript:void(0)">
								<div class="box-body py-5 bg-primary-light px-5">
									<p class="fw-500 text-primary text-overflow">Chapter Wise</p>
								</div>
								<div class="box-body p-10">
									<h1 class="countnm fs-40 m-0">25</h1>
								</div>
							</a>
						</div>
                        <div class="col-6">
							<a class="box box-link-shadow text-center card-outline card-orange pull-up" href="javascript:void(0)">
								<div class="box-body py-5 bg-primary-light px-5">
									<p class="fw-500 text-primary text-overflow">Subject Wise</p>
								</div>
								<div class="box-body p-10">
									<h1 class="countnm fs-40 m-0">5</h1>
								</div>
							</a>
						</div>
						<div class="col-6">
							<a class="box box-link-shadow text-center card-outline card-orange pull-up" href="javascript:void(0)">
								<div class="box-body py-5 bg-primary-light px-5">
									<p class="fw-500 text-primary text-overflow">Upcoming</p>
								</div>
								<div class="box-body p-10">
									<h1 class="countnm fs-40 m-0">25</h1>
								</div>
							</a>
						</div>
					</div>
				</div>
                <div class="col-md-4 col-12">
					<div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notice board</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                    <span class="badge badge-warning float-right">Just Now</span></a>
                                <span class="product-description">
                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Bicycle
                                    <span class="badge badge-info float-right">Today</span></a>
                                <span class="product-description">
                                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">
                                    Xbox One 
                                    <span class="badge badge-danger float-right">
                                    17 Dec 2020
                                </span>
                                </a>
                                <span class="product-description">
                                    Xbox One Console Bundle with Halo Master Chief Collection.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                    <span class="badge badge-success float-right">27 Oct 2020</span></a>
                                <span class="product-description">
                                    PlayStation 4 500GB Console (PS4)
                                </span>
                                </div>
                            </li>
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="javascript:void(0)" class="uppercase">View All Products</a>
                        </div>
                    </div>
				</div>
                <div class="col-md-4 mb-3">
                    <div id="piechart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="barchart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="columnchart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="AreaChart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="LineChart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="DonutChart_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="piechart3d_div" style="border: 3px solid tomato"></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="ScatterChart_div" style="border: 3px solid tomato"></div>
                </div>
                
                
            </div>
        </div>
    </section>
</div>



@endsection