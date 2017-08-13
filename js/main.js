$.getJSON("views/mensajeService.php?mensajes", function(res){
	console.log(res);
	if(res.success)
	{
		var opts = "";
		$.each(res.data, function(index, elem){
			opts += "<li>";
			opts += "<a class='notificacion' idnotificacion='"+elem.idnotificacion+"'>";
			opts += "<b>" + elem.idusuario.username + "</b>"
			opts += "<br>" + elem.mensaje 
			opts += "<i class='material-icons right leer'>check</i>"
			opts += "</a>";
			opts += "</li>";
		});

		$("#ddMensajes").html(opts).find(".leer").on("click", function(){
			var notificacion = $(this).parents(".notificacion");
			var idnotificacion = notificacion.attr("idnotificacion");

			$.getJSON("views/mensajeService.php?leido", {id : idnotificacion}, function(res){
				console.log(res);
				notificacion.parent().remove();
			});
		});
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