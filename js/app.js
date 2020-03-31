$(document).ready(function(){
    let check = [];
    let productSelected= document.querySelector('#productSelected');
    let icon1 = document.querySelectorAll('.icon1');
    let icon2 = document.querySelectorAll('.icon2');



    for(let x=0 ; x<icon1.length; x++){
        icon1[x].addEventListener('click',function(){
            this.classList.toggle('icon');
            this.nextElementSibling.classList.toggle('icon');
            let valueadd= this.parentElement.lastElementChild.innerText.trim();
            valueadd = Number(valueadd);
            check.push(valueadd);
            numberofitem()

            ajaxwithitemshow()

        });
    }


    for(let x=0 ; x<icon1.length; x++){
        icon2[x].addEventListener('click',function(){
            this.classList.toggle('icon');
            this.previousElementSibling.classList.toggle('icon');
            let valueremove= this.parentElement.lastElementChild.innerText.trim();
            
            valueremove = Number(valueremove);
            let removeindexcheck = check.indexOf(valueremove);
            check.splice(removeindexcheck,1);
            numberofitem()

            ajaxwithitemshow()
        });
    }


    function numberofitem(){
        let getProductNumber= check.length;
        productSelected.innerText= getProductNumber;
    }
   

    // for ajax
     $('#productSelected').click(function(){
       let ourdata = productSelected.innerText;
        if(ourdata >= 1){
            ajaxwithitemshow()
        }else{
            $.get('cantshow.php', function(response){ 
                $("#itemshow").html(response);
            });
        }


     });


     let comparebtn = document.querySelector('#btnCompare');
     comparebtn.addEventListener('click',function(){
         $.post('compare.php',{checkdata: check});
     });

   if (window.performance.navigation.type == 1) {
         ajaxwithitemshow()
    }


    function ajaxwithitemshow(){
        $.get('itemshow.php', {checkdata: check}, function(response){ 
            $("#itemshow").html(response);
        });
    }

});
