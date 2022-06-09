<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
    body {
        font-family: 'nikosh', Poppins, sans-serif;
       
    }

    .head_title_acc {
        font-size: 20px;
        line-height: 37px;
        margin-bottom: 0px;
    }

    .main {
        float: left;
        padding-top: 50px;
        padding-left: 70px;
        padding-right: 25px;
    }

    .subject {
        font-size: 20px;
        margin-top: 25px;
    }

    .header_content_acc {
        font-size: 20px;
        margin-top: 15px;
        line-height: 41px;
        /* margin-bottom: 15px; */
        text-align: justify;
        text-indent: 60px;
    }

    .mohdoy {
        font-size: 20px;
        margin-top: 25px;
    }

    table thead tr th {
        border-right: 1px solid #000000;
        border-bottom: 1px solid #000000;
        border-top: 1px solid #000000;
    }

    table thead tr:first-child {
        border-left: 1px solid #000000;
    }

    table tbody tr:last-child {
        border-right: 1px solid #000000;
        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }
  
  /* as */
  .center {
  margin: 0 auto;
  background-color: seagreen;
  padding-top: 250px;
}

.right, .center {
  width: 290px;
  height: 150px;
  text-align:center;
  font-size: 20px;        
  line-height: 37px;
  margin-top: 70px;
  /* background:red; */
}

.right {
  float: right;
}

 /* */

    .text-center {
        text-align: center;
    }

    .pdding-text {
        padding-left: 55px;
    }
    /* header 3 div */
    /* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 29.33%;
  padding: 10px;
  height: auto; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<body>
    {{-- <div class="header_section" style="text-align:center;">
        {!! $acc_head !!}
    </div> --}}
<div class="main">
    <table  style="width: 100%;">
            <tr>
              <td style="text-align: right; font-size: 21px;">বাংলাদেশ জাতীয় সংসদ সচিবালয় <b style="color:white;">>afsdh</b></td>
              <td rowspan=2  style="text-align: center;">  
                  <img src="{{asset('public/backend/jpm.jpg')}}" width="80px"> </td>
            </tr>
            <tr>
              <td style="text-align: right; font-size: 21px;">সদস্য ভবন শাখা <b style="color:white;">>afsdafasdfd</b></td>
            </tr>
    </table>

    <table  style="width: 100%;">
        <tr>
      <td colspan=2  style="text-align: center;">  <u>www.parliament.gov.bd<u></td>
        </tr>
       <tr>
            <td style="font-size: 21px; ">     </td>
            <td  style="text-align: right;">  <p>১৪ শ্রাবণ ১৪২৭<br>                 তারিখঃ                                 
              ২৯ জুলাই ২০২০</h4></p></td>
          </tr>
</table>
   
 </div>
 <div style="font-size: 21px; "> নম্বর-...............................
</div>
    <div class="head_title_acc">প্রাপক,
        <br>
        <div class="pdding-text"> জনাব ... {{ $app_data[0]->p_name_bn }}
            <br>
            মাননীয় সংসদ-সদস্য
            <br>
            {{ $app_data[0]->number. ' '. $app_data[0]->con_bn_name}}
            <br>
            বাংলাদেশ জাতীয় সংসদ, ঢাকা।
        </div>
        </div>
    <div class="subject">বিষয়ঃ-  ফ্ল্যাটের বরাদ্দ বাতিলকরন ।</div><br>
    <div class="mohdoy">প্রিয় মহোদয়,</div>
    <div class="header_content_acc">                
        উপর্যক্ত বিষয়ে আপনার সাথে আলোচনার প্রেক্ষিতে আপনার নামে বরাদ্দকৃত {{$app_data[0]->ar_name_bn}} {{ $app_data[0]->acb_name_bn.' '.$app_data[0]->fl_name_bn.' '.$app_data[0]->f_number_bn }} 
        নং ফ্ল্যাটটির বরাদ্দ নির্দেশক্রমে বাতিল হলো।<br>
        এমতাবস্থায়, বর্ণিত ফ্ল্যাটটির দখলভার সংশ্লিষ্ট কেয়ারটেকারের নিকট বুঝিয়ে দেয়ার জন্য অনুরোধ করা হলো ।
  </div>
  
<br><br>
  <div class="left"  style=" font-size: 19px;">
    আপনার বিশ্বস্ত, <br><br>
    (আবদুর রহমান)<br><br>
    সিনিয়র সহকারী সচিব<br><br>
    ফোন-৯১২৪৭৬৩ <br>
</div> 
<br><br>
<table  style="width: 100%;">
 <tr>
        <td style="font-size: 21px; "> নম্বর-...............................</td>
        <td  style="text-align: right;">  <p>১৪ শ্রাবণ ১৪২৭<br>                 তারিখঃ                                 
          ২৯ জুলাই ২০২০</h4></p></td>
      </tr>
</table>


<h2>সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহনের জন্য অনুলিপি প্রেরণ করা হলোঃ</h2>
<p style="font-size: 21px; line-height: 41px;">
১। 	মাননীয় স্পিকার এর একান্ত সচিব, বাংলাদেশ জাতীয় সংসদ, ঢাকা। <br>
২। 	মাননীয় চীপ হুইপ এর একান্ত সচিব, বাংলাদেশ জাতীয় সংসদ, ঢাকা। <br>                    
৩। 	সিনিয়র সচিব মহোদয়ের একান্ত সচিব, বাংলাদেশ জাতীয় সংসদ সচিবালয়, ঢাকা।<br>
৪। 	সহকারী সচিব, অর্থ , শাখা-২, বাংলাদেশ জাতীয় সংসদ সচিবালয়, ঢাকা।<br>
৫।	নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা, অডিট ইউনিট বাংলাদেশ জাতীয় সংসদ সচিবালয়, ঢাকা।<br>
৬।	অতিরিক্ত সচিব (এ, এস) মহোদয়ের ব্যক্তিগত কর্মকর্তা, বাংলাদেশ জাতীয় সংসদ সচিবালয়, ঢাকা।<br>
৭। 	উপসচিব (প্রশাসন-২)মহোদয়ের ব্যক্তিগত কর্মকর্তা, বাংলাদেশ জাতীয় সংসদ সচিবালয়, ঢাকা।<br>
৮।	কেয়ারটেকার, মানিক মিয়া অ্যাভিনিউস্থ ১-৩ নম্বর সংসদ সদস্য ভবন, ঢাকা ।<br>
৯। 	রেকর্ড ।	
</p>


    <div class="outer">
        <div class="right">
            (আবদুর রহমান) <br>
            সিনিয়র সহকারী সচিব <br>
        </div>    
     </div> 
    </div>
</body>
</html>