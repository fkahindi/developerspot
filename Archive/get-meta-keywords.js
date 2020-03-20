$('document').ready(function(){
		/* Function to generate keywords from the current article and puts them in the keyswords meta tag at the head. */
		function getKeywords(){
			var keywords = [];
			var elements = document.querySelectorAll('.key');
			for(var element of elements){
				keywords.push(element.innerHTML);
			}
			return String(keywords);
		}
		/* The following function help to generate content for description meta tag.  */
		function getMetaDescription(){
			var metaDescription = [];
			var descriptions = document.querySelectorAll('.meta-description');
			for(var description of descriptions){
				metaDescription.push(description.innerHTML);
			}
			return String(metaDescription);
		}
		/* Get keyswords for meta */
		var meta = document.getElementsByName('keywords')[0];
		var words = getKeywords();
		meta.setAttribute("content",words.toLowerCase());
		
		/* Get description for meta */
		
		var meta_descr = document.getElementsByName('description')[0];
		var description = getMetaDescription();
		meta_descr.setAttribute("content",description);
	});