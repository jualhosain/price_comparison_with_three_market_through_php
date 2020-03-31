$(document).ready(function () {
    let mOne = document.querySelector('#market_one');
    let mTwo = document.querySelector('#market_two');
    let mThree = document.querySelector('#market_three');

    let oneBtn = document.querySelectorAll('#market_one button');
    let twoBtn = document.querySelectorAll('#market_two button');
    let threeBtn = document.querySelectorAll('#market_three button');
    let selectpost = document.querySelectorAll('#selectpost .item-post');

    let checkrow = document.querySelectorAll('#market_one tbody tr');
    let numRow = checkrow.length-1;

    if(numRow == 0){
        window.location.href = "index.php";
    }

    checkandupdate(oneBtn);
    checkandupdate(twoBtn);
    checkandupdate(threeBtn);


   function checkandupdate(button){
    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', function () {

                 let idOne = oneBtn[i].parentElement.parentElement.children[2].getAttribute('value');  
                 let idTwo = twoBtn[i].parentElement.parentElement.children[2].getAttribute('value');  
                 let idThree = threeBtn[i].parentElement.parentElement.children[2].getAttribute('value');  

                let totalOne= oneBtn[i].parentElement.parentElement.parentElement.lastElementChild.lastElementChild;
                let totalTwo= twoBtn[i].parentElement.parentElement.parentElement.lastElementChild.lastElementChild;
                let totalThree= threeBtn[i].parentElement.parentElement.parentElement.lastElementChild.lastElementChild;


                totalValue_one = totalOne.innerText;
                totalValue_two = totalTwo.innerText;
                totalValue_three = totalThree.innerText;

                oneBtn[i].parentElement.parentElement.remove();
                twoBtn[i].parentElement.parentElement.remove();
                threeBtn[i].parentElement.parentElement.remove();
                selectpost[i].remove();
                
                totalOne.innerText = eval(totalValue_one - idOne) ;
                totalTwo.innerText = eval(totalValue_two - idTwo) ;
                totalThree.innerText = eval(totalValue_three - idThree) ;

                // ajax

                $.post('removedata.php',{price_id: idOne});

                if(numRow < 2){
                    window.location.href = "index.php";
                }
        });
    }
   }
            

















    // let click_price;
    // let total_price=0;

    // for (let i = 0; i < oneBtn.length; i++) {
    //     oneBtn[i].addEventListener('click', function () {
    //       let click_price = this.parentElement.parentElement.children[2].getAttribute('value');  

    //       for(let j=0; j<oneBtn.length; j++){
    //          y= oneBtn[j].parentElement.parentElement.children[2].getAttribute('value');
    //          total_price += Number(y);  
    //       }
    //       current= total_price - click_price
    //          console.log(current);
    //          current =0;
    //     });

    // }








        // let one = marketPrice(oneBtn);
    // let two = marketPrice(twoBtn);
    // let three = marketPrice(threeBtn);

    // function marketPrice(button) {
    //     // for (let i = 0; i < button.length; i++) {
    //     //     button[i].addEventListener('click', function () {
    //     //         currentvalue = this.parentElement.parentElement.children[2].getAttribute('value');
    //     //         return currentvalue;
    //     //     });
    //     // }
    //     for(let x =0; x< button.length; x++){
    //         button[x].addEventListener('click', function () {

    //           // console.log('hello');
    //            return 'hello';
    //         });
    //     }

    // }


});