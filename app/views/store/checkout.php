<?php
 
    // $this->view("store/header",$data);
    include "header.php";

   if (isset($_SESSION['CART_ITEMS']) && $_SESSION['CART_ITEMS'] !="" ) {
      
    $items = $_SESSION['CART_ITEMS'];
    // echo "all items above this<br/>";
// display($items);
    // display($items);exit;
    $price = [];
    $book=[];
    $unitprice=[];
    $quantity=[];
    // $quantity = 0;
    $total =0;
    for($i=0; $i < count($items); $i++){
        $price[$i]= $i;
        $book[$i] =$i;
        $unitprice[$i] =$i;
        $quantity[$i]=$i;
    }
   
     for ($count = 0; $count < count($items); $count++) {
               $price[$count] += $items[$count]['cart_qty'] * $items[$count]['price'];
               $book[$count] = $items[$count]['title'];
               $unitprice[$count] = $items[$count]['price'];
               

       }  
          
 
    //name and price for each
    
    $cart_items = array_combine($book,$price);
    // print_r($cart_items);die;
    //make name and pice of all stuff on cart accessible everywhere

    $_SESSION['checkout'] = $cart_items;

    foreach($cart_items as $name => $price){
        // echo $name;
    }

    // echo "name and total of each item  <br />";
    // show($cart_items); //name and price

    //quantity for each item in cart
    $j=0;
    foreach($items as $key => $item){
        $quantity[$j] = $item['cart_qty'];
        $j++;
    }

    // echo "quantity of each <br />";
   // show($quantity);//quantity


    // echo "Combined price and quantity<br />";
    $combined = array_combine($quantity,$cart_items);
    // show($combined);

    $name_qty_price = [];
    foreach($cart_items as $name =>$tatolPrice){
        foreach($combined as $items){
            $name_qty_price[$name] = $items;
        }
    }

    // echo "Name qty  price  saaga<br />";

   
          
   }

?>


<div class="container" style="max-width: 1000px;">
    <!-- if items in cart show checkout form if not -->
  <?php if(isset($_SESSION['CART_ITEMS']) && $_SESSION['CART_ITEMS'] !="" && count($cart_items)>0):?>
   
    <div class="py-5 text-center">
        
        <h2>Checkout Details</h2>
        <p class="lead">Fill the form to proceed with checkout.</p>
    </div>
    <div class="row">
        <div class="col-md-8 order-md-1 mb-4">
       
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">On your cart</span>
               
            </h4>
            <ul class="list-group mb-3 sticky-top">
            
            <?php foreach($cart_items as $name=> $price):?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  
                    <div>
                        <h6 class="my-2"><?=$name?></h6>
                        <small class="text-muted">Standard price</small>
                    </div>
                    <span class="text-muted">$<?=$price?></span>
                 
                </li>
        
                <?php endforeach;?>
               
                <!-- <li class="list-group-item d-flex justify-content-between">
                    <?php if(isset($_SESSION['total']) && $_SESSION['total'] != "" ):?>
                    <span>Total (USD)</span>
                    <div class="d-flex flex-end" style="margin-right:-20px;">
                      <span class="fw-bold">$</span>
                      <input type="text" id="shownamount" name="shownamount" class="border border-0 fw-bold " style="width:70px;" aria-labelledby="shownamount" readonly  value="<?=$_SESSION['total']?>"/>
                      <input type="text" id="shownamount" name="shownamount" class="border border-0 fw-bold " style="width:70px;" aria-labelledby="shownamount" readonly  value="<?=$_SESSION['total']?>"/>
                    </div>                   
                    <?php endif; ?>
                </li>  -->

              
                <li class="list-group-item d-flex justify-content-between">
                    <?php if(isset($_SESSION['total']) && $_SESSION['total'] != "" ):?>
                    <span>Total (USD)</span>
                    <div class="d-flex flex-end" style="margin-right:-20px;">
                      <span class="fw-bold">$</span>
                      <input type="text" id="shownamount" name="shownamount" class="border border-0 fw-bold " style="width:70px;" aria-labelledby="shownamount" readonly  value="<?=$_SESSION['total']?>"/>
                    </div>                   
                    <?php endif; ?>
                </li> 

                <li class="list-group-item d-flex justify-content-between">
                    <?php if(isset($_SESSION['total']) && $_SESSION['total'] != "" ):?>
                    <div class="d-flex flex-end">
                      <!-- <span class="fw-bold">$</span>                      -->
                      <input type="text" id="amount" name="amount" class="border border-0 fw-bold small " style="width:70px; color:white;" aria-labelledby="amount" readonly  value="<?=$_SESSION['total']?>"/>
                    </div>
                   <?php endif; ?>
                </li> 
            </ul>
         
        </div>
        <div class="col-md-4 order-md-2 mb-5" >
            <h4 class="mb-3" style="margin-bottom: 100px;" >Checkout with Paypal</h4> 
            <p class="mb-3 text-muted fst-italic" style="margin-bottom: 100px;"> Card | Bank</p>
            
            <div id="paypal-payment-button"></div>
        </div>
    </div>
    <?php else:?>
        <div class="text-center">
            <h5 class="text-danger" style="margin:100px 0px;">Shame! Add books to cart before checkout</h5>
            
        </div>
    <?php endif;?>
 
