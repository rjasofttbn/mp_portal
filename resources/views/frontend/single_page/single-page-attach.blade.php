@extends('frontend.layouts.index')
@section('content')
@include('frontend.layouts.loader')
@include('frontend.layouts.header')
@include('frontend.layouts.banner')

<style type="text/css">
  #Iframe-Master-CC-and-Rs {
    max-width: 100%;
    /*max-height: 1260px; */
    overflow: hidden;
  }

  .responsive-wrapper {
    position: relative;
    height: 0;
  }

  .responsive-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    margin: 0;
    padding: 0;
    border: none;
  }
  .responsive-wrapper-wxh-572x612 {
    padding-bottom: 107%;
  }
  .set-border {
    border: 5px inset #4f4f4f;
  }
  .set-box-shadow { 
    -webkit-box-shadow: 4px 4px 14px #4f4f4f;
    -moz-box-shadow: 4px 4px 14px #4f4f4f;
    box-shadow: 4px 4px 14px #4f4f4f;
  }
  .set-padding {
    padding: 40px;
  }
  .set-margin {
    /*margin: 3+0px;*/
  }
  .center-block-horiz {
    margin-left: auto !important;
    margin-right: auto !important;
  }
</style>
<section class="background_bg bg_linen bg_fixed">
  <div id="Iframe-Master-CC-and-Rs" class="set-margin set-padding set-border set-box-shadow center-block-horiz">
    <div class="responsive-wrapper responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto;">
      <iframe id="showImage" src="{{$menu_url_data['url_link'] ? url('public/backend/menu_fle/'.$menu_url_data['url_link']) : url('public/upload/nofile.png')}}"> </iframe>
    </div>
  </div>
</section>
@include('frontend.layouts.footer')
@endsection