/**
 * Created by Administrator on 2016/7/28 0028.
 */

function changeStatus(){
    var coverl_atz=document.getElementById('coverl_atz');
    var coverl_zta=document.getElementById('coverl_zta');
    if(coverl_atz.style.display=='block'){
        coverl_atz.style.display='none';
        coverl_zta.style.display='block';
    }else{
        coverl_atz.style.display='block';
        coverl_zta.style.display='none';
    }

}

