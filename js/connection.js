$( document ).ready(function() {
  $("#myModal").modal();
  $("#login").validate({
	  rules: {
	    id: {required: true},
	    mp: {required: true},
	    rblogin: {required: true}
	  },
	  messages: {
	    id: {
		      required: "Vous devez saisir un identifiant valide !"
		    },
	    mp: {
	      required: "Vous devez saisir un mot de passe valide"
	    },
	    rblogin: {
		      required: "Vous devez choisir une option"
		    }
	  }
});
});
$("#login").submit(function( e ){
	e.preventDefault();
	alert("submit");
});
