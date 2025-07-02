@extends('layout.app')
@section('content')
@php
$permissions = Helper::getPermissions();
@endphp

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h4>
                                    <i class="fa fa-desktop"></i> &nbsp; Student Dashboard
                                </h4>
                            </div>
                            <div class="card-tools">
                                <!-- Optional button here -->
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">


                                    <div class="col-12 col-md-4">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
                                                        Assignment Section
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="collapse show" data-parent="#accordion" style="">
                                                
                                                <div class="card-body">
                                                    <form action="https://exam.tcieduhub.in/examTerminal" method="post">
                                                        <input type="hidden" name="_token" value="Wg7evquI5jZU9M0d22kxZaBsTFr2uwLaYC8Q5z2V">                                                    <div class="row  pb-3">
                                                        <div class="col-6 col-md-6 text-center pb-3" id="dateWise" style="border-bottom: 1px solid rgb(102, 57, 181); cursor: pointer;">
                                                            DateWise Search
                                                        </div>
                                                        <div class="col-6 col-md-6 text-center pb-3" id="chapterWise" style="cursor: pointer; border-bottom: 0px solid rgb(102, 57, 181);">
                                                            ChapterWise Search
                                                        </div>


                                                    </div>
                                                    
                                                        
                                                        
 <div class="row pb-3  dateWise_tab" style="border-bottom: 1px solid lightgrey;">
     
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">From Date</label>
                                                            
                                                                <input type="date" name="from_date" value="2025-06-24" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">To Date</label>
                                                            <input type="date" name="to_date" value="2025-07-01" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12 pb-2 text-center">
                                                               
                                        <button type="submit" class="btn btn-primary">Search</button>
                                 
                                                        </div>
                                                        
                                                        

                                                    </div>
                                                    
                                                    <div class="row  chapterWise_tab" style="border-bottom: 1px solid lightgrey; display: none;">
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">Exam Status</label>
                                                                <select class="form-control " name="" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                                    <option value="" data-select2-id="3">All</option>


                                                                    <option value="1">Pending</option>
                                                                    <option value="2">Solved</option>
                                                                    <option value="3">Upcomming</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">Exam Pattern</label>
                                                                                                                            
                                                                <select class="form-control " name="exam_pattern" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                                    <option value="" data-select2-id="3">All</option>
                                                                                                                                                                                                                        <option value="1">IIT-JEE MAIN</option>
                                                                                                                                                <option value="2">IIT-JEE ADVANCE</option>
                                                                                                                                                <option value="3">NEET-UG</option>
                                                                                                                                                <option value="4">ASSESSMENT</option>
                                                                                                                                                
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row  chapterWise_tab" style="border-bottom: 1px solid lightgrey; display: none;">
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">Subject</label>
                                                                                                                                <select class="form-control " name="subject" id="subject" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                                    <option value="" data-select2-id="3">All</option>

                                                                                                                                                                                                                        <option value="1">Chemistry XI</option>
                                                                                                                                                <option value="2">Physics XI</option>
                                                                                                                                                <option value="3">Botany XI</option>
                                                                                                                                                <option value="4">Mathematics XI</option>
                                                                                                                                                <option value="11">Zoology XI</option>
                                                                                                                                                <option value="13">ASSESMENT</option>
                                                                                                                                                                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label style="color:#6639b5">Chapter Name</label>
                                                                                                                                  <select class="form-control " name="chapters" id="chapters" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                                    <option value="" data-select2-id="3">All</option>

                                                                        <!---->
                                                                        <!---->
                                                                        <!--<option value="29">Some Basic Concepts of Chemistry</option>-->
                                                                        <!---->
                                                                        <!--<option value="30">Structures of Atom</option>-->
                                                                        <!---->
                                                                        <!--<option value="31">Classification of Elements and Periodicity in Properties</option>-->
                                                                        <!---->
                                                                        <!--<option value="32">Chemical Bonding and Molecular Structure</option>-->
                                                                        <!---->
                                                                        <!--<option value="33">Theromodynamics</option>-->
                                                                        <!---->
                                                                        <!--<option value="34">Equilibrium</option>-->
                                                                        <!---->
                                                                        <!--<option value="35">Redox reactions</option>-->
                                                                        <!---->
                                                                        <!--<option value="41">Organic Chemistry - Some Basic Principles and Techniques</option>-->
                                                                        <!---->
                                                                        <!--<option value="42">Hydrocarbons</option>-->
                                                                        <!---->
                                                                        <!--<option value="58">UNIT &amp; Measurements</option>-->
                                                                        <!---->
                                                                        <!--<option value="59">One Dimensional Motion</option>-->
                                                                        <!---->
                                                                        <!--<option value="90">Relations and Functions</option>-->
                                                                        <!---->
                                                                        <!--<option value="116">The Living World</option>-->
                                                                        <!---->
                                                                        <!--<option value="117">Biological Classification</option>-->
                                                                        <!---->
                                                                        <!--<option value="118">Plant Kingdom</option>-->
                                                                        <!---->
                                                                        <!--<option value="119">Morphology of Flowering Plants</option>-->
                                                                        <!---->
                                                                        <!--<option value="120">Anatomy of Flowering Plants</option>-->
                                                                        <!---->
                                                                        <!--<option value="121">Photosynthesis in higher plants</option>-->
                                                                        <!---->
                                                                        <!--<option value="122">Respiration in Plants</option>-->
                                                                        <!---->
                                                                        <!--<option value="123">Plant growth &amp; Devlopment</option>-->
                                                                        <!---->
                                                                        <!--<option value="124">Animal Kingdom</option>-->
                                                                        <!---->
                                                                        <!--<option value="125">structural Organisation in Animals</option>-->
                                                                        <!---->
                                                                        <!--<option value="126">Biomolecules</option>-->
                                                                        <!---->
                                                                        <!--<option value="129">Breathing &amp; Exchange of Gases</option>-->
                                                                        <!---->
                                                                        <!--<option value="130">Body Fluid &amp; Criculation</option>-->
                                                                        <!---->
                                                                        <!--<option value="131">Excretory Products &amp; their Elemination</option>-->
                                                                        <!---->
                                                                        <!--<option value="132">Locomotion &amp; Movement</option>-->
                                                                        <!---->
                                                                        <!--<option value="133">Neural Control &amp; Cordination</option>-->
                                                                        <!---->
                                                                        <!--<option value="134">Chemical Cordination &amp; Intergration</option>-->
                                                                        <!---->
                                                                        <!--<option value="150">Motion in Straight Line</option>-->
                                                                        <!---->
                                                                        <!--<option value="151">Motion in a Plane</option>-->
                                                                        <!---->
                                                                        <!--<option value="152">Lawa of Motion</option>-->
                                                                        <!---->
                                                                        <!--<option value="153">Work Energy and Power</option>-->
                                                                        <!---->
                                                                        <!--<option value="154">System of Particles and Rotational Motion</option>-->
                                                                        <!---->
                                                                        <!--<option value="155">Gravitation</option>-->
                                                                        <!---->
                                                                        <!--<option value="156">Mechanical Properties of Solids</option>-->
                                                                        <!---->
                                                                        <!--<option value="157">Mechanical Properties of Fluids</option>-->
                                                                        <!---->
                                                                        <!--<option value="158">Thermal Properties of Matter</option>-->
                                                                        <!---->
                                                                        <!--<option value="159">Thermodynamics</option>-->
                                                                        <!---->
                                                                        <!--<option value="160">Sets</option>-->
                                                                        <!---->
                                                                        <!--<option value="161">Trignometric Functions</option>-->
                                                                        <!---->
                                                                        <!--<option value="162">Complex Numbers and Quadratic Equations</option>-->
                                                                        <!---->
                                                                        <!--<option value="163">Linear Inequalities</option>-->
                                                                        <!---->
                                                                        <!--<option value="164">Permutations and Combinations</option>-->
                                                                        <!---->
                                                                        <!--<option value="165">Binomial Theorem</option>-->
                                                                        <!---->
                                                                        <!--<option value="166">Sequences and Series</option>-->
                                                                        <!---->
                                                                        <!--<option value="167">Straight Lines</option>-->
                                                                        <!---->
                                                                        <!--<option value="168">Conic Sections</option>-->
                                                                        <!---->
                                                                        <!--<option value="169">Introduction to Three Dimensional Geometry</option>-->
                                                                        <!---->
                                                                        <!--<option value="170">Limits and Derivatives</option>-->
                                                                        <!---->
                                                                        <!--<option value="171">Statistics</option>-->
                                                                        <!---->
                                                                        <!--<option value="172">Probability</option>-->
                                                                        <!---->
                                                                        <!--<option value="173">Cell : The Unit of Life</option>-->
                                                                        <!---->
                                                                        <!--<option value="181">Cell Cycle and Cell Division</option>-->
                                                                        <!---->
                                                                        <!--<option value="210">Major01</option>-->
                                                                        <!---->
                                                                        <!--<option value="211">MajorPhysices</option>-->
                                                                        <!---->
                                                                        <!--<option value="212">Major Math</option>-->
                                                                        <!---->
                                                                        <!--<option value="213">Aits-2</option>-->
                                                                        <!---->
                                                                        <!--<option value="214">Waves-(AITS)</option>-->
                                                                        <!---->
                                                                        <!--<option value="215">Circular Motion-(AITS)</option>-->
                                                                        <!---->
                                                                        <!--<option value="224">Chem-jee-6 May25</option>-->
                                                                        <!---->
                                                                        <!--<option value="225">JEE-Maths-13-5-25</option>-->
                                                                        <!---->
                                                                        <!--<option value="226">JEE-Phy-20-5-25</option>-->
                                                                        <!---->
                                                                        <!--<option value="227">04-JEE Paper</option>-->
                                                                        <!---->
                                                                        <!--<option value="228">05-JEE Paper</option>-->
                                                                        <!---->
                                                                        <!--<option value="229">ASSESMENT</option>-->
                                                                        <!---->
                                                                        <!--<option value="230">06- JEE PAPER</option>-->
                                                                        <!---->
                                                                        <!--<option value="231">10- JEE PAPER</option>-->
                                                                        <!---->
                                                                        <!--<option value="232">11-JEE Paper Maths</option>-->
                                                                        <!---->
                                                                        <!---->

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12 pb-2 text-center">
                                                               
                                        <button class="btn btn-primary" type="submit">Search</button>
                                 
                                                        </div>
                                                        
                                                        

                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="col-12 col-md-8">

                                        <div class="row">
                                                           
                                                                                                                
                                                                                                                
                                                  
                                            <div class="col-md-4 col-6">

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="11-JEE Maths Paper">11-JEE Maths Pa... </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0" style="display: block;">
                                                        <ul class="nav nav-pills flex-column">
                                                            <li class="nav-item active">
                                                                <a href="#" class="nav-link nav-color">
                                                                    <i class="fa fa-book"></i> Exam Id
                                                                    <span class="badge bg-primary float-right">43</span>
                                                                </a>
                                                            </li>
                                                                                                                        <li class="nav-item active">
                                                                <a href="#" class="nav-link nav-color">
                                                                    <i class="fa fa-calendar"></i> Create On
                                                                    <span class="badge bg-success float-right">01-07-2025 06:54 AM</span><br>
                                                                        
                                                                </a>
                                                            </li>
                                                            <li class="nav-item active">
                                                                <a href="#" class="nav-link nav-color">
                                                                    <i class="fa fa-check"></i> Start
                                                                    <span class="badge bg-success float-right">01-07-2025 07:30 AM
                                                                        </span>
                                                                </a>
                                                            </li>


                                                            <li class="nav-item">
                                                                <a href="#" class="nav-link nav-color">
                                                                    <i class="fa fa-clock"></i> Exam Time Duration
                                                                    <span class="badge bg-warning float-right">NA hr : 60
                                                                        min</span>
                                                                </a>
                                                            </li>
                                                            
                                                                                                                        
                                                            <li class="nav-item li_hover" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Go to Analysis">
                                                                
                                                                <form action="https://exam.tcieduhub.in/analysisPanel" method="post">
                                                                    <input type="hidden" name="_token" value="Wg7evquI5jZU9M0d22kxZaBsTFr2uwLaYC8Q5z2V">                                                                    <input type="hidden" name="exam_id" value="43">
                                                                <button type="submit" class="btn btn-primary w-100">
                                                                    <i class="fa fa-check"></i> This Exam Given
                                                                   1 Times
                                                                </button>
                                                                
                                                                </form>
                                                            </li>
                                                                                                                        <li class="nav-item">
                                                                  
                                                                   <form action="https://exam.tcieduhub.in/startExamNew" method="post">
                                                                    <input type="hidden" name="_token" value="Wg7evquI5jZU9M0d22kxZaBsTFr2uwLaYC8Q5z2V">                                                                    <input type="hidden" value="43" name="exam_id">
                                                                    <input type="hidden" value="1" name="showRules">
                                                                    <button type="submit" class="btn btn-success w-100 ">Start</button>
                                                                </form>
                                                                                                                                
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                      
                                    </div>



                                </div>
                        </div>
                    </div>
                <div>
            </div>
        </div>
    </section>
</div>



@endsection