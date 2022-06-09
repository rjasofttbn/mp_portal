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

    .bottom_rolles {
        font-size: 20px;
        margin-top: 15px;
        line-height: 41px;
        text-align: justify;
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
  /* width: 43%; */
  /* padding: 10px; */
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
<div class="main">
    <div class="head_title_acc text-center">
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
      <td colspan=2  style="text-align: center; color:blue;">  <u>www.parliament.gov.bd<u></td>
        </tr>
</table>

<table  style="width: 100%;">
    <tr>
           <td style="font-size: 21px; "> </td>
           <td  style="text-align: right;">  <p>১৪ শ্রাবণ ১৪২৭<br>                 তারিখঃ                                 
             ২৯ জুলাই ২০২০</h4></p></td>
         </tr>
   </table>
   <table  style="width: 100%;">
   <tr>
       <td style="font-size: 21px; "> নম্বর-...............................</td>
   </table>
       
     </div>
     <div class="head_title_acc">প্রাপক,  
        <br>
        <div class="pdding-text"> {{ $app_data[0]->p_name_bn }} 
            <br>
            মাননীয় সংসদ-সদস্য
            <br>
            {{ $app_data[0]->number.' '.$app_data[0]->con_bn_name }} 
            <br>
            বাংলাদেশ জাতীয় সংসদ, ঢাকা ।
        </div>
        </div>
    <div class="subject">বিষয়ঃ-  শেরেবাংলা নগর সদস্য ভবনের অফিস কক্ষ বাতিল।</div><br>
    <div class="mohdoy">মহোদয়,</div>
    <div class="header_content_acc">                
        বাংলাদেশ জাতীয় সংসদ সচিবালয়ের আওতাধীন শেরেবাংলা নগর সদস্য ভবনের {{ $app_data[0]->hostel_fl_bn.' '.$app_data[0]->hostel_ofr_bn }}  নং অফিস কক্ষ নির্দেশক্রমে নিম্নবর্ণিত শর্তে বাতিল করা হলো ।
  </div>
  <h2>শর্তাবলী/নিয়মাবলীঃ</h2> 
       
        <div class="header_content_acc">১।   বরাদ্দ পাওয়ার পর সংশ্লিষ্ট কেয়ারটেকারের নিকট হতে আসবাবপত্রসহ (যদি থাকে ) অন্যান্য সরঞ্জাম বুঝে নিতে হবে এবং কক্ষ ছেড়ে দেয়ার সময় কক্ষের দখলভার সংশ্লিষ্ট কেয়ারটেকারের নিকট বুঝিয়ে দিয়ে ছাড়পত্র গ্রহণ করতে হবে।</div>

        <div class="header_content_acc">২।	বরাদ্দপত্র জারির এক মাসের মধ্যে কক্ষের দখলভার বুঝে নিতে হবে। অন্যথায় এ বরাদ্দ বাতিল বলে গণ্য হবে।</div>
        <div class="header_content_acc">৩।	সংসদ কমিটির সিদ্ধান্ত মোতাবেক অফিস কক্ষ বুঝে নেওয়ার পর কক্ষের সকল চাবি মাননীয় সংসদ-সদস্যের নিকট থাকবে। বাংলাদেশ জাতীয় সংসদ সচিবালয়ের কোন কর্মকর্তা/ কর্মচারীর নিকট চাবি থাকব না।</div>

        <div class="header_content_acc">৪।	একটি কক্ষের জন্য প্রতিমাসে ৫০০/- টাকা এবং দুটি কক্ষের জন্য প্রতিমাসে ১০০০/- টাকা মাসের ৫ তারিখের মধ্যে সদস্য ভবন শাখায় জমা প্রদান করতে হবে । অফিস কক্ষ মাননীয় সংসদ-সদস্য ব্যতিত অন্য কেউ ব্যবহার করলে অন্য কোন অফিস কক্ষের ভাড়া ০৩(তিন) মাস বকেয়া থাকলে উক্ত অফিস কক্ষের বরাদ্দ বাতিল বলে গণ্য হবে।</div>

        <div class="header_content_acc">৫।	বরাদ্দকৃত কক্ষটি অফিসের কার্যক্রম ছাড়া অন্য কোন কাজে ব্যবহার করা যাবে না এবং উক্ত কক্ষে কেউ......। বসবাস করতে পারবে না। এর ব্যত্যয় ঘটলে কক্ষের বরাদ্দ বাতিল করা হবে।</div>

        <div class="header_content_acc">৬।	মাননীয় সংসদ-সদস্য ও তাদের পরিবারের সদস্যদের নিরাপত্তার স্বার্থে মানিক মিয়া অ্যাভিনিউ অথবা নাখালপাড়া সংসদ-সদস্যে ভবনে বরাদ্দকৃত ফ্ল্যাটে অফিসের কোন কার্যক্রম পরিচালনা করা এবং দর্শনার্থীদের সাক্ষাত দেয়া না। তাকে উক্ত অফিস কক্ষে দর্শনার্থীদের সাক্ষাত দেয়াসহ অফিসের কার্যক্রম পরিচালনা করতে হবে।</div>

        <div class="header_content_acc">৭। 	মাননীয় সংসদ-সদস্যের মেয়াদ পূর্তিতে অথবা অন্য যে কোন কারনে সংসদ-সদস্য পদ বহাল না থাকলে বাতিল বলে গণ্য হবে।</div>

        <div class="header_content_acc">৮।  কক্ষ বরাদ্দ, বাতিল ও পরিবর্তনের বিষয়ে কর্তৃপক্ষের সিদ্ধান্তই চূড়ান্ত বলে গণ্য হবে।</div>
        
    <div class="outer">
        <div class="right">
            আপনার বিশ্বস্ত <br>
            ( {{$app_data[0]->p_name_bn }} ) <br>
            
        </div>    
     </div> 
    </div>
</body>
</html>