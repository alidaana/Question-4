
<?php

// ALI DAANA
// NOTE: There is a more optimal solution for this problem where the only 2 boxes can be used by adding the product of the last box to the first box 

    // array containing fake data
    $order = array(
        ['id'=>'40','qty'=>1,'vol'=>12000],
        ['id'=>'33','qty'=>4,'vol'=>2500],
        ['id'=>'35','qty'=>3,'vol'=>1500],
        ['id'=>'41','qty'=>1,'vol'=>1500],
        ['id'=>'34','qty'=>3,'vol'=>500],
        ['id'=>'45','qty'=>1,'vol'=>500]
    );

    // temporary array to hold the solution
    $temp = array();
    // start with vallue of box at 1
    $box = 1;
    $boxVol = 0; // variable for how much volume taken in the box
    $addQty = 0; // variable for how many of the same product id we add in the box

    // Loop through the array $order
    foreach ($order as $product){
        // we must set the quantity to 0 for each box we go though
        $addQty = 0;
        // and get the product quantity
        $qty = $product['qty'];
        // loop while the quantity of the product selected is greater than 0
        while($qty>0){
            // check if the product fits in the box 
            if($product['vol'] + $boxVol <= 15000 ){
                $addQty ++;
                $boxVol=$product['vol'] + $boxVol;
                $qty--;
            }
            // check if the product selected fits
            else if($product['vol'] + $boxVol > 15000){
                // check if the added quantity is 0 and reset box values
                if($addQty == 0){
                    $box = $box+1;
                    $boxVol = 0;
                    $addQty = 0;
                }
                else{ // else insert item to the box and creat a new box 
                    $temp[] = ['id' => $product['id'],'qty'=>$addQty,'box'=>$box];
                    $box = $box+1;
                    $boxVol = 0;
                    $addQty = 0;
                }

            }
            // check if there is no more of the product chosen
            if($qty == 0 ){
                // insert the product with how much products to insert
                $temp[] = ['id' => $product['id'],'qty'=>$addQty,'box'=>$box];
            }

        }

    }

    // printing results
    $boxnum = 'a';

    foreach($temp as $product){
        if($product['box'] == $boxnum)
        {
            print("\n  *    ".$product['id']."        *  ".$product['qty']."         *");
            print("\n  *****************************");
        }
        else{
            print("\n\n -------------------------------------------------");
            print("\n\n BOX# ".$product['box'].":");
            print("\n\n  *  ".'Product id'."  *  "."Quantity"."  *");
            print("\n  *****************************");
            print("\n  *    ".$product['id']."        *  ".$product['qty']."         *");
            print("\n  *****************************");
            $boxnum = $product['box'];
        }
    }
    print("\n\n ------------------------------------------------- \n\n");


?>