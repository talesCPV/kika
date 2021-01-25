
	let frmCrip = document.getElementById("frmCrip");

	let edtCrip = document.getElementById("edtCrip");
	let btnCrip = document.getElementById("btnCrip");
	let aCrip = document.getElementById("aCrip");

	let edtDecrip = document.getElementById("edtDecrip");
	let btnDecrip = document.getElementById("btnDecrip");
	let aDecrip = document.getElementById("aDecrip");

	btnCrip.addEventListener("click", function(){
		aCrip.innerHTML = sendFetch(1,edtCrip.value,aCrip);
	});

	btnDecrip.addEventListener("click", function(){
		aDecrip.innerHTML = sendFetch(2,edtDecrip.value,aDecrip);
	});

	frmCrip.addEventListener("submit", function(event){
		event.preventDefault();
	});

function sendFetch(std,str,obj){

	const data = new URLSearchParams();
	data.append('std', std);
	data.append('str',str);

	const myRequest = new Request('crip.php',
	    {
	        method: 'POST',
	        body: data
	    });

	fetch(myRequest)
	  .then(function(response){

	    response.text().then(function (text) {
	    	obj.innerHTML = text;
		});

	});

}