var slideIndex = 1;
moveSlide(0);

window.setInterval(function(){moveSlide(1)}, 5000);

function moveSlide(amount){
	slideIndex += amount;
	setSlideElements("slideshow_image");
	setSlideElements("slideshow_caption");
}

function setSlideElements(class_name){
	//hide all elements with class name except for the one at slideIndex
	//fetch all elements
	var elems = document.getElementsByClassName(class_name);
	
	if(elems.length <= 0)
		return;
	
	//check if the index is out of bounds; if so, loop slideIndex
	if(slideIndex > elems.length){
		slideIndex = 1;
	} else if(slideIndex < 1){
		slideIndex = elems.length;
	}
	
	//hide all elements
	for(var i = 0; i < elems.length; i++){
		elems[i].style.display = "none";
	}
	
	//display just the one element
	elems[slideIndex-1].style.display = "block";
	
}
