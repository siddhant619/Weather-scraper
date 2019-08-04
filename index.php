<!doctype html>

<?php
	error_reporting(E_ERROR);
	$error="";
	if(isset($_GET["mycity"]))
	{
		$cityinput=str_replace(' ','',$_GET["mycity"]);
//		echo $_GET["mycity"];
		$page=file_get_contents("https://www.weather-forecast.com/locations/".$cityinput."/forecasts/latest");
		
		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$cityinput."/forecasts/latest");
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
			$error="City not found";
		}
		else{
			
		$pagesummary=explode('</h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $page);
	//	echo $pagesummary[1];
		$secondpage= explode('</span></p></td>',$pagesummary[1]);
		$weather= $secondpage[0];
		}
	}
	?>

 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Scraper</title>
	<style type="text/CSS">
	html { 
			background: url(back2.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			}
	body{
		background:none;
		
	}
	.container{
		text-align:center;
		color:white;
		margin-top:200px;
		width:500px;
	}
	#result{
		color:white;
		margin:15px;
	}
	
	
	
	</style>
  </head>
  <body>
	<div class="container">
		<h1>What's the weather</h1>
	<form>
  <div class="form-group">
    <label for="city">Enter the city</label>
    <input type="text"  id="city"  class="form-control" placeholder="Eg. Delhi, Kolkata" name="mycity"  value="<?php echo $_GET["mycity"]; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
	<div id="result"> 
		<?php
				if(isset($weather))
				{
					echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
				
				}
				else{
					echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					
				}
			?>
	</div>
</div>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
