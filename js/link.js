option();
abc();
function option(){
    let send ={
       'action' :  'phplink'
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
                   html += `<option value="${item}">${item}</option>`;
             })
             $('#link').append(html);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }
 $('#add').click(function(){
    $('#modal').modal('show');
})
function abc(){
    let send ={
        'action' :  'khar_category'
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
                    html += `<option value="${item['id']}">${item['name']}</option>`;
              })
              $('#category').append(html);
              alert(item['name'])
           }
         },
         error : function(data){
            console.log(data);
         },
     })
}
let btn = 'insert';
ler();
$('#form').submit(function (event) { 
    $('#di').html('');
   event.preventDefault();
   let form_data = new FormData($('#form')[0]);
   if(btn == 'insert'){
      form_data.append('action','reg_link');
   }else{
      form_data.append('action','update_link');
   }

   $.ajax({
      method : 'POST',
      dataType : 'JSON',
      url :  '../apl/sys.php',
      data :  form_data,
      processData : false,
      contentType : false,
      success : function(data){
        let status = data.status;
        let per = data.data;
        abdi(status,per);
        btn = 'insert';
      },
      error : function(data){
         abdi(status,per);
      },
   })
})
function ler(){
    $('#table tbody').html('');
    let send ={
       'action' :  'khar_link'
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
          let tr = '';
          if(status){
             per.forEach(item =>{
                tr += '<tr>';
                for(let i in item){
                   tr += `<td>${item [i]}</td>`;
                }
                tr += `<td><a  class="btn btn-primary update_info text-white" update_id = ${item['id']}><i class="fas fa-edit"></i></a><a class="ml-2"></a> </td>`;
                tr += '</tr>';
             })
             $('#table tbody').append(tr);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }

 function all(id){
    let send ={
       'action' :  'all_link',
       'id' :  id,
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
          let tr = '';
          if(status){
             $('#name').val(per[0].name);
             $('#link').val(per[0].link);
             $('#category').val(per[0].category);
             $('#id').val(per[0].id);
             $('#modal').modal('show');
             btn = 'update';
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }

 function abdi(status,message){
    let abdi = '';
    if(status == true){
        abdi = `
        <div class="alert alert-success"  role="alert">
        ${message}
        </div>
        `;
        setTimeout(function(){
            $('#modal').modal('hide');
            $('#form')[0].reset();
            $('#di').html('');
            ler();
         },3000)
    }if(status == false){
        abdi = `
        <div class="alert alert-danger" role="alert">
        ${message}
        </div>
        `;
    }
    $('#di').append(abdi);
}
 $('#x').click(function(){
    $('#form')[0].reset();
    let error =  document.querySelector('.alert-error');
     error.classList = 'alert alert-danger d-none ';
 })
 $('#xa').click(function(){
    $('#form')[0].reset();
    let error =  document.querySelector('.alert-error');
     error.classList = 'alert alert-danger d-none ';
 }) 
 
$('#table').on("click",'a.update_info',function(){
    let id = $(this).attr('update_id');
    all(id);
 })
 $('#table').on("click",'a.delete_info',function(){
    let id = $(this).attr('delete_id');
      dele(id);
 })