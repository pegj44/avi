// avi options scripts

jQuery(document).ready(function() {
	


	jQuery('.icon-line-cross, .opt-modal-x').click(function() {
		jQuery('.field-desc-modal').hide();
	});

	jQuery('td .field-modal').click(function() {
		var modal = jQuery(this).attr('id'),
			value = jQuery(this).val();

		jQuery('.mitem').removeClass('selected');			
		jQuery('[data-value="'+ value +'"].mitem').addClass('selected');
		jQuery('#'+modal).show();
	});

	jQuery('.mitem').click(function() {
		jQuery('.mitem').removeClass('selected');
		jQuery(this).addClass('selected');
	});

	jQuery('.opt-modal-y').click(function() {
		
		var modal = jQuery(this).parent().parent(),
			modId = modal.attr('id'),
			item  = modal.find('.mitem.selected'),
			itmID = item.data('value'),
			input = jQuery('input#'+modId),
			desc  = jQuery('[data-mod='+ modId+']'),
			itmVal = item[0].outerHTML,
			color = jQuery('input[data-id="'+ modId +'-color"]').val();

		input.val(itmID);		
		desc.html(itmVal);
		avi_soc_color(modId, color);
		jQuery('textarea#'+modId+'-prev-textarea').val(itmVal);
		modal.hide();
	});

	jQuery.each( jQuery('input.colorprev'), function(event) {

		var obj = jQuery(this),
			pID = obj.data('id').replace('-color', '');

		avi_soc_color(pID, obj.val());

	    obj.iris({
	    	palettes: true,	    	
	        change: function(event, ui) {
	        	var color = ui.color.toString(),
	        		input = obj.parent().parent().find('.wp-color-result');    

	        	input.css('background-color', color);
	        	avi_soc_color(pID, color);
	        },
	    });

	});

});

function avi_soc_color(pID, color) {

	var id = '[data-mod="'+ pID +'"].selecprev';

	jQuery(id +' #style1 span, '+ id +' #style4 span').css({'border-color' : color,'color' : color});
	jQuery(id +' #style2 span, '+ id +' #style5 span').css({'border-color' : color,'background' : color});	
	jQuery(id +' #style3 span, '+ id +' #style6 span, '+ id +' #style7 span').css({'color' : color});
}