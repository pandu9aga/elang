// JavaScript Document
var loader = {
  init: function() {
    loader.setVariables();
  },
  setVariables: function() {
    loader.$loader = $(".loader");
    loader.isLoading = false;
    loader.currentTimeout = null;
  },
  //Startet lade Animation
  load: function() {
    if (this.currentTimeout != null) {
      window.clearTimeout(this.currentTimeout);
    }
    loader.$loader.removeClass("success").removeClass("error");
    loader.$loader.addClass("loading");
    loader.isLoading = true;
  },
  //Startet success Animation
  success: function() {
    this.currentTimeout = window.setTimeout(function() {
      loader.$loader
        .removeClass("loading")
        .addClass("success");
      this.currentTimeout = window.setTimeout(loader.hide, 3000);
      loader.isLoading = false;
    }, 100);

  },
  //Startet error Animation
  error: function() {
    this.currentTimeout = window.setTimeout(function() {
      loader.$loader
        .removeClass("loading")
        .addClass("error");
      this.currentTimeout = window.setTimeout(loader.hide, 3000);
      loader.isLoading = false;
    }, 100);
  },
  hide: function() {
    if (!loader.isLoading) {
      loader.$loader.removeClass("success").removeClass("error");
    }
    this.currentTimeout = null;
  }
}


///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////

loader.init();
loader.load();
window.setTimeout(function() {
  loader.success();
  window.setTimeout(function() {
    loader.error();
  }, 4000);
}, 4000);