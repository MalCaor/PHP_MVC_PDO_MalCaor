$( document ).ready(function() {
  $("#myModal").modal();
  $("#login").validate({
	  rules: {
	    id: {required: true, minlength: 2},
	    mp: {required: true, minlength: 2},
	    rblogin: {required: true}
	  },
	  messages: {
	    id: {
		      required: "Vous devez saisir un identifiant valide !",
          minlength: "Pas asser long long long..."
		    },
	    mp: {
	      required: "Vous devez saisir un mot de passe valide !",
        minlength: "Pas asser long long long..."
	    },
	    rblogin: {
		      required: "Vous devez choisir une option !"
		    }
	  }
  });
  $("#login").submit(function( e ){
    e.preventDefault();
    if($("#login").valid()){
      alert("ok");
    }
    else {
      alert("non");
    }
  });
});
