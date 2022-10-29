		//funzioni utilizzate per la comparsa/scomparsa delle immagini al passaggio del cursore del mouse
			window.onload = function () {				
				window.document.getElementById("img1").onmouseover = calc2;
				window.document.getElementById("img2").onmouseover = bask2;
				window.document.getElementById("img3").onmouseover = tenn2;
				window.document.getElementById("img1").onmouseout = calc1;
				window.document.getElementById("img2").onmouseout = bask1;
				window.document.getElementById("img3").onmouseout = tenn1;
				
			};
			
			function calc2() {
				window.document.getElementById("img1").src = "images/calc.jpg";
			}
			
			function bask2() {
				window.document.getElementById("img2").src = "images/bask.jpg";
			}
			
			function tenn2() {
				window.document.getElementById("img3").src = "images/tenn.jpg";
			}			
			
			function calc1() {
				window.document.getElementById("img1").src = "images/calcetto.jpg";
			}
			
			function bask1() {
				window.document.getElementById("img2").src = "images/basket.jpeg";
			}
			
			function tenn1() {
				window.document.getElementById("img3").src = "images/tennis.jpg";
			}			