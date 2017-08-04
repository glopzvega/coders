$.getJSON("views/mensajeService.php?mensajes", function(res){
	console.log(res);
	if(res.success)
	{
		var opts = "";
		$.each(res.data, function(index, elem){
			opts += "<li>";
			opts += "<a>";
			opts += "<b>" + elem.idusuario.username + "</b>"
			opts += "<br>" + elem.mensaje 
			opts += "</a>";
			opts += "</li>";
		});

		$("#ddMensajes").html(opts);
	}
});

$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrainWidth: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'left', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    }
  );