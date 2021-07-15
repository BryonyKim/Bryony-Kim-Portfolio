<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta name="description" content="Example project using Google Maps APIs. Calculate the driving distance between two cities.">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      
    <link href="styling.css" rel="stylesheet">

    <title>Distance Between Cities</title>
      
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&display=swap" rel="stylesheet"> 
  
  </head>
    
  <body>
      
      <div class="container-fluid">
            <div class="heading">
                <h1 class="heading-title">Distances</h1>
                <h4 class="sub-heading">Calculate the driving distance between two cities using the boxes below</h4>
            </div>
          
            <div class="inputs">
                <input class="origin boxes" id="origin" placeholder="Starting point" type="text">
                <input class="destination boxes" id="destination" placeholder="Destination" type="text">
                <button class="submit btn btn-dark boxes" onclick="showRoute();">Show Route</button>
                
            </div>
          
            <div class="row mt-4">
                <div class="map col-md-5 mx-auto" id="map"  style="height: 400px;">
                </div>

                <div class="directions col-md-5 mx-auto" id="directions">
                </div>
            </div>
          
            <div class="footer">
                <div class="row">
                    <div class="col">
                        <p>Developed by: <a href="https://bryonykimwebdev.com/">Bryony Kim Web Dev</a></p>
                    </div>
                
                </div>
            </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      
    <!-- map -->
    
    
    <script src="javascript.js"></script>
  
    </body>
</html>