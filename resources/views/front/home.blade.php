<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
</head>

<body>
    <h3>Calendar</h3>

    <div id='calendar'></div>
    {{-- Brithday details model starta --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Birthday Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                    <h3>Name : <span class="small" id="u_title"></span></h3>
                    <h3>BirthDate: <span class="small" id="u_b_date"></span></h3>
                    <h3>Description: <span class="small" id="u_description"></span></h3>
                    <span hidden id="u_id"></span>
                </div>
            </div>
        </div>
    </div>
    {{-- Birthday details model end --}}
    <div class="modal" id="birthdayModal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Birthdays for the Selected Day</h2>
            <ul id="birthdayList"></ul>
            <div class="overflow-hidden scrollbar" id="table_data">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            $(".successModal").modal("show");
            let birthdayData = "{{ $data }}";
            console.log(birthdayData);
            // $yearBegin = date("Y");
            // $yearEnd = $yearBegin + 10; // edit for your needs
            // $years = range($yearBegin, $yearEnd, 1);
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // defaultDate: $.now(),
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                selectable: true,
                defaultView: 'month',
                events: [
                    @foreach ($data as $row)
                        {
                            id: "{{ $row->id }}",
                            title: '{{ $row->name }}',
                            date: '{{ $row->birthday_date }}',
                            description: '{{ $row->description }}',
                            start: '{{ $row->birthday_date }}',

                        },
                    @endforeach
                ],
                eventClick: function(event) {
                    $("#successModal").modal("show");
                    $("#successModal .modal-body #u_title").text(event.title);
                    $("#successModal .modal-body #u_b_date").text(event.date);
                    $("#successModal .modal-body #u_id").text(event.id);
                    $("#successModal .modal-body #u_description").text(event.description);
                },
                dayClick: function(date, jsEvent, view) {
                    // On day click, show the modal with birthdays for the selected day
                    const dataArr = JSON.parse(birthdayData.replace(/&quot;/g, '"'))
                    console.log(dataArr);
                    showBirthdaysForDay(date, dataArr);
                }
            })
            // show the list of birthday by selectd date
            function showBirthdaysForDay(selectedDate, data) {
                const formattedDate = selectedDate.format('YYYY-MM-DD');
                const birthdays = data.filter(event => event.birthday_date === formattedDate);

                const birthdayList = document.getElementById('birthdayList');
                birthdayList.innerHTML = '';

                if (birthdays.length > 0) {
                    for (const birthday of birthdays) {
                        const birthDateObj = new Date(birthday.birthday_date);
                        const currentDate = new Date();

                        let age = currentDate.getFullYear() - birthDateObj.getFullYear();
                        // Check if the birthday hasn't occurred this year yet
                        const isBirthdayPassed = currentDate.getMonth() > birthDateObj.getMonth() ||
                            (currentDate.getMonth() === birthDateObj.getMonth() && currentDate.getDate() >=
                                birthDateObj.getDate());

                        if (!isBirthdayPassed) {
                            age--;
                        }

                        console.log(isBirthdayPassed, '=====');
                        const listItem = document.createElement('li');
                        $('#table_data').html(`<table class="table-striped">
                                            <thead>
                                                <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Desc</th>
                                                <th scope="col">Age</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td>${birthday.name}</td>
                                                <td class="text-truncate">${birthday.description}</td>
                                                <td>${age}</td>
                                                </tr>
                                                
                                            </tbody>
                                            </table>`);
                        listItem.textContent = birthday.name;
                        birthdayList.appendChild(listItem);
                    }
                } else {
                    const noBirthdayItem = document.createElement('li');
                    noBirthdayItem.textContent = 'No birthdays on this day.';
                    birthdayList.appendChild(noBirthdayItem);
                }

                // Show the modal
                document.getElementById('birthdayModal').style.display = 'block';
            }

        });

        function closeModal() {
            document.getElementById('birthdayModal').style.display = 'none';
        }
    </script>
</body>

</html>
