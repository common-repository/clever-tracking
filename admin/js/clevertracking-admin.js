/**
 * Displaying tab in setting page. 
 * @author  Rrobin Dommisse <robin.dommisse@ambition4clients.nl>
 */
const ttc =  {
	openTab: (e, tabName)=> {
		var i;
		var x = document.getElementsByClassName("ttc-settings-tab");
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		document.getElementById(tabName).style.display = "block";

		x = document.getElementsByClassName("ttc-settings-tabbutton");
		for (i = 0; i < x.length; i++) {
			x[i].classList.remove("ttc-dark-grey");
		}
		e.currentTarget.classList.add("ttc-dark-grey");
	}
};
