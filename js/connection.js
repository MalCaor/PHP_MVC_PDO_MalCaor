$( document ).ready(function() {
  $("#myModal").modal();
  $("#login").validate({
    errorPlacement: function (error, element) {
        if (error[0].innerHTML != null && error[0].innerHTML !== "") {
            $(element).tooltipster('content', $(error).text());
            $(element).tooltipster('open'); //open only if the error message is not blank. By default jquery-validate will return a label with no actual text in it so we have to check the innerHTML.
        }
    },
    success: function (label, element) {
        var obj = $(element);
        if (obj.hasClass('tooltipstered') && obj.hasClass('error')) {
            $(element).tooltipster('close'); //hide no longer works in v4, must use close
        }
    },
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
  $("#login :input").tooltipster({
    trigger: "custom",
    animation: 'grow',
    theme: 'tooltipster-xxxxxxx',
    onlyOne: false,
    position: 'bottom',
    multiple:true,
    autoClose:false
    });
  $("#login").submit(function( e ){
    e.preventDefault();
    if($("#login").valid()){
      alert("ok");
    }
    else {
      
    }
  });
});
function hd(){
  console.log("coucou");
$("#myModal").modal("hide");
	 var instances = $.tooltipster.instances();
	 $.each(instances, function(i, instance){
	     instance.close();
	 });
}
