<?php
/*
Plugin Name: Yahoo Auto Tags
Plugin URI: http://realhomeincomes.com
Description: Get the the best keywords and adds to tag input box. Then you can add/edit or delete tags accordingly. For more information go to <a href='http://realhomeincomes.com'>Realhomeincomes.com</a>
Version: 1.0
Author: Matt
Author URI: http://realhomeincomes.com
*/

class yahoo_autotag
{
	#
	# init()
	#

	function init()
	{
		//do_meta_box();
		add_action('edit_form_advanced', array('yahoo_autotag', 'tag_button'), -10);
		//add_action('save_post', array('autotag', 'save_entry'));
	} 

	function tag_button()
	{
		?>
        <script>
		var xmlHttp
		
		//alert(document.getElementById('content').value);

			function show_help()
			{
				document.getElementById("tag_holder").innerHTML = "Godaddy and Godaddy reseller sites like <a href='http//opendls.com'>Opendls.com</a> use Proxy servers. You must check the box to activate the routing to the proxies. If you do not use Godaddy hosting, please do nto check as it will make the autotagger not work.";
			}
			
			function call_yahoo()
			{ 
			
				
				document.getElementById("tag_holder").innerHTML = "<img src='<?php bloginfo('wpurl'); ?>/wp-content/plugins/yahoo-autotag/ani.gif' />"
				var content
				//if(tinyMCE.getContent()==null)
				content = document.getElementById('content').value
				//else
				//content = tinyMCE.getContent();
				
				
				var url="<?php bloginfo('wpurl'); ?>/wp-content/plugins/yahoo-autotag/yahoo_call.php";
				
				xmlHttp=GetXmlHttpObject(stateChanged)
				xmlHttp.open("Post", url)
				xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
				var gd;
				if(document.getElementById('godaddy').checked)
				gd = 1;
				else
				gd = 0;
				xmlHttp.send("godaddy="+gd+"&appid=yahooautotagger&context=" + content)
				
				}
			
			
			
			function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				document.getElementById("newtag").value=xmlHttp.responseText 
				//alert(xmlHttp.responseText);
				document.getElementById("tag_holder").innerHTML = "<font color='blue'>Done, Now check your tag input box...It should be filled with tags</font>";
				} 
			} 

			function GetXmlHttpObject(handler)
			{ 
				var objXmlHttp=null
				
				if (navigator.userAgent.indexOf("Opera")>=0)
				{
				alert("This example doesn't work in Opera") 
				return 
				}
				if (navigator.userAgent.indexOf("MSIE")>=0)
				{ 
				var strName="Msxml2.XMLHTTP"
				if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
				{
				strName="Microsoft.XMLHTTP"
				} 
				try
				{ 
				objXmlHttp=new ActiveXObject(strName)
				objXmlHttp.onreadystatechange=handler 
				return objXmlHttp
				} 
				catch(e)
				{ 
				alert("Error. Scripting for ActiveX might be disabled") 
				return 
				} 
				} 
				if (navigator.userAgent.indexOf("Mozilla")>=0)
				{
				objXmlHttp=new XMLHttpRequest()
				objXmlHttp.onload=handler
				objXmlHttp.onerror=handler 
				return objXmlHttp
				}
			} 
			
		function add_tag(tag)
			{
				if(document.getElementById('tags-input').value == '')
				document.getElementById('tags-input').value = tag;
				else
				document.getElementById('tags-input').value += ", " + tag;
			}	
		</script>
        <div style="border-top:1px solid #86C413; border-bottom:1px solid #86C413; background-color:#E2F3BE; margin:5px; padding:5px;">
        <input name="ybutt" type="button" onClick='call_yahoo()' value="Get Tags From Yahoo!" />
        
        <input id='godaddy' name="godaddy" <? echo (get_option('godaddy_host'))? "checked":"";?> type="checkbox" value="1" /> Hosted By Godaddy or Godaddy reseller <a style="color:#003399" href='javascript:;' onclick="show_help();">Why do I need this?</a>
        
        <div id='tag_holder' style="padding:3px;"></div>
        </div>
        
        <?
	} 

}
yahoo_autotag::init();
?>