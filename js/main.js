$(document).ready(function () {
    $('.toggleProducts').on('click', function (oEvent) {
        oEvent.preventDefault();

        var iProductId = $(this).attr('id');
        $('.oldOrders tr[data-product="' + iProductId + '"]').each(function () {
            $(this).fadeToggle('slow');
        });
    })
});

$(document).ready(function(){

	$('div.stars').raty({ 
		path: "raty-2.7.0/lib/images",
		scoreName : "stars"
	});

	$('.starscom').raty({
		readOnly: true,
		score: function()
		{
			return $(this).attr("data-score")
		},
		path: "raty-2.7.0/lib/images",
	});

});