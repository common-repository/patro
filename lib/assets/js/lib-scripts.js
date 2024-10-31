(function ( $ ) {
	$(function () {
		$("#lib-expand-access button").click(function () {
			$("#lib-confirmation-block").slideToggle("slow", function () {
				// Animation complete.
			});
		});
	})


})(jQuery);
