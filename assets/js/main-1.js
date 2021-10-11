$(document).ready(function(){
   $.ajax({
       url:"{{route('user-visit-log.store')}}",
       type:"post",
       data:{
           _token:"{{csrf_token()}}",
       },
       success: function(res){
           console.log('res', res);
       },
       error:function(error){
           console.log('error', error);
       }
   })
})