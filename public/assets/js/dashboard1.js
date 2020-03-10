 $(document).ready(function () {
     "use strict";
     // toat popup js
     $.toast({
         heading: 'Bienvenido al Sistema Primitiva',
         text: 'Seguiremos implementando funcionalidades. Gracias señor :) <3 .',
         position: 'top-right',
         loaderBg: '#fff',
         icon: 'warning',
         hideAfter: 3500,
         stack: 6
     })
     $('#calendar').fullCalendar('option', 'height', 745);
     // Dashboard 1 Morris-chart

     // counter
     $(".counter").counterUp({
         delay: 100,
         time: 1200
     });

 });
