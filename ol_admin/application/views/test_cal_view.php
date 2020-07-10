<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script src="<?=base_url()?>asset/js/fullcalendar.min.js"></script>
<link href="<?=base_url()?>asset/css/fullcalendar.css" rel="stylesheet">
<script type='text/javascript'>
            $(document).ready(function () {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                $('#calendar').fullCalendar({
					
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
					
                    buttonText: {
                        prev: 'Prev',
                        next: 'Next',
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day'
                    },
					
                    editable: true,
					
                    events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    }, {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2)
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false
                    }, {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false
                    }, {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false
                    }, {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false
                    }, {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/'
                    }]
					
                });
            });
        </script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Country Master</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Country</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
				<div class="span12">
					<div class="content-widgets gray">
						<div class="widget-head orange">
							<h3><i class=" icon-calendar"></i>Calendar</h3>
						</div>
						<div class="ribbon-wrapper-green">
							<div class="ribbon-green">
								Events
							</div>
						</div>
						<div class="widget-container">
							<div id='calendar'>
							</div>
						</div>
					</div>
				</div>
			</div>
