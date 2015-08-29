"use strict";
window.onload = countDown;

function countDown(){
    // alert("called");
    var tasksToCountDown = document.getElementsByClassName("countDown");
    for (var index = 0; index < tasksToCountDown.length; ++index) {
        var due = tasksToCountDown[index].getAttribute("dueDate");
        var now = Date.now() / 1000;  // conver to seconds
        var totalSeconds = Math.floor(due - now);
       
        var days = Math.floor(totalSeconds / 86400);
        totalSeconds %= 86400;
        var hours = Math.floor(totalSeconds / 3600);
        totalSeconds %= 3600;
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;
 
        var countDown = "------- " + days + " days " + hours + ":" + minutes + ":" + seconds + " left -------";
        tasksToCountDown[index].innerHTML = countDown;
    }
    setTimeout("countDown()", 1000);
}
