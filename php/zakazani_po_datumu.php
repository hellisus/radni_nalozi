<?php
require  'config.php';
if (!isset($_SESSION['Ime'])) {
    header("location:../index.php");
  };

    $podatci = new CRUD();
    $podatci->table = "nalozi";
    $rezultat = $podatci->select(['*'], ['*'], "SELECT * FROM nalozi WHERE kome_zaduzen != 0");


   //echo json_encode($rezultat);
?>
<script>

var data = <?php echo json_encode($rezultat); ?>;

var events = [];
var event_object = {};

for (var i = 0; i < data.length; i++) {
    var date = new Date(data[i].datum_zakazan + 'T00:00:00');

    event_object = {
          id: i,
          title: data[i].tip_naloga,
          start: date,
          end: date
    }

    events = events + event_object;

    console.log(event_object)
}

</script>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="../tailwind_o.css" rel="stylesheet">

	<title>SR NALOG - zakazani kalendar</title>


	    <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../stylesheets/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <!-- Font Awesome JS 6 -->
    <script src="https://kit.fontawesome.com/e7c9d17f96.js" crossorigin="anonymous"></script>
    <!--Import jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../src/js/funkcije.js"></script>
    <!--Kalendar js-->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>


</head>

<body>
<div class="wrapper">
        <!-- Sidebar  -->
        <?php require_once 'sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">
            <!-- Topbar  -->
            <?php require_once 'topbar.php' ?>
            <div id='calendar' ></div>
        </div>
</div>

<script>

  const Calendar = tui.Calendar;

  const container = document.getElementById('calendar');
const options = {
  defaultView: 'month',
  timezone: {
    zones: [

      {
        timezoneName: 'Europe/Belgrade',
        displayLabel: 'Novi Sad',
      },
    ],
  },
  calendars: [
    {
      id: 'cal1',
      name: 'Personal',
      backgroundColor: '#03bd9e',
    },
    {
      id: 'cal2',
      name: 'Work',
      backgroundColor: '#00a9ff',
    },
  ],
};

const calendar = new Calendar(container, options);

var events = new Array();

$.ajax({
    url: 'display_event.php',  
    dataType: 'json',
    success: function (response) {
         
    var result=response.data;
    $.each(result, function (i, item) {
    	events.push({
            id: result[i].event_id,
            title: result[i].title,
            start: result[i].start,
            end: result[i].end,
        }); 	
    })


console.log(result);

    calendar.createEvents([
      result[529],
      result[536],
      result[577]
]);
  }
})





calendar.createEvents([
  {
    id: 'event1',
    title: 'Weekly meeting',
    start: '2023-08-07',
    end: '2023-08-07',
  },
  {
    id: 'event2',
    calendarId: 'cal1',
    title: 'Lunch appointment',
    start: '2023-08-09',
    end: '2023-08-09',
    isAllday: true,
  },
]);
</script>
</body>
</html>

