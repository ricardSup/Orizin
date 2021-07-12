var days = ['','Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

var monthNames = ["","January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDay();
document.getElementById("curr_date").innerHTML = days[d] + " ," + monthNames[m] + " " + y;