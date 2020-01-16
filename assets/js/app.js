/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
//const $ = require('jquery');
$('.js-start-btn').on('click',(e) => {
     e.preventDefault();
    
     $.ajax({
        type: 'GET',
        url: $(e.target).closest('.js-start-btn').attr('href'),
        data: {},
        dataType: 'json',
        success: (data) => { console.log(data)

            $('.modal').show()
            $('.close').click(()=>{$('.modal').hide()})
            $('.modal-title').text(data.quizzLabel);
            $('.description').text(data.description);

         }

       
    });
    

})
