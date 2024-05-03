<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> order information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>    
     <?php
error_reporting(0);//للتخلص من الاخطاء الغير ضرورية 
?>
    <div class="product-details">
        <h1>order information</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") //هنا نتاكد من مدخلات موجودة او لا
            $name = $_POST['id'];//من صفحة انديكس استدعينا اسم المنتج
            $price = $_POST['price'];// من صفحة انديكس استدعينا سعر المنتج
        ?>
        <div class="product-info">
            <h2>product name : <?php echo $name; ?></h2> 
            <p>price: $<?php echo $price; ?></p>

            <form action="product.php" method="GET">
                <input type="hidden" name="id" value="<?php echo $name; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="text" name="address" placeholder="العنوان">
                <input type="text" name="phone" placeholder="الرقم">
                <input type="submit" id="sub2" value="تسجيل الطلب">
            </form>
        </div>
        
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $name = $_GET['id'];
            $price = $_GET['price'];
            $address = $_GET['address'];
            $phone = $_GET['phone'];
            //خزنا المدخلات بمتغيرات حتة نخزنهن بالداتا بيس
        
        
            $conn = new mysqli('localhost', 'root', '', 'info');///info/اتصلنا بالداتا بيس الاسمها 
        
            if ($conn->connect_error) {
                die("err" . $conn->connect_error); //اذا صار خطا بالاتصال يضهر ايرر
            }
        
            $sql = "INSERT INTO orders (name, price, addres, phone) VALUES ('$name', '$price', '$address', '$phone')";//دخلنا المتغيرات البيهن معلومات المشتري والسعر واسم المنتج بالداتا بيس
        
            if ($conn->query($sql) === TRUE) {
                echo "تم تسجيل الطلب بنجاح!"; //اذا دخلن بنجاح بالداتا بيس يطبع تم تسجيل الطلب واذا صارت مشكلة يطبع خطا
            } else {
                echo "err: " . $sql . "<br>" . $conn->error;
            }
        
            $conn->close();//اغلق الاتصال بالداتا بيس
           
        }
        ?>
   
        
    </div>
</body>
</html>