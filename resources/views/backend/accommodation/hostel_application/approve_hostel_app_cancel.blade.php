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
              <td style="text-align: right; font-size: 21px;">???????????????????????? ??????????????? ???????????? ????????????????????? <b style="color:white;">>afsdh</b></td>
              <td rowspan=2  style="text-align: center;">  
                  <img src="{{asset('public/backend/jpm.jpg')}}" width="80px"> </td>
            </tr>
            <tr>
              <td style="text-align: right; font-size: 21px;">??????????????? ????????? ???????????? <b style="color:white;">>afsdafasdfd</b></td>
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
           <td  style="text-align: right;">  <p>?????? ?????????????????? ????????????<br>                 ??????????????????                                 
             ?????? ??????????????? ????????????</h4></p></td>
         </tr>
   </table>
   <table  style="width: 100%;">
   <tr>
       <td style="font-size: 21px; "> ???????????????-...............................</td>
   </table>
       
     </div>
     <div class="head_title_acc">??????????????????,  
        <br>
        <div class="pdding-text"> {{ $app_data[0]->p_name_bn }} 
            <br>
            ?????????????????? ????????????-???????????????
            <br>
            {{ $app_data[0]->number.' '.$app_data[0]->con_bn_name }} 
            <br>
            ???????????????????????? ??????????????? ????????????, ???????????? ???
        </div>
        </div>
    <div class="subject">???????????????-  ??????????????????????????? ????????? ??????????????? ??????????????? ???????????? ???????????? ??????????????????</div><br>
    <div class="mohdoy">???????????????,</div>
    <div class="header_content_acc">                
        ???????????????????????? ??????????????? ???????????? ??????????????????????????? ????????????????????? ??????????????????????????? ????????? ??????????????? ??????????????? {{ $app_data[0]->hostel_fl_bn.' '.$app_data[0]->hostel_ofr_bn }}  ?????? ???????????? ???????????? ???????????????????????????????????? ????????????????????????????????? ??????????????? ??????????????? ????????? ????????? ???
  </div>
  <h2>????????????????????????/???????????????????????????</h2> 
       
        <div class="header_content_acc">??????   ?????????????????? ?????????????????? ?????? ??????????????????????????? ???????????????????????????????????? ???????????? ????????? ????????????????????????????????? (????????? ???????????? ) ???????????????????????? ????????????????????? ???????????? ???????????? ????????? ????????? ???????????? ???????????? ??????????????? ????????? ?????????????????? ?????????????????? ??????????????????????????? ???????????????????????????????????? ???????????? ?????????????????? ???????????? ????????????????????? ??????????????? ???????????? ????????????</div>

        <div class="header_content_acc">??????	?????????????????????????????? ??????????????? ?????? ??????????????? ??????????????? ?????????????????? ?????????????????? ???????????? ???????????? ???????????? ????????????????????? ??? ?????????????????? ??????????????? ????????? ???????????? ????????????</div>
        <div class="header_content_acc">??????	???????????? ?????????????????? ??????????????????????????? ????????????????????? ???????????? ???????????? ???????????? ?????????????????? ?????? ?????????????????? ????????? ???????????? ?????????????????? ????????????-????????????????????? ???????????? ?????????????????? ???????????????????????? ??????????????? ???????????? ??????????????????????????? ????????? ???????????????????????????/ ??????????????????????????? ???????????? ???????????? ???????????? ?????????</div>

        <div class="header_content_acc">??????	???????????? ?????????????????? ???????????? ??????????????????????????? ?????????/- ???????????? ????????? ???????????? ?????????????????? ???????????? ??????????????????????????? ????????????/- ???????????? ??????????????? ??? ????????????????????? ??????????????? ??????????????? ????????? ??????????????? ????????? ?????????????????? ???????????? ????????? ??? ???????????? ???????????? ?????????????????? ????????????-??????????????? ?????????????????? ???????????? ????????? ????????????????????? ???????????? ???????????? ????????? ???????????? ?????????????????? ???????????? ??????(?????????) ????????? ??????????????? ??????????????? ???????????? ???????????? ?????????????????? ?????????????????? ??????????????? ????????? ???????????? ????????????</div>

        <div class="header_content_acc">??????	??????????????????????????? ?????????????????? ?????????????????? ??????????????????????????? ???????????? ???????????? ????????? ???????????? ????????????????????? ????????? ???????????? ?????? ????????? ???????????? ??????????????? ?????????......??? ??????????????? ???????????? ??????????????? ????????? ?????? ????????????????????? ???????????? ?????????????????? ?????????????????? ??????????????? ????????? ????????????</div>

        <div class="header_content_acc">??????	?????????????????? ????????????-??????????????? ??? ??????????????? ???????????????????????? ???????????????????????? ?????????????????????????????? ???????????????????????? ??????????????? ???????????? ??????????????????????????? ???????????? ??????????????????????????? ????????????-?????????????????? ???????????? ??????????????????????????? ???????????????????????? ?????????????????? ????????? ??????????????????????????? ???????????????????????? ????????? ????????? ??????????????????????????????????????? ????????????????????? ???????????? ????????? ???????????? ???????????? ???????????? ??????????????? ??????????????????????????????????????? ????????????????????? ?????????????????? ?????????????????? ??????????????????????????? ???????????????????????? ???????????? ????????????</div>

        <div class="header_content_acc">?????? 	?????????????????? ????????????-????????????????????? ??????????????? ???????????????????????? ???????????? ???????????? ?????? ????????? ??????????????? ????????????-??????????????? ?????? ???????????? ?????? ??????????????? ??????????????? ????????? ???????????? ????????????</div>

        <div class="header_content_acc">??????  ???????????? ??????????????????, ??????????????? ??? ?????????????????????????????? ??????????????? ????????????????????????????????? ?????????????????????????????? ????????????????????? ????????? ???????????? ????????????</div>
        
    <div class="outer">
        <div class="right">
            ??????????????? ???????????????????????? <br>
            ( {{$app_data[0]->p_name_bn }} ) <br>
            
        </div>    
     </div> 
    </div>
</body>
</html>