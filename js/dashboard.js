ler();
week();
lacagta();
 function ler(){
    $('#table tbody').html('');
    let send ={
       'action' :  'alaabta'
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
             per.forEach(item =>{
                for(let i in item){
                   html += `<h3 class="f-w-300 d-flex align-items-center m-b-0">${item[i]}</h3>`;
                }
               
             })
             $('#inta').append(html);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }

 function week(){
    $('#table tbody').html('');
    let send ={
       'action' :  'week'
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
             per.forEach(item =>{
                for(let i in item){
                   html += `<h3 class="f-w-300 d-flex align-items-center m-b-0">$${item[i]}</h3>`;
                }
               
             })
             $('#week').append(html);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }

 function lacagta(){
    $('#table tbody').html('');
    let send ={
       'action' :  'lacagta'
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
             per.forEach(item =>{
                for(let i in item){
                   html += `<h3 class="f-w-300 d-flex align-items-center m-b-0">$${item[i]}</h3>`;
                }
               
             })
             $('#lacagta').append(html);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }