function del_cat(cid){
    if(!cid){
        return false;
    }
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: 'cid=' + cid,
        url: '/admin/categories/delcategories',
        success: function(response){
            if(response){
                alert(response.message);
                if(response.status === true){
                    location.reload(true);
                }
            }else{
                alert('系统错误');
            }
        }
    });
}