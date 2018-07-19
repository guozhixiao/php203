@extends('layout.home')

@section('title',$title)

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .cart-empty{
        height: 98px;
        padding: 80px 0 120px;
        color: #333;

    }

    .cart-empty .message{
        height: 98px;
        padding-left: 341px;
        background: url(/uploads/no-login-icon.png) 250px 22px no-repeat;
    }

    .cart-empty .message .txt {
        font-size: 14px;
    }
    .cart-empty .message li {
        line-height: 38px;
    }

    ol, ul {
        list-style: outside none none;
    }

    .ftx-05, .ftx05 {
        color: #005ea7;
    }
    
    a {
        color: #666;
        text-decoration: none;
        
        font-size:12px;
    }   
</style>
@section('content')
<div class="i_bg">  
    <div class="content mar_20">
        <img src="/home/images/img1.jpg" />        
    </div>

    <!--Begin 第一步：查看购物车 Begin -->
   
    <div class="content mar_20">

        @if(count($res) > 0)
        <table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
          <tr>
            <td class ="car_th" width="40"><a href="javascript:void(0)" class="as">全选</a></td>
            <td class="car_th" width="100">商品图片</td>
            <td class="car_th" width="80">商品名称</td>
            <td class="car_th" width="100">颜色</td>
            <td class="car_th" width="70">尺码</td>
            <td class="car_th" width="140">价格</td>
            <td class="car_th" width="150">购买数量</td>
            <td class="car_th" width="130">小计</td>
            <td class="car_th" width="150">操作</td>
          </tr>

        @foreach($res as $k => $v)
          <tr>

            
            <td align="center"><input type="checkbox"></td>
            <td>
            <div class="c_s_img"> <a aligin="center"><img src="{{$v->gimg}}" width="73" height="73" /></a></div>
            </td>
            <td align="center">{{$v->name}}</td>
            <td align='center'>{{$v->color}}</td>
            <td align='center'>{{$v->size}}</td>
            <td align="center" class="price" style="color:#ff4e00;">{{$v->price}}</td>
            <td align="center">
                <div class="c_num">
                    <input type="button" value="-" class="car_btn_1" />

                    <input type="text" value="1" name="" class="car_ipt" />  

                    <input type="button" value="+" class="car_btn_2" />
                </div>
            </td>
            <td align="center" class="xiaoji" style="color:#ff4e00;">{{$v->price}}</td>

            <td align="center"><a onclick="ShowDiv('MyDiv','fade')"><a href="javascript:void(0)" class="remove" ids='{{$v->id}}'>删除</a></a></td>
          </tr>
        @endforeach
        
          
          <tr height="90">
            <td colspan="9" style="font-family:'Microsoft YaHei'; border-bottom:0;">
               <span class="fr" style="font-size:22px; color:#ff4e00;"></span>
            </td>
          </tr>
          <tr valign="top" height="100">
            <td colspan="9" align="right">
                <a href="#"><img src="/home/images/buy1.gif" /></a>&nbsp; &nbsp; <a href="#"><img src="/home/images/buy2.gif" /></a>
            </td>
          </tr>
         
        </table>
        @else

            <div class="cart-empty">
                        <div class="message">
                            <ul>
                                <li class="txt">
                                    购物车空空的哦~，去看看心仪的商品吧~
                                </li>
                                <li class="mt10">
                                    <a href="/home/index" class="ftx-05">
                                        去购物&gt;
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
            </div>

        @endif

    </div>
   
    <!--End 第一步：查看购物车 End--> 
    
    
    
  
</div>

@endsection


@section('js')
<script>


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //加法运算
    $('.car_btn_2').click(function(){

        var num = $(this).prev().val();

        num++;
        //加完之后数量改变
        $(this).prev().val(num);


        function accMul(arg1, arg2) {

            var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

            try { m += s1.split(".")[1].length } catch (e) { }

            try { m += s2.split(".")[1].length } catch (e) { }

            return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)

        }


        //获取单价
        var pc = $(this).parent().parent().prev().text();
        // console.log(pc);

        // 加完之后小计改变
        $(this).parent().parent().next().text(pc*num);
     totals();
    })


    //减法运算
    $('.car_btn_1').click(function(){

        var num = $(this).next().val();

        num--;

        $(this).next().val(num);

       function accMul(arg1, arg2) {

            var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

            try { m += s1.split(".")[1].length } catch (e) { }

            try { m += s2.split(".")[1].length } catch (e) { }

            return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)

        }


        var pc = $(this).parent().parent().prev().text();
        // console.log(pc);

         $(this).parent().parent().next().text(accMul(pc,num));


    totals();
    })
    

    // //单击多选框让总价发生改变
    $(':checkbox').click(function(){

        totals();
    })

    function  totals()
    {
        var sum = 0;
        $(':checkbox:checked').each(function(){

           
            var pir = parseFloat($(this).parents('tr').find('.xiaoji').text());

            // console.log(pir);

            // $('.fr').text();

            // sum += pir;

            // console.log(sum);

            function accAdd(arg1,arg2){  
                var r1,r2,m;  
                try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}  
                try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}  
                m=Math.pow(10,Math.max(r1,r2))  
                return (arg1*m+arg2*m)/m  
            }


            // // console.log(sum);

            $('.fr').text(sum = accAdd(sum, pir));

        })
    }



    //全选

   $('.as').click(function(){

        $(':checkbox').each(function(){

            // $(this).attr('checked','checked');
            $(this).attr('checked',true);
        })

        totals();
    })

    //删除
    $('.remove').click(function(){

       
        var rs =  confirm('是否确认删除商品?');

        if(!rs) return;

        //获取id
        var id = $(this).attr('ids');


        var ts = $(this);

        // //发送ajax
        $.post('/home/ajaxcart',{id:id},function(data){

            if(data == '1'){

                ts.parents('tr').remove()

                $('total').text(0.0);
                
                totals();
            }
        })
    })
</script>

@endsection
