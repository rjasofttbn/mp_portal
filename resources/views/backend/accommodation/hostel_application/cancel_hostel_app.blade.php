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
</style>

<body>
<div class="main">
    <div class="head_title_acc">বরাবর 
        <br>
        <div class="pdding-text"> মাননীয় চীফ হুইপ 
            <br>
            বাংলাদেশ জাতীয় সংসদ
            <br>
            ঢাকা ।
        </div>
        </div>
    <div class="subject">বিষয়ঃ-  অফিস কক্ষ বাতিল প্রসঙ্গে।</div><br>
    <div class="mohdoy">প্রিয় মহোদয়,</div>
    <div class="header_content_acc">                
        আপনার সদয় দৃষ্টি আকর্ষণ করে জানাচ্ছি যে, আমার সংসদীয় এলাকা {{ $app_data[0]->number. ' '. $app_data[0]->con_bn_name}} এবং
         শেরেবাংলা নগর সদস্য {{$app_data[0]->hostel_bu_bn}} ভবনে {{$app_data[0]->hostel_ofr_bn}} নং অফিস কক্ষ আমার নামে বরাদ্দ।

         <br>
         এমতাবস্থায়, উক্ত বরাদ্দকৃত অফিস কক্ষ বাতিলের জন্য প্রয়োজনীয় ব্যবস্থা গ্রহনের জন্য বিশেষভাবে অনুরোধ জানাচ্ছি ।
  
    </div>
    <div class="outer">
        <div class="right">
            ধন্যবাদান্তে <br>
            ( {{ $app_data[0]->number. ' '.$app_data[0]->p_name_bn }} ) <br>
             সংসদ-সদস্য <br>
             {{ $app_data[0]->con_bn_name}} <br>
             বাংলাদেশ জাতীয় সংসদ, ঢাকা । <br>
        </div>    
     </div> 
    </div>
</body>
</html>