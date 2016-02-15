
$(document).ready(function() {



  var $first_range = $('#first-range');
  var $first_output = $('#first-output');

  var $second_range = $('#second-range');
  var $second_output = $('#second-output');


  // Initialize rangeslider.js
  $first_range.rangeslider({
    polyfill: false
  });

  $second_range.rangeslider({
    polyfill: false
  });

  // Current value output
  $first_output[0].innerHTML = $first_range[0].value;
  $second_output[0].innerHTML = $second_range[0].value;

  $first_range.on('input', function() {
    $first_output[0].innerHTML = this.value;
  });

  $second_range.on('input', function() {
    $second_output[0].innerHTML = this.value;
  });

  // create an observer instance
  var observer1 = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.type === 'attributes') {
        $first_range.rangeslider('update', true);
        $first_output[0].innerHTML = $first_range[0].value;
      }
    });
  });

  var observer2 = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.type === 'attributes') {
        $second_range.rangeslider('update', true);
        $second_output[0].innerHTML = $second_range[0].value;
      }
    });
  });

  observer1.observe($first_range[0], {
    attributes: true
  });

  observer2.observe($second_range[0], {
    attributes: true
  });

  $('input[type=text]').on('input', function() {
    $first_range[0].setAttribute(this.name, this.value);
  });

  $('input[type=text]').on('input', function() {
    $second_range[0].setAttribute(this.name, this.value);
  });





});



