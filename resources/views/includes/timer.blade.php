@php
    $sponsorship_end = $apartment->getActiveSponsorshipEndDate(true);
    
@endphp

<div class="timer d-flex align-items-center"><i class="fa-regular fa-clock me-2"></i> <span
        id="days{{ $apartment->id }}"></span>:<span id="hours{{ $apartment->id }}"></span>:<span
        id="minutes{{ $apartment->id }}"></span>:<span id="seconds{{ $apartment->id }}"></span></div>
<input id="end-date" type="hidden" value="{{ $sponsorship_end }}">

<script>
    // Conversion Rates
    const msToSeconds{{ $apartment->id }} = 1000;
    const msToMinutes{{ $apartment->id }} = msToSeconds{{ $apartment->id }} * 60;
    const msToHours{{ $apartment->id }} = msToMinutes{{ $apartment->id }} * 60;
    const msToDays{{ $apartment->id }} = msToHours{{ $apartment->id }} * 24;

    const daysId{{ $apartment->id }} = "days" + {{ $apartment->id }}
    const hoursId{{ $apartment->id }} = "hours" + {{ $apartment->id }}
    const minutesId{{ $apartment->id }} = "minutes" + {{ $apartment->id }}
    const secondsId{{ $apartment->id }} = "seconds" + {{ $apartment->id }}

    const targetDays{{ $apartment->id }} = document.getElementById(daysId{{ $apartment->id }});
    const targetHours{{ $apartment->id }} = document.getElementById(hoursId{{ $apartment->id }});
    const targetMinutes{{ $apartment->id }} = document.getElementById(minutesId{{ $apartment->id }});
    const targetSeconds{{ $apartment->id }} = document.getElementById(secondsId{{ $apartment->id }});

    const endDateValue{{ $apartment->id }} = document.getElementById('end-date').value;
    const finalDate{{ $apartment->id }} = new Date(endDateValue{{ $apartment->id }}).getTime();

    const timer{{ $apartment->id }} = setInterval(() => {

        //Pick actual date
        const actualDate{{ $apartment->id }} = new Date().getTime();

        //Calculate difference between now and end date in MS
        const dateDiff{{ $apartment->id }} = finalDate{{ $apartment->id }} - actualDate{{ $apartment->id }};

        //Convert date in time units
        let daysLeft{{ $apartment->id }} = Math.floor(dateDiff{{ $apartment->id }} /
            msToDays{{ $apartment->id }});
        daysLeft{{ $apartment->id }} = daysLeft{{ $apartment->id }} < 10 ? "0" +
            daysLeft{{ $apartment->id }} : daysLeft{{ $apartment->id }};
        let hoursLeft{{ $apartment->id }} = Math.floor((dateDiff{{ $apartment->id }} %
            msToDays{{ $apartment->id }}) / msToHours{{ $apartment->id }});
        hoursLeft{{ $apartment->id }} = hoursLeft{{ $apartment->id }} < 10 ? "0" +
            hoursLeft{{ $apartment->id }} : hoursLeft{{ $apartment->id }};
        let minutesLeft{{ $apartment->id }} = Math.floor((dateDiff{{ $apartment->id }} %
            msToHours{{ $apartment->id }}) / msToMinutes{{ $apartment->id }});
        minutesLeft{{ $apartment->id }} = minutesLeft{{ $apartment->id }} < 10 ? "0" +
            minutesLeft{{ $apartment->id }} : minutesLeft{{ $apartment->id }};
        let secondsLeft{{ $apartment->id }} = Math.floor((dateDiff{{ $apartment->id }} %
            msToMinutes{{ $apartment->id }}) / msToSeconds{{ $apartment->id }});
        secondsLeft{{ $apartment->id }} = secondsLeft{{ $apartment->id }} < 10 ? "0" +
            secondsLeft{{ $apartment->id }} : secondsLeft{{ $apartment->id }};

        //Set clear interval
        if (daysLeft{{ $apartment->id }} < 0) {
            clearInterval(timer{{ $apartment->id }});
        }

        //Print in page
        targetDays{{ $apartment->id }}.innerText = daysLeft{{ $apartment->id }};
        targetHours{{ $apartment->id }}.innerText = hoursLeft{{ $apartment->id }};
        targetMinutes{{ $apartment->id }}.innerText = minutesLeft{{ $apartment->id }};
        targetSeconds{{ $apartment->id }}.innerText = secondsLeft{{ $apartment->id }};



    }, 1000)
</script>
