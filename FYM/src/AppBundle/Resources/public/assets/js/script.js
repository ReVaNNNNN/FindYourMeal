/**
 * Created by kamil on 21.02.17.
 */


jQuery(function () {

    // add another input for enter igredient
    $('.addIgredient').on('click', function(event) {

        // prevent page reload after click
        event.preventDefault();

        // clone last li element to a variable
        var tmp = $('ul li').last().clone();


        // add cloned list element to DOM
        $('ul').last().append(tmp);

    });

    // remove last input which add igredient
    $('.rmvIgredient').on('click', function(event) {

        // prevent page reload after click
        event.preventDefault();

// prevent to short list of igredients
        // if form has at least 3 igredients input user can remove igredient input
        if($('ul li').length >= 3) {

            // remove last list element from DOM
            $('ul li').last().remove();
        } else {
            // if user want remove input to have less than 2 igredient show alert
            alert('Recipe must contain at least 2 igredients !');
        }
    });
});


// maybe for later use:

// var button = $('<li><label>Igredient : <select name="igredients"> ' +
//    '{% for e in igredients %} <option value="{{ e.id }}"> ' +
//    '{{ e.name }}</option>{%  endfor %} </select></label><label  id="last"> Quantity : ' +
//     '<input type="number" name="quantity" > grams </label></li>');


