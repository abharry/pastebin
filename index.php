<!doctype html>
<html lang='en'>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
-->
</head>
<body class="container">
<div class="row">
	<div class="col-md-12">
	<h4 class="text-primary text-center">You can save anything for later using this scrap board.</h4>
	</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
<article ng-app=''>
<section>
	<form>
	<div class="form-group">
	<label for="pastebin-id">Open this pastebin</label> 
	<input type='text' id="pastebin-id" class="form-control" required>
	</div>
	<button class="btn btn-primary" id="load-it">Load</button>
	</form>
</section><br/>
<section>
	<form>
		<div class="form-group">
		<label for="content">Content</label>
		<textarea id='content' placeholder='Scrap-pad here!' class="form-control" required></textarea>
		</div>
		<div class="form-group">
		<label for="content-id">Name this pastebin</label>
		<input type='text' id='content-id' class="form-control">
		</div>
		<button id="save-it" class="btn btn-primary">Save it!</button>
	</form>
</section>
</article>
</div>
</div>
<div class="row">
<div class="col-md-12">
	<h5 class='text-primary text-right'>Developed by - <a href="mailto:dcotre.1760@outlook.com">harry</a></h5>
</div>
</div>
<script>
$url_save = "save_pastebin.php";
$url_open = "open_pastebin.php";
$(document).ready(
	function(){
		$("#load-it").on('click',function(){
			
			if( $("#pastebin-id").val() ){
				var binid = $("#pastebin-id").val();
				$.getJSON($url_open,{"binid":binid}, function(data){
					
					if(data.status){
						$("#load-it").removeClass("btn-primary");
						$("#load-it").addClass("btn-success");
						$("#load-it").text("Loaded!");
						$("#content").val(data.content);
						$("#content-id").val(binid);
						setTimeout(function(){
							$("#load-it").removeClass("btn-success");
							$("#load-it").addClass("btn-primary");
							$("#load-it").text('load another!');
						}, 3000);
					}
					else{
						$("#load-it").removeClass("btn-primary");
						$("#load-it").addClass("btn-danger");
						$("#load-it").text("pastebin empty!");
						setTimeout(function(){
							$("#load-it").removeClass("btn-danger");
							$("#load-it").addClass("btn-primary");
							$("#load-it").text('load another!');
						}, 3000);
					}
				
				});
			}
		});
		$("#save-it").on('click',function(){

			if( $("#content").val() && $("#content-id").val() ){
				
				var $content = $("#content").val();
				var $content_id = $("#content-id").val();
				
				$.getJSON($url_save,{'content':$content, 'content_id':$content_id},function(data){
					console.log("data is : "+data);
					if(data.status){
						$("#save-it").removeClass("btn-primary");
						$("#save-it").addClass("btn-success");
						$("#save-it").text("Saved-it");
						setTimeout(function(){
							$("#save-it").removeClass("btn-success");
							$("#save-it").addClass("btn-primary");
							$("#save-it").text("Save-another!");
						},3000);
					}
					else{
						$("#save-it").removeClass("btn-primary");
						$("#save-it").addClass("btn-danger");
						$("#save-it").text("Couldn't save it!");
						setTimeout(function(){
							$("#save-it").removeClass("btn-danger");
							$("#save-it").addClass("btn-primary");
							$("#save-it").text("Try Again!");
						}, 3000);
					}
				});
				
			}

		});
	}
);
</script>
</body>
</html>
