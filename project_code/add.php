	
<?php
function imageCR($isbn){
	
$my_img = imagecreate( 200, 200 );
$background = imagecolorallocate( $my_img, 0, 0, 0 );
$text_colour = imagecolorallocate( $my_img, 255, 255, 200 );
$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
imagestring( $my_img, 5, 25, 85, "$isbn", $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 15, 110, 185, 110, $line_colour );
imagejpeg($my_img, "image/$isbn.jpg");
imagedestroy( $my_img );	

}

include("config.php");
if(isset($_POST['isbn']) && isset($_POST['name']) && isset($_POST['author']) && isset($_POST['publ'])){
	$isbn=$_POST['isbn'];
	$name=strtoupper($_POST['name']);
	$author=strtoupper($_POST['author']);
	$publ=strtoupper($_POST['publ']);
	$price=$_POST['price'];
	$query="SELECT isbn from book where isbn='$isbn'";
	$res= mysqli_query($con, $query);
	if(mysqli_fetch_row($res)>0)
	echo "<script>alert('What are you doing!! \n\n Book already there in store.');</script>";
	else {
	$query= "INSERT INTO book (isbn, name,author, publisher, price) VALUES('$isbn','$name','$author','$publ', $price)";
		mysqli_query($con, $query);
		if(!isset($_POST['img']))
			imageCR($isbn);
	echo "<script>alert('$name added successfully.');</script>";
	}	
}
mysqli_close($con);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add Products</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
</head>

<body>

	<section id="form"><!--form-->
		<div class="container">
		 <a><h1 align='center'>Add Product</h1></br></a>
			<div class="row">				
				<div class="col-sm-12">
					<div class="signup-form"><!--sign up form-->
						<form action="" method="POST">
							<input type="text" placeholder="Name of Product*" name="name" required />
							<input type="number" placeholder="ISBN*" name="isbn" required />
							<input type="text" placeholder="Author*" name="author" required />
							<input type="text" placeholder="Publisher*" name="publ" required />
							<input type="number" placeholder="Price*" name="price" required />
							<input type="file" name="img" />
							<button type="submit" class="btn btn-blue">Add</button>
						</form>
				</br> <a>*-MANDATORY!!</a>
					</div><!--/sign up form-->
					
				</div>
			</div>
		</div>
	</section>
	</body>