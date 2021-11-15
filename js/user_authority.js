ler();
user();
$('#all').on('change',function(){
    if($(this).is(':checked')){
         $('input[type="checkbox"]').prop('checked',true);
    }else{
            $('input[type="checkbox"]').prop('checked',false);
    }
})

$('#rowall').on('change','input[name="category_name[]"]',function(){
    let value = $(this).val();
    if($(this).is(':checked')){
        $(`#rowall input[type="checkbox"][category_name="${value}"]`).prop('checked',true);
 }else{
        $(`#rowall input[type="checkbox"][category_name="${value}"]`).prop('checked',false);
 }
})

function user(){
    let send ={
         'action' :  'user'
    }
    $.ajax({
         method : 'POST',
         dataType : 'JSON',
         url :  '../apl/sys.php',
         data :  send,
         success : function(data){
                let status = data.status;
                let per = data.data;
                let html ='';
                if(status){
                     per.forEach(item =>{
                                 html += `<option value="${item['id']}">${item['username']}</option>`;
                     })
                     $('#user').append(html);
                    }
            },
            error : function(data){
                 console.log(data);
            },
    })
}

function ler(){
    let send ={
         'action' :  'khar'
    }
    $.ajax({
         method : 'POST',
         dataType : 'JSON',
         url :  '../apl/sys.php',
         data :  send,
         success : function(data){
                let status = data.status;
                let per = data.data;
                let html ='';
                let category_name = '';
                let system_link = '';
                let system_action = '';
                if(status){
                     per.forEach(item =>{
                            for(let i in item){
                                if(item['category_name'] !== category_name){
                                        html +=`
                                        </fieldset>
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <fieldset class="authority">
                                                    <legend class="authority">
                                                    <input type="checkbox" id="category_name" name="category_name[]" value="${item['category_name']}" class="mr-1">
                                                    ${item['category_name']}
                                                    </legend>
                                        `;
                                        category_name = item['category_name'];
                                }
                                if(item['link_name'] !== system_link){
                                        html += `
                                        <div class="control-group">
                                            <label class="control-label">
                                                    <input type="checkbox" name="link[]" id="" value="${item['link_id']}" category_name = '${item['category_name']}' name = '${item['name']}'id = '${item['id']}'>
                                                    ${item['link_name']}
                                            </label>
                                        `;
                                        system_link = item['link_name'];
                                }

                               
                            }
                     })
                     $('#rowall').append(html);
                }
            },
            error : function(data){
                 console.log(data);
            },
    })
}

$('#formuser').submit(function (event) { 
    event.preventDefault();
    let user = $('#user').val();
    let link = [];
    if(user == 0){
           alert('dooro user');
           return;
    }
    $('input[name="link[]"').each(function(){
           if($(this).is(':checked')){
                link.push($(this).val());
           }
    })
    let send ={
           'user_id' : user,
           'link' : link,
           'action' : 'reg',
       }
$.ajax({
           method : 'POST',
           dataType : 'JSON',
           url :  '../apl/sys.php',
           data :  send,
           success : function(data){
               let status = data.status;
               let per = data.data;
               alert(per);
           },
           error : function(data){
               alert(per);
           },
    })
})
