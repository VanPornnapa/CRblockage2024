  function getStLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showStPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }
  function showStPosition(position) {
    StLat = position.coords.latitude; 
    StLong =position.coords.longitude;
    $("#latstart").val(StLat);
    $("#longstart").val(StLong);
  }

  function getFinLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showFinPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }
  function showFinPosition(position) {
    FinLat = position.coords.latitude; 
    FinLong =position.coords.longitude;
    $("#latend").val(FinLat);
    $("#longend").val(FinLong);
  }


