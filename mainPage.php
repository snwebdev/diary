

<?php
session_start();
?>

<!doctype html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Diary</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body data-spy="scroll" data-target=".navbar-collapse">
    <div class="container">
        <div id="topNav" class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header pull-left">
                <a class="navbar-brand">Diary</a>
            </div>
            <div class="pull-right">
                <p class="navbar-text"><?php echo (" {$_SESSION['email']}") ?></p>
                <ul class="nav navbar-nav">
                    <li><a href="index.php?logout=1">Log Out</a></li>  
                </ul>
            </div>
        </div>
    </div>

    <div id="sidebar">
        <div id="newEntrySelector" >New Entry</div>
        <div >
            <ul id="entryList"></ul>
        </div>
    </div>

    <div class="container contentContainer" id="home">
        <div id="entryDisplay">
            <div id="entryDisplayDateInner">
                <div class="half-left">
                    <span id="dayName"></span> 
                    <span id="day"></span>
                </div>
                <div class ="half-right">
                    <span id="superscript"></span>
                    <span id="monthName"></span>
                    <span id="year"></span>
                </div>
            </div>

            <div id="entryDisplayTitle"></div>
            <div id="entryDisplayText"></div>
            <div id="entryDisplayTime"></div>

        </div>
        <!-- Trigger the modal with a button -->

        <!-- Modal -->
        <div id="newEntryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Diary Entry</h4>
                    </div>
                    <div class="modal-body">
                        <form id="newEntryForm" method="post" action="diary_entry.php">
                            <div class="form-group">
                                <input type="text" name="diaryEntryTitle" class="form-control"  placeholder="Title..." autofocus>
                                <textarea class="form-control" id="diaryEntryText" rows="5" placeholder="Diary entry..."></textarea>
                                <div class="modal-footer">
                                    <button id="newEntrySaveButton" type="button" class="btn btn-default" value="save">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
        <script>
            $(".contentContainer").css("min-height", $(window).height());
            $("#sidebar").css("height", $(window).height() - $("#topNav").height());
            $("#sidebar").css("top", $("#topNav").height());
            $("#entryList").css("height", $(window).height() - $("#topNav").height() - $("#newEntrySelector").height());
            $("#entryDisplay").css("height", $(window).height() - $("#topNav").height() - 80);
            $("#entryDisplay").css("top", $("#topNav").height() + 40);
            $("#entryDisplay").css("width", $(window).width() - $("#sidebar").width() - 200);
            $("#entryDisplay").css("left", $("#sidebar").width() + 100);

            var parsedDiary;
            $.get("getDiary.php", function (diary) {
                parsedDiary = JSON.parse(diary);
                console.log(JSON.stringify(parsedDiary));
                displayEntriesInSidebar(parsedDiary);
                $("#entryList").on('click', 'li', function () {
                    var index = $(this).data("index");
                    displayDiaryEntry(parsedDiary, index);
                });
            });

            $("#newEntrySelector").on('click', function () {
                $("#newEntryModal input").val("");
                $("#newEntryModal").modal('show');
            });

            $("#newEntrySaveButton").on('click', function () {

                var formData = {
                    'title': $('input[name=diaryEntryTitle]').val(),
                    'text': $('#diaryEntryText').val()
                };

                $.ajax({
                    url: "diary_entry.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    success: function (data) {
                        $("#newEntryModal").modal('hide');
                        console.log("date = " + data.date);
                        addEntryToSidebar(data, parsedDiary);
                        addEntryToParsedDiary(data, parsedDiary);
                        displayNewEntry(parsedDiary);
                    }
                })
                        .fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        });
            });

            function displayNewEntry(parsedDiary) {
                var index = parsedDiary.length - 1;
                displayDiaryEntry(parsedDiary, index);
            }

            function addEntryToParsedDiary(data, parsedDiary) {
                parsedDiary.push(data);
                console.log(JSON.stringify(parsedDiary));
            }

            function addEntryToSidebar(data, parsedDiary) {
                var newIndex = parsedDiary.length;
                $("#entryList").prepend("<li data-index=" + newIndex + ">" + convertDate(data.date).short + "</br>" + data.title + "<hr></li>");

            }


            function displayDiaryEntry(parsedDiary, index) {
                var thisDate = new Date(parsedDiary[index].date);
                var jsDate = new Date(parsedDiary[index].date);
                var convertedDate = convertDate(jsDate);

                $("#dayName").html(convertedDate.dayName);
                $("#day").html(convertedDate.day + "<sup>" + convertedDate.superscript + "</sup>");
                $("#monthName").html(convertedDate.monthName);
                $("#year").html(convertedDate.year);
                $("#entryDisplayTitle").html(parsedDiary[index].title);
                $("#entryDisplayText").html(parsedDiary[index].text);
                if ($("#entryDisplay:hidden")) {
                    // alert("hidden");
                    $("#entryDisplay").css("visibility", "visible");
                } else {
                    // alert("not hidden");
                }
                ;

            }

            function displayEntriesInSidebar(parsedDiary) {
                //console.log("in displayEntriesInSidebar");
                var numberOfEntries = parsedDiary.length;
                var html = "";
                for (var i = numberOfEntries - 1; i >= 0; i--) {
                    html += "<li data-index=" + i + ">" + convertDate(parsedDiary[i].date).short + "</br>" + parsedDiary[i].title + "<hr></li>";
                }

                $("#entryList").html(html);
            }

            function convertDate(jsDate) {
                var dateObject = new Date(jsDate);
                var convertedDate = {};
                var dayName = [];
                dayName[0] = "Sunday";
                dayName[1] = "Monday";
                dayName[2] = "Tuesday";
                dayName[3] = "Wednesday";
                dayName[4] = "Thursday";
                dayName[5] = "Friday";
                dayName[6] = "Saturday";

                var superscript = ["NULL", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "st"];

                var monthName = [];
                monthName[0] = "January";
                monthName[1] = "February";
                monthName[2] = "March";
                monthName[3] = "April";
                monthName[4] = "May";
                monthName[5] = "June";
                monthName[6] = "July";
                monthName[7] = "August";
                monthName[8] = "September";
                monthName[9] = "October";
                monthName[10] = "November";
                monthName[11] = "December";

                var day = dateObject.getDay();
                var date = dateObject.getDate();
                var month = dateObject.getMonth();
                var year = dateObject.getFullYear();
                convertedDate.dayName = dayName[day];
                convertedDate.day = date;
                convertedDate.superscript = superscript[date];
                convertedDate.monthName = monthName[month];
                convertedDate.year = year;
                convertedDate.short = date + "-" + (month + 1) + "-" + year;
                // console.log("convertedDate="+JSON.stringify(convertedDate));
                return convertedDate;
            }

        </script>

</body>
</html>