</div>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AeUfBeYkYS_nH4-K4XWhfSMvbEKoOdmWSQ6_fh0Ml0Ya0s8sW-lhAthUA9z0K1V_TGtZNdxJedCMNxG_&disable-funding=credit,card"></script> -->
<script src="https://www.paypal.com/sdk/js?client-id=AUJrv_n9DmsOQzciAmGHafqTpurxzsmCN_ziHD5xc5OzNjfUnkCiU0aiqy2LItimZn9Fq5SBJo4Jpfp_&disable-funding=credit,card"></script>
<!-- <script>paypal.Buttons().render('#paypal-payment-button');</script> -->


<script>



//Get total amount to be paid
var total=0;
let amount  = document.querySelector("#amount").value.trim();
// alert(amount);

if(amount != "" && !isNaN(amount)){
    total = amount;
    console.log("Total = ",total);
}

//Payapl Button Starts here ==================

txn_details = {};
paypal.Buttons({
    style : {
        color: 'gold',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: total
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            //if successful transaction
            
            
            console.log("details")
            const isObject = function(val){
                if(val === null){
                    return false
                }
                    return (typeof val==='object')
                            
            }

            const getObjProps = function(obj){

                for(let prop in obj){
                    alert(prop)
                    if(isObject(obj[prop])){
                    getObjProps(obj[prop])
                    }else{
                        // console.log(prop,obj[prop])
                        // txn_details[`${prop}`] = `${obj[prop]}`
                        txn_details[prop] = obj[prop]
                     

                    }
                    
                };//forloop end

            };//function getObjProps end

            getObjProps(details)
            console.log("Transaction details details")
            console.log(typeof txn_details)
            console.log(txn_details)
            send_data(txn_details)


            
            
            if(details !=null){ //clear after checkout success
                <?php unset($_SESSION['CART']); ?>
            }
           
            window.location.replace("<?=ROOT?>success")
            
        })
        
    },
    onCancel: function (data) {
        window.location.replace("<?=ROOT?>failed")
    }
}).render('#paypal-payment-button');

// Paypal button ends here   -==========

function send_data(tdetails){
    console.log("==========Below this line===========")
    for (const [key, value] of Object.entries(tdetails)) {
        console.log(`${key}: ${value}`);
}
}






 /*
 
full_name: Regina Lou
given_name: Regina
surname: Lou
payer_id: JW99MTEPFWFWE
email_address: regina@personal.example.com
address_line_1: 1 Cheeseman Ave Brighton East
admin_area_2: Melbourne
admin_area_1: Victoria
postal_code: 3001
country_code: AU


id: 8DJ612347V537194G
currency_code: USD


final_capture: true
create_time: 2021-10-08T10:39:08Z
update_time: 2021-10-08T10:39:28Z


merchant_id: AKE947Q3R5K86


intent: CAPTURE
status: ELIGIBLE
reference_id: default




href: https://api.sandbox.paypal.com/v2/checkout/orders/77V66843JG373713B
rel: self
method: GET


 */


</script>


<!-- checkout ends here -->

<?php  
//    $this->view("zac/footer",$data); 
 include "footer.php";
   
   ?>