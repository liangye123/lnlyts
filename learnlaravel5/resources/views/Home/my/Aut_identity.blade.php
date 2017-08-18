@include('Home.layouts.myhead')
        <!--个人中心-->
<div class="wrapper wbgcolor">
    <div class="w1200 personal">
        <div class="credit-ad"><img src="../Home/images/clist1.jpg" width="1200" height="96"></div>
        @include('Home.layouts.myleft')
        <div style="margin-top: 40px" align="center">
            <form action="Aut" method="post">
                <table style="width: 500px;height: 200px">
                    <input type="hidden" name="id" value="{{$id}}">
                    <tr>
                        <td>请输入身份证号码：</td>
                        <td><input type="text" id="idcard" style="border-color:darkblue; border-style: solid" name="identity"><span id="id_card"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" style="background-color:darkorange; width: 80px;height: 30px; color: white" value="绑定身份证"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@include('Home.layouts.foot')
<script>
    $(document).on("blur","#idcard",function(){
        var idcard=$(this).val()

        var reg = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
        var flag = reg.test(idcard); //true
        if(flag){
            $.ajax({
                url:"idcard",
                data:{idcard:idcard},
                dataType:"json",
                type:"GET",
                success:function(msg){
                    if(msg==0){
                        $("#id_card").html('<span style="color: red">身份证不存在</span>')
                    }
                    if(msg==1){
                      $("#id_card").html('<span style="color: green">通过验证</span>')
                    }
                    if(msg==2){
                        $("#id_card").html('<span style="color: red">已被认证</span>')
                    }
                }
            })



        }else{
            $("#id_card").html('<span style="color: red">身份证格式错误</span>')
        }
    })

</script>
