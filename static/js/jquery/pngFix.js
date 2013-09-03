(function($) {
jQuery.fn.pngFix = function(settings) {
	settings = jQuery.extend({blankgif: 'blank.gif'}, settings);
	if (jQuery.browser.msie && (jQuery.browser.version == '5.5' || jQuery.browser.version == '6.0')) {
		jQuery(this).find("img").each(function(){
			if ($(this).attr('src').match(/.*\.png([?].*)?$/i)) {
        var obj = jQuery(this);
				var prevStyle = '';
				var imgId = (jQuery(this).attr('id')) ? 'id="' + jQuery(this).attr('id') + '" ' : '';
				var imgAlign = (jQuery(this).attr('align')) ? 'align="' + jQuery(this).attr('align') + '" ' : '';
        var imgStyle = (jQuery(this).parent().attr('style')) ? jQuery(this).parent().attr('style') : '';
        var strNewHTML = '';
        strNewHTML += '<img '+imgId+imgAlign;
        strNewHTML += 'class="' + jQuery(this).attr('class') + '" ';
        strNewHTML += 'title="' + jQuery(this).attr('title') + '" ';
        strNewHTML += 'alt="' + jQuery(this).attr('alt') + '" ';
        strNewHTML += 'src="'+settings.blankgif+'"';
				strNewHTML += 'style="';
				strNewHTML += 'width:' + obj.width() + 'px;' + 'height:' + obj.height() + 'px;';
				strNewHTML += 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + obj.attr('src') + '\', sizingMethod=\'scale\');';
				strNewHTML += imgStyle;
        strNewHTML += '"/>';
				obj.hide();
				obj.after(strNewHTML);
			}
		});
		jQuery(this).find("*").each(function(){
			var bgIMG = jQuery(this).css('background-image');
			if(bgIMG.indexOf(".png")!=-1){
				var iebg = bgIMG.split('url("')[1].split('")')[0];
				jQuery(this).css('background-image', 'none');
				jQuery(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "',sizingMethod='scale')";
			}
		});
		jQuery(this).find("input").each(function(){
			if ($(this).attr('src').match(/.*\.png([?].*)?$/i)) {
				var bgIMG = jQuery(this).attr('src');
				jQuery(this).get(0).runtimeStyle.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + bgIMG + '\', sizingMethod=\'scale\');';
				jQuery(this).attr('src', settings.blankgif);
			}
		});
	}
	return jQuery;
};
})(jQuery);