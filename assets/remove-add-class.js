var elements = document.getElementsByClassName('heygov-row-cols-lg-5');
Array.from(elements).forEach(function(element) {
    element.classList.remove("heygov-row-cols-lg-5"); 
    element.classList.add("heygov-row-cols-lg-4"); 
}); 
  
