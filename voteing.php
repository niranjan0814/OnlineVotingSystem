<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contestants Page</title>
  <!-- Link to your custom CSS file -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
   
<header>
  <nav>
    <button id="home-btn">Home</button>
    <button id="contestants-btn">Contestants</button>
    <div id="timer"></div>     
  </nav>
</header>

<main>
  <section class="contestant-section">
    <div class="head"><p>Vote Your Favorite Contestant</p></div>
    <form method="POST" action="vote1.php"> 
    <div class="contestants">
      <div class="contestant">
        <img src="ryan.png" alt="Person 1" class="person-img">
        <p class="contestant-name">Contestant 1</p>
        <input type="number" min="0" max="5" title="Please enter a value between 1 and 5" name="c1" id="h11">
      </div>
      <div class="contestant">
        <img src="DRSTR.jpg" alt="Person 2" class="person-img">
        <p class="contestant-name">Contestant 2</p>
        <input type="number" min="0" max="5" title="Please enter a value between 1 and 5" name="c2"  id="h12">
      </div>
      <div class="contestant">
        <img src="dicap.png" alt="Person 3" class="person-img">
        <p class="contestant-name">Contestant 3</p>
        <input type="number" min="0" max="5" title="Please enter a value between 1 and 5" name="c3" id="h13">
      </div>
      <div class="contestant">
        <img src="toms.png" alt="Person 4" class="person-img">
        <p class="contestant-name">Contestant 4</p>
        <input type="number" min="0" max="5" title="Please enter a value between 1 and 5" name="c4" id="h14">
      </div>
      <div class="contestant">
        <img src="david.png" alt="Person 5" class="person-img">
        <p class="contestant-name">Contestant 5</p>
        <input type="number" min="0" max="5" title="Please enter a value between 1 and 5" name="c5" id="h15">
        
      </div>
    </div>
    <div class="feedback">
      <h2 id="feedbacks">Feedback</h2>
      <textarea id="feedback-text" placeholder="Leave your feedback here"></textarea>
      <br>
      <button type="submit" id="submit-feedback-btn" onclick="alert_final()" name="submit" onclick="save()">Submit</button>
    </div>
    
    </form>
</div>
</section>

<?php 
require 'config.php';
if(isset($_POST["submit"])) {
    if (!empty($_POST["c1"]) && !empty($_POST["c2"]) && !empty($_POST["c3"]) && !empty($_POST["c4"]) && !empty($_POST["c5"])) {
        $c1 = $_POST["c1"];
        $c2 = $_POST["c2"];
        $c3 = $_POST["c3"];
        $c4 = $_POST["c4"];
        $c5 = $_POST["c5"];

        $sql = "INSERT INTO vote (`name`, count) VALUES 
        ('ryan', '$c1'),
        ('drstr', '$c2'),
        ('dicap', '$c3'),
        ('toms', '$c4'),
        ('david', '$c5')";

        if ($conn->query($sql)) {
            echo "Votes submitted successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please provide votes for all contestants.";
    }
}
?>

<section class="results-section">
  <h2>Results</h2>
  <table id="tableT">
    <tr>
      <th>Name</th>
      <th>Vote</th>
    </tr>
    
  </table>
</section>

</main>

<script>
  // Set the date we're counting down to
  var countDownDate = new Date("Apr 30, 2024 00:00:00").getTime();

  // Update the countdown every 1 second
  var x = setInterval(function() {

    // Get the current date and time
    var now = new Date().getTime();

    // Calculate the distance between now and the countdown date
    var distance = countDownDate - now;

    // Calculate days, hours, minutes, and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the countdown
    document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
      minutes + "m " + seconds + "s ";

    // If the countdown is over, display a message
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("timer").innerHTML = "EXPIRED";
    }
  }, 1000);

  function alert_final() {
    alert("Thanks for your feedback. Your feedback will help improve our services.");
  }
</script>
<script>
 
  var h11 = document.getElementById("h11");
  var h12 = document.getElementById("h12");
  var h13 = document.getElementById("h13");
  var h14 = document.getElementById("h14");
  var h15 = document.getElementById("h15");
  var tableT = document.getElementById("tableT");
  var submit = document.getElementById("submit-feedback-btn");
  submit.addEventListener("click",function(event){
    event.preventDefault();
  text="<tr>";
  text+="<td>Contestant 1</td>";
  text+="<td>"+h11.value+"</td>";
  text+="</tr>";
  text+="<td>Contestant 2</td>";
  text+="<td>"+h12.value+"</td>";
  text+="</tr>";
  text+="<td>Contestant 3</td>";
  text+="<td>"+h13.value+"</td>";
  text+="</tr>";
  text+="<td>Contestant 4</td>";
  text+="<td>"+h14.value+"</td>";
  text+="</tr>";
  text+="<td>Contestant 5</td>";
  text+="<td>"+h15.value+"</td>";
  text+="</tr>";
  text+="</tr>";
  tableT.innerHTML+=text;
  });
  

</script>
</body>
</html>
