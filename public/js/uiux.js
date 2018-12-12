//Adjust footer settings (footer will stick to the bottom if content is too short to push it down by itself)
//Called on load and on resize of the page
function adjust(){
  var main = document.getElementById("main-content");
  var footer = document.getElementById('main-footer');
  var navbar = document.getElementsByClassName("navbar");

  console.log("window inner height -> " + window.innerHeight);
  //console.log(footer.offsetHeight + navbar[0].offsetHeight);
  //console.log(main.offsetHeight + navbar[0].offsetHeight + footer.offsetHeight );

  /*if(main.offsetHeight + navbar[0].offsetHeight + footer.offsetHeight + 50 > window.innerHeight){
    footer.classList.remove('main-footer-sticky');
    footer.classList.add('main-footer');
    console.log("sticky to non sticky");
    document.getElementsByClassName('push')[0].classList.add("w3-show");
    document.getElementsByClassName('push')[0].classList.remove("w3-hide");
  }
  else if (footer.classList.contains("main-footer")){
    footer.classList.remove('main-footer');
    footer.classList.add('main-footer-sticky');
    document.getElementsByClassName('push')[0].classList.add("w3-hide");
    document.getElementsByClassName('push')[0].classList.remove("w3-show");
    console.log("non sticky to sticky");
  }*/
}
