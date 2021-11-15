$('#form_search').submit(function(e){
    e.preventDefault();
    $('#col').html('');
    $('#p').html('');
    let search_name = $('#search_name').val();
    if(search_name < 1){
        alert('Fadlan qur magaca alaabta');
    }else{
        let send  = {
            'search_name' : search_name,
            'action' : 'alaabta_taalla',
        }
        $.ajax({
            method : 'POST',
            dataType : 'JSON',
            url :  '../apl/ibso_alaabta.php',
            data :  send,
            success : function(data){
              let status = data.status;
              let per = data.data;
              let html ='';
              if(status){
                html  += `   <table class="table">
                <thead>
                   <tr>
                   <th>Macaga alaabta</th>
                    <th>Ista xabu</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>${search_name}</td>
                        <td>${per}</td>
                    </tr>
                </tbody>
            </table>`
                    $('#col').append(html);
                }
                if(per == 'ma taaku alaabta'){
                    let alert ='ma taarlu alaabta';
                    $('#p').append(alert);
                }
            },
            error : function(data){
               console.log(per)
            },
         })
    }
})
$('#add').click(function(){
    $('#modal').modal('show');
})
$('#form').submit(function (event) { 
    event.preventDefault();
    $('#di').html('');
    let form_data = new FormData($('#form')[0]);
       form_data.append('action','alaabta_iib');
    $.ajax({
       method : 'POST',
       dataType : 'JSON',
       url :  '../apl/ibso_alaabta.php',
       data :  form_data,
       processData : false,
       contentType : false,
       success : function(data){
         let status = data.status;
         let per = data.data;
         abdi(status,per);
       },
       error : function(data){
          abdi(status,per);
       },
    })
 })
ler();
 function ler(){
    $('#table tbody').html('');
    let send ={
       'action' :  'khar'
    }
    $.ajax({
       method : 'POST',
       dataType : 'JSON',
       url :  '../apl/ibso_alaabta.php',
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
    $('#di').html('');
 })
 $('#xa').click(function(){
    $('#form')[0].reset();
    $('#di').html('');
 }) 