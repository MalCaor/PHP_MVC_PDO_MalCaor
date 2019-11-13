$( document ).ready(function() {
$("#myModal").modal();
});
$("#login").submit(function( e ){
	e.preventDefault();
	alert("submit");
});
