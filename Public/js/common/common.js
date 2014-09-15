function get_sub_categories(obj){
        
    $(obj).next().remove();

    var cid = obj.value;

    /*
     * 将最近的一级分类放入hidden中(也就是得到父级分类ID)
     * 多级联动
     * 如果顶级的分类是0
     *     看看prev有没有值
     *         如果有值(非顶级分类下, 选择了'请选择'), 则将prev的value给隐藏域
     *         如果没有值, (顶级分类), 则pid = 0
     * 如果顶级分类不是0
     *     就将刚刚选择的父级分类传入隐藏域
     */ 
    if(cid == 0){
        var parent = $(obj).prev().val();
        if(!parent){
            pid = 0;
        }else{
            pid = parent;
        }
    }else{
        pid = cid;
    }
    $('input[name=pid]').val(pid);

    if(cid == 0){
        return false;
    }

    $.ajax({
        type: 'post',
        url: '/admin/categories/getsubcategories',
        dataType: 'json',
        data: 'cid=' + cid,
        success: function(response){
            if(response){
                var html = "";
                html += '<select class="s_select mr10" onchange=get_sub_categories(this)>';
                html += "<option value='0'>请选择</option>";
                for(var i = 0; i < response.length; i++){
                    html += "<option value='" + response[i].cid + "'>" + response[i].name + "</option>";
                }
                html += "</select>";
            }
            if(html){
                $(obj).after(html);
            }
        }
    });
    
}

// 左侧菜单栏点击的js
function Show_Hidden(trid){
    if(trid.style.display === "block" || trid.style.display === "" ){
        trid.style.display = 'none';
    }else{
        trid.style.display = 'block';
    }
}