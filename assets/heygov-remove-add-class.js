var elements = document.getElementsByClassName('heygov-row-cols-lg-5');
Array.from(elements).forEach(function(element) {
    element.classList.remove("heygov-row-cols-lg-5"); // "heygov-row-cols-2"
    element.classList.add("heygov-row-cols-lg-4");   // "heygov-row-cols-1"
}); 
  
