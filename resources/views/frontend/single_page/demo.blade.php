@extends('frontend.layouts.index')
@section('content')
{{-- @include('frontend.layouts.loader') --}}
@include('frontend.layouts.header')
@include('frontend.layouts.banner')
{{-- <style type="text/css">

  div{
    text-align: justify;
    color: Black;
  }
  c{
    font-weight: bold;
  }
</style> --}}
<section>
	<div class="container">
		<div style="margin-bottom: 50px; font-weight: bold; ">
			<center>
				<p><strong style="color: #7b0100 !important; font-size: 40px;">Program </strong></p>
			</center>
		</div>
		<a href="{{asset('public/upload/undergraduate/program/RULES AND REGULATIONS FOR UNDERGRADUATE PROGRAMME UNDER COURSE SYSTEM.pdf')}}">
			<div style="margin-bottom: 30px; font-weight: bold; ">
				
				<p class="text-justify"><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-arrow-right"></i> Rules And Regulations For Undergraduate Program Under Course System</strong></p>
				
			</div>
		</a>
		<a href="{{asset('public/upload/undergraduate/program/COURSES FOR UNDERGRADUATE ELECTRICAL AND ELECTRONIC ENGINEERING PROGRAMME.pdf')}}">
			<div style="margin-bottom: 30px; font-weight: bold; ">
				
				<p class="text-justify"><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-arrow-right"></i> Courses For Undergraduate Electrical And Electronic Engineering Program</strong></p>
				
			</div>
		</a>
		
			<div style="margin-bottom: 30px; font-weight: bold; ">
				
				<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-arrow-right"></i>  Courses Offered In:</strong></p>
				
			</div>
		
		<div style="padding-left: 100px">
			<a href="{{asset('public/upload/undergraduate/program/L1-T1.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 1/ Term - 1</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/L1-T2.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 1/ Term - 2</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/L2-T1.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 2/ Term - 1</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/L2-T2.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 2/ Term - 2</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/L3-T1.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 3/ Term - 1</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/L3-T2.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 3/ Term - 2</strong></p>
				</div>
			</a>
			<a href="{{asset('public/upload/undergraduate/program/Level 4.pdf')}}">
				<div style="margin-bottom: 30px; font-weight: bold; ">
					<p><strong style="color: #7b0100 !important; font-size: 20px;"><i class="fas fa-list-ul"></i>  Level - 4</strong></p>
				</div>
			</a>
		</div>
	</div>

</section>
@include('frontend.layouts.footer')
@endsection