(function() {
	var trCollection = document.getElementsByTagName("tr");
	var numRows = trCollection.length;
	for (var i = 1; i <numRows; i++) {
		var tr = trCollection[i];
		// 每到整百行， 下边框加粗
		if (i % 100 === 0) {
			if (!tr.classList.contains('thick-bottom')) {
				tr.classList.add('thick-bottom');
			}
		}
		// 隔行换色
		if (i % 2 == 1) {
			if (!tr.classList.contains('.alt-bg')) {
				tr.classList.add('alt-bg');
			}
		}
	}
}).call(this);

function scrollToAnchor(aid){
	var aTag = $("a[name='"+ aid +"']");
	$('html,body').animate({scrollTop: aTag.offset().top},'slow');
}