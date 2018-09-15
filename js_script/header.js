window.onresize = regenerate;

insertHeader();
regenerate();
function regenerate(){
	updateBackground();
	fitHeader();
}

function updateBackground(){
	//regenerate the trianglify background
	var pattern = Trianglify({
		width: window.innerWidth,
		height: window.innerHeight,
		x_colors: ['#ffffff', '#BB2100']
	});
		
	pattern.canvas(document.getElementById("background"));
}

function fitHeader(){
	//start by displaying everything,
	//then incrementally hide tabs until they fit within the window
	
	//show all tabs
	var tabs = document.getElementsByClassName("tab");
		
	for(var i = 0; i < tabs.length; i++){	
		tabs[i].style.display = "inline-block";
	}
	
	//make the logo large
	var logo = document.getElementsByClassName("header_logo");
	
	if(logo.length > 0)
		logo[0].src = "img/logo.png";
	
	//hide the more tab
	var tab_more = document.getElementsByClassName("tab_more");
		
	if(tab_more.length > 0)
		tab_more[0].style.display = "none";
	
	//remove tabs until the header fits the page
	var num_open_tabs = tabs.length;
	var tabs_width = 0;
	
	for(var i = 0; i < tabs.length; i++){
		tabs_width += tabs[0].clientWidth;
	}
	
	tabs_width += 550;
	
	while(tabs_width > window.innerWidth && num_open_tabs > 1){
		//if the window is too narrow, hide some navbar elements
		var tabs = document.getElementsByClassName("tab");

		num_open_tabs -= 1;		
		tabs_width -= tabs[num_open_tabs].clientWidth;
		tabs[num_open_tabs].style.display = "none";
				
		//show the more tab
		var tab_more = document.getElementsByClassName("tab_more");
		
		if(tab_more.length > 0)
			tab_more[0].style.display = "inline-block";
		
		//make the logo smaller
		var logo = document.getElementsByClassName("header_logo");
		
		if(logo.length > 0)
			logo[0].src = "img/logo_s.png";
	}
	
	//lock the content size at a max of 900px
	var contents = document.getElementsByClassName("scalable_content");
	if(window.innerWidth > 950){
		for(var i = 0; i < contents.length; i++){
			contents[i].style.width = "900px";
		}
	}
	else{
		for(var i = 0; i < contents.length; i++){
			contents[i].style.width = "100%";
		}
	}
}

function insertHeader(){
	var header = document.getElementById("header");
	if(header != null){
		header.innerHTML = "<h1 class=\"header_contact_info\">\
							<a href=\"find.htm\">24 Commerce St. - Springfield, NJ - 07081</a>\<br><a href=\"tel:+908-868-6007\">908-868-6007</a>&emsp; Fax: <a href=\"tel:+973-268-1130\">973-268-1130</a>\
							<br><a href=\"mailto:info@furnitureassist.com\">info@furnitureassist.com</a>\
							<div class=\"open\"></div>\
							</h1>\
							\
							<img class=\"header_logo\" src=\"img/logo/logo.png\">\
							\
							<ul class=\"header_navbar\">\
								<a id=\"home\" class=\"tab\" href=\"index.htm\">Home</a>\
								<a id=\"donate\" class=\"tab\" href=\"donate.htm\">Donate</a>\
								<a id=\"volunteer\" class=\"tab\" href=\"volunteer.htm\">Volunteer</a>\
								<a id=\"clients\" class=\"tab\" href=\"clients.htm\">Clients</a>\
								<a id=\"agencies\" class=\"tab\" href=\"agencies.htm\">Agencies</a>\
								<a id=\"about\" class=\"tab\" href=\"about.htm\">About Us</a>\
								<a id=\"more\" class=\"tab_more\" href=\"more.htm\">More</a>\
							</ul>\
							\
							<hr class=\"header_line\">";
		
		var tab = document.getElementById(header.className);
		if(tab != null){
			tab.className = "tab_current";
		}
	}
							
	var buttons = document.getElementById("buttons");
	if(buttons != null){
		buttons.innerHTML = "<div style=\"position:fixed;right:20px;bottom:8px;\">\
							<iframe src=\"https://platform.twitter.com/widgets/follow_button.html?screen_name=FurnAssistInc&show_screen_name=false&show_count=false&size=l\"\
							title=\"Follow TwitterDev on Twitter\"\
							width=\"80\"\
							height=\"38\"\
							style=\"border:0;overflow:hidden;float:right;\"\
							frameborder=\"0\"\
							allowTransparency=\"true\"></iframe>\
							<br>\
							<iframe src=\"https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Ffurnitureassist&width=141&layout=button_count&action=like&size=large&show_faces=false&share=true&height=46&appId\"\
							width=\"151\"\
							height=\"38\"\
							style=\"border:0;overflow:hidden;\"\
							frameborder=\"0\"\
							allowTransparency=\"true\"></iframe>\
							</div>\
							<div style=\"position:fixed;left:15px;bottom:15px;\">\
							<a href=\"javascript:void(0)\" onClick=\"printPage();\"><img class=\"social_media\" src=\"img/social/print.png\"></a>\
							<a href=\"mailto:info@furnitureassist.com\"><img class=\"social_media\" src=\"img/social/email.png\"></a>\
							<a href=\"https://www.networkforgood.org/donate/process/expressDonation.aspx?ORGID2=57-1230561\" target=\"_blank\"><img class=\"social_media\" src=\"img/social/donate_s.png\"></a>\
							</div>";
	}
	
}

function printPage(){
	document.getElementById("header").style.display = "none";
	document.getElementById("buttons").style.display = "none";
	document.getElementById("background").style.display = "none";
	
	var reds = document.getElementsByClassName("content_red");
	
	for(var i = 0; i < reds.length; i++){
		reds[i].style.color = "black";
	}
	
	
	document.getElementsByClassName("content")[0].style.paddingTop = "0px";
	
	window.print();
		
	document.getElementById("header").style.display = "block";
	document.getElementById("buttons").style.display = "block";
	document.getElementById("background").style.display = "block";
	
	for(var i = 0; i < reds.length; i++){
		reds[i].style.color = "white";
	}
	
	document.getElementsByClassName("content")[0].style.paddingTop = "120px";
}
