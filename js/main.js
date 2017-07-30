$.getJSON("views/mensajeService.php?mensajes", function(res){
	console.log(res);
	if(res.success)
	{
		var opts = "";
		$.each(res.data, function(index, elem){
			opts += "<li>";
			opts += "<a>" + elem.mensaje + "</a>";
			opts += "</li>";
		});

		$("#ddMensajes").html(opts);
	}
});