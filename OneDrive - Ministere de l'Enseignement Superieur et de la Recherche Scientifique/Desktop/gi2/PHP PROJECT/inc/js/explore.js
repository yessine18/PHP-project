var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slide");
  
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
 
  slides[slideIndex-1].style.display = "grid";
  
}

const spaceship = document.querySelector(".spaceship");
let previousPlanet , currentPlanet;

function viewFacts(id){
  
   currentPlanet = document.getElementById(id);

   document.getElementById("planetData").style.display = "block";

   if(previousPlanet){
     previousPlanet.classList.add("hidden");
   }
   currentPlanet.classList.remove("hidden");
   currentPlanet.scrollIntoView();

   scrollAnimation(currentPlanet);

   previousPlanet = currentPlanet;
  
}

function scrollAnimation(planet){




        const facts = planet.querySelectorAll(".facts");



        const appearOptions = {
        threshold:0.5,
        rootMargin : "0px 0px 50px 0px"
        }

        const appearOnScroll = new IntersectionObserver( function(entries ,appearOnScroll  ){

        entries.forEach( entry => {
              if(!entry.isIntersecting){
                return;
                  
              }else{              
                  entry.target.classList.add("slideUp");                
                  appearOnScroll.unobserve(entry.target);
              }
        })

        } , appearOptions);

        facts.forEach( fact =>{
        appearOnScroll.observe(fact);
        });

}






  const navbar = document.querySelector("nav");
  const header = document.querySelector("header");

  const options = {
    rootMargin : "-200px"
  }


  const linksObserver = new IntersectionObserver( function(entries , linksObserver ){

    entries.forEach( entry =>{

        if(!entry.isIntersecting){
            navbar.style.backgroundColor = "#000";
          

        }else{
          navbar.style.backgroundColor = "transparent";
        }
    });

  }, options);

  linksObserver.observe(header);



  let sidePanel = document.getElementById("solarSideCard");

  function closeSidePanel(){  
    sidePanel.style.right = "-100%";   

  }


  let infoPanelPrevious, infoPanelCurrent;

  infoPanelPrevious = document.getElementById('sideInfoSun');

  function openSidePanel(id){
    infoPanelCurrent = document.getElementById(id);
    sidePanel.style.right="0";

    infoPanelPrevious.classList.add('hidden');
    infoPanelCurrent.classList.remove('hidden');

    infoPanelPrevious = infoPanelCurrent;

  }


  function  moveToPlanetCarousel(){
    document.getElementById('planet-carousel').scrollIntoView();     
  }



  function resetDropdown(){
   
      document.querySelector("details").removeAttribute('open'); 
  }



  let hamburgerMenu = document.getElementById('hamburgerMenu');
  let mobileMenu = document.getElementById('mobileMenu');

  function showMobileMenu(){
   
 
    hamburgerMenu.classList.toggle('active');
    mobileMenu.classList.toggle('active');

    setTimeout(()=>{
      mobileMenu.querySelector('.top-section').classList.toggle('active');
      mobileMenu.querySelector('.bottom-section').classList.toggle('active');
    },300);
    

  }


  function resetMobileMenu(){
 
    if(mobileMenu.classList.contains("active")){
      hamburgerMenu.classList.remove('active');
      mobileMenu.classList.remove('active');
      mobileMenu.querySelector('.top-section').classList.remove('active');
      mobileMenu.querySelector('.bottom-section').classList.remove('active');
    }
  }

 

