<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>Random Quote Generator</title>
</head>
<body>
<style>
 html{position:relative;min-height: 100%;}
 body{margin-bottom: 60px;}
.content {
  min-height: 340px;
  margin: 20px auto;
  padding: 20px;
  border-radius: 10px;
}
button{margin:40px;}
.quote-content {
  padding: auto;
  margin-top: 80px;
  margin-bottom: 30px;
}
.quote-author{color: white;}
.hidden{display: none;}
.copyright {
  position: absolute;
  bottom: 0;
  padding-top: 15px;
  padding-bottom: 15px;
  width: 100%;
  text-align: center;
  font-size: 0.8em;
  background-color: #000;
  color: white;
}
.dcmf-logo{height: 25px;}
</style>

<script src="https://use.fontawesome.com/0132e45b76.js"></script>
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 content">
        <h1 class="text-center">Sometimes everybody needs a quote...</h1>
        <h2 class="text-center">Well, this site is for you!<h2>
        <div class="col-lg-1 offset-lg-6">
          <button class="btn btn-lg btn-danger" id ="getQuote">Gimme a piece of quote!</button>
        </div>
       <div class="quote-content">
         <blockquote class="blockquote">
           <h3 class="quote-body"></h3>
           <footer class="blockquote-footer">
             <cite class="quote-author"></cite>
         </footer>
         </blockqoute>
      </div>
          <div class="text-right">
          <a href="" class="btn btn-primary btn-lg btn-social btn-twitter " id="tweet-this">Like it? Tweet it! <span class="fa fa-twitter"></span></a>
          </div>
    </div>
  </div>
</section>



<script>
var url= "http://api.forismatic.com/api/1.0/?method=getQuote&key=345421&format=jsonp&lang=en&jsonp=?";
var randomColor, invRandomColor;
var setQuote = function(){
  randomColor = Math.floor(Math.random()*255**3);
  invRandomColor = randomColor+100000;
  $('body').css('background-color', '#'+randomColor.toString(16));
  $('body').css('color', '#'+invRandomColor.toString(16));
  if (randomColor < 255**3/2) {
    $('.quote-author').css('color', 'white');
  } else {
    $('.quote-author').css('color', 'black');
  };
  $.ajax({
    url: url,
    method: "get",
    dataType: "jsonp",
    error: function(){
      $(".quote-body").text("Something went wrong");
    },
    success: function(json){
      $(".quote-body").text(json.quoteText);
      $(".quote-author").text(json.quoteAuthor);
      if (json.quoteAuthor === ''){
        $('.quote-author').addClass('hidden');
      } else {
        $('.quote-author').removeClass('hidden');
      }
      var htmlJSON = encodeURI(json.quoteText);
      $("#tweet-this").attr('href', "https://twitter.com/intent/tweet?text="+htmlJSON+"&source=clicktotweet&related=clicktotweet").attr('target', '_blank');

    }
  });
};

$(document).ready(function(){
  $('body').ready(setQuote);
  $("#getQuote").on('click', setQuote);
});
</script>
<footer class="copyright">Written and coded by <a href="https://www.dcmf.hu"><img class="dcmf-logo" src="dcmf-letters.png" alt="David's Code ManuFactory logo"/></a></footer>

</body>
</html>
