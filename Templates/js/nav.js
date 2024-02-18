
		function scrollToSection(sectionId) {
		   var targetSection = document.getElementById(sectionId);
		   if (targetSection) {
			  window.scrollTo({
				 top: targetSection.offsetTop,
				 behavior: 'smooth'
			  });
		   }
		}
	
		document.addEventListener("DOMContentLoaded", function () {
			const container = document.querySelector('.custom-testimony-container');
			const prevBtn = document.querySelector('.prev-btn');
			const nextBtn = document.querySelector('.next-btn');
	
			let scrollAmount = 0;
			const scrollUnit = 300; // Ajustez selon votre besoin
	
			nextBtn.addEventListener('click', function () {
				scrollAmount += scrollUnit;
				container.scrollTo({
					left: scrollAmount,
					behavior: 'smooth'
				});
			});
	
			prevBtn.addEventListener('click', function () {
				scrollAmount -= scrollUnit;
				if (scrollAmount < 0) scrollAmount = 0;
				container.scrollTo({
					left: scrollAmount,
					behavior: 'smooth'
				});
			});
		});

	
	