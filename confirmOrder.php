<?php 
include 'inc/header.php';

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    header('location:shop.php');
    exit();
}


if(isset($_POST['confirmOrder'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalCode = $_POST['postal_code'];
    $phone  = $_POST['phone'];
    $paymentType  = $_POST['payment_type'];


    $errors = []; 
    if(empty($name) || empty($email) || empty($address) || empty($city) || empty($postalCode)){
        $errors[] = 'all fields are required';
    }
    

    if(empty($errors)){
        // create order

        $total= 0 ; 
        foreach($_SESSION['cart'] as $item){
            $total += $item['price'] * $item['cart_quantity'];
        }
        $order = [
            'customer' => [
                'name' => $name , 
                'email' => $email, 
                'address' => $address, 
                'city' => $city , 
                'phone' => $phone , 
                'postal_code' => $postalCode , 
                'payment_type'=> $paymentType
            ] , 
            'products' => $_SESSION['cart'] ,
            'total' => $total ,
        ];

        if(!isset($_SESSION['order'])){
            $_SESSION['order'] = [];
        }

        $_SESSION['order'] = $order ; 
        unset($_SESSION['cart']); 

        $_SESSION['success'] = ['order created successfully'];
        header('location:shop.php');
        exit();
        
    }
}
?>


<section id="cart-add" class="section-p1">
    <form>
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" name="coupon" placeholder="Enter coupon code">
            <button class="normal" type="submit" >Apply</button>
        </div>
        </form>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <form action="" method="post"  class=" col-4">
                name<input name="name" type="text" >
               email <input name="email" type="email" >
                address<input name="address" type="text" >
                city<input name="city" type="text" >
                postalCode<input name="postal_code" type="number" >
                phone<input name="phone" type="text">
                paymentType<select  name="payment_type">
                <option value="Cash_on_Delivery">Cash on Delivery</option>
                    <option value="Credit_Card">Credit Card</option>
                    <option value="Fawry">Fawry</option>
                </select>
                <button name="confirmOrder" class="normal" type="submit" >proceed to checkout</button>
            </form>
           
        </div>
    </section>

<?php 

include 'inc/footer.php';
?>